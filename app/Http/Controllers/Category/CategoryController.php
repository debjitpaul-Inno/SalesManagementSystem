<?php

namespace App\Http\Controllers\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repository\CategoryRepositoryInterface;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    private $repository;

    public function __construct(CategoryRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(CategoryRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = Category::latest()->get();
                return DataTables::of($data)
                    ->editColumn('description',  function(Category $category) {
                    return  $category->description ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {

                        $btn = '<a href="' . route('category.edit', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-edit"></i></a>
                                <a href="' . route('category.show', $row->uuid) . '" class="btn btn-outline-theme"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('category.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
            }
            return view('category.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {

        try {
            $validated = $request->validated();
            $data = $request->all();
            if ($validated){
                $checkDuplication = $this->repository->findByTitle($data['title']);
                if ($checkDuplication){
                    throw new Exception('Title Should Be Unique');
                }else{
                    $category = $this->repository->createCategory($data);
                    if ($category){
                        return redirect()->route('category.index')->with('success', 'Category Created Successfully');
                    }else{
                        throw new Exception('Category Not Created');
                    }
                }
            }
        }catch (Exception $exception){
            return redirect()->route('category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    public function imageSubmit(Request $request){

        try {
            $image = $this->repository->storeImage($request,'public/images/category');
            return $image;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    public function imageUpdate(Request $request, $uuid)
    {
        try {
            $image = $this->repository->updateImage($request,$uuid, 'public/images/category');
            return $image;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show($uuid)
    {
        $category = $this->repository->findByUuid($uuid);
        return view('category.info', ['category' => $category]);
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($uuid)
    {
        $category = $this->repository->findByUuid($uuid);
        return view('category.edit',['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $this->repository->updateCategory($request, $uuid);
            return redirect()->route('category.index')->with('success', 'Category Updated Successfully');

        }catch (Exception $exception){
            return redirect()->route('category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('category.index')->with('success', 'Category Deleted Successfully');
        }catch (Exception $exception)
        {
            return redirect()->route('category.index')->withErrors(['errors' => $exception->getMessage()]);
        }
    }
}
