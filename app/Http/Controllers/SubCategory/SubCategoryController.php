<?php

namespace App\Http\Controllers\SubCategory;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Repository\Eloquent\SubCategoryRepository;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use function GuzzleHttp\Promise\all;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $repository;

    public function __construct(SubCategoryRepository $repository)
    {
        $this->repository = $repository;
    }
    public function index(SubCategoryRequest $request)
    {
        try {
            if ($request->ajax()) {
                $data = SubCategory::latest()->get();
                return DataTables::of($data)->editColumn('description',  function(SubCategory $subCategory) {
                    return  $subCategory->description ?? 'N/A';
                })
                    ->addColumn('category_id',  function($row) {
                        return '<a href="'.route('category.show',$row->categories->uuid).'" class="badge border border-theme text-theme" style="text-decoration: none">'. $row->categories->title . '</a>' ?? 'N/A';
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function ($row) {
                        $btn = '<a href="' . route('sub-category.edit', $row->uuid) . '" class="btn btn-outline-theme mb-2"><i class="fas fa-edit"></i></a>
                                <a href="' . route('sub-category.show', $row->uuid) . '" class="btn btn-outline-theme mb-2"><i class="fas fa-eye"></i></a>
                                <button data-bs-toggle="modal" data-bs-target="#danger" onclick="onDelete(this)" id="' . route('sub-category.destroy', $row->uuid) . '" name="delBtn"
                                                                    class="btn btn-outline-danger mb-2"><i class="fas fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','category_id'])
                    ->make(true);
            }
            return view('subCategory.index');
        } catch (Exception $exception) {
            return $exception->getMessage();
        }

    }

    public function create()
    {
        $categories = Category::all();
        return view('subCategory.create', ['categories' => $categories]);

    }

    public function store(SubCategoryRequest $request)
    {
        try {
            $validated = $request->validated();
            if ($validated){
                $data =$request->all();
                $checkDuplication = $this->repository->findByTitle($data['title']);
                if ($checkDuplication){
                    throw new Exception('Title Should Be Unique');
                }else{
                    $subCategory = $this->repository->createSubCategory($data);
                    if ($subCategory){
                        return redirect()->route('sub-category.index')->with('success','Sub-Category Created Successfully');
                    }else{
                        throw new Exception('Sub-Category Not Created!');
                    }
                }
            }
        }catch (Exception $exception){
            return redirect()->route('sub-category.index')->withErrors(['errors'=> $exception->getMessage()]);
        }
    }


    public function show($uuid)
    {
        $subCategory = $this->repository->findByUuid($uuid);
        return view('subCategory.info',['subCategory' => $subCategory]);
    }


    public function edit($uuid)
    {
        $categories = Category::all();
        $subCategory = $this->repository->findByUuid($uuid);
        return view('subCategory.edit',['subCategory' => $subCategory, 'categories' => $categories]);
    }


    public function update(SubCategoryRequest $request, $uuid)
    {
        try {
            $data = $request->all();
            $update = $this->repository->updateSubCategory($data, $uuid);
            if ($update){
                return redirect()->route('sub-category.index')->with('success','Sub-Category Updated Successfully');
            }else{
                throw new Exception('Sub-Category Not Updated!');
            }
        }catch (Exception $exception){
            return redirect()->route('sub-category.index')->withErrors(['errors'=> $exception->getMessage()]);
        }
    }


    public function destroy($uuid)
    {
        try {
            $this->repository->deleteByUuid($uuid);
            return redirect()->route('sub-category.index')->with('success', 'Sub Category Deleted Successfully');

        }catch (Exception $exception){
            return redirect()->route('sub-category.index')->withErrors(['errors'=> $exception->getMessage()]);
        }
    }

    public function imageSubmit(Request $request){

        try {
            $image = $this->repository->storeImage($request,'public/images/sub-category');
            return $image;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }
    public function imageUpdate(Request $request, $uuid)
    {
        try {
            $image = $this->repository->updateImage($request,$uuid, 'public/images/sub-category');
            return $image;
        }catch (Exception $exception){
            return $exception->getMessage();
        }
    }
}
