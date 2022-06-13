@extends('layouts.master')
@section('content')
    <div id="content" class="app-content">
        <div class="row">
            <div class="align-items-center">
                <div class="col-12">
                    <h1 class="page-header mb-0">Offer Information</h1>
                </div>
                <div class="col-9">
                    <hr/>
                </div>
                <x-back-button link='offer.index'></x-back-button>
            </div>
        </div>
        <div id="formControls" class="mb-5">
            <h6>View <span class="text-theme"> OFFER</span> Information From Here</h6>
            <p>If you want to update any information of this <b class="text-theme">Offer</b> please go to the update
                page
                by clicking the <b class="text-theme">Update</b> button given bellow.</p>

            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body pb-2">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="title">Offer Name</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span class="float-right">{{ ucwords( $offer->name?? 'N/A') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="description">Description</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <span
                                                    class="float-right"> {{ ucwords( $offer->description ?? 'N/A') }} </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="status">Status</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                @if($offer->status == "AVAILABLE")
                                                    <span class="float-right badge bg-success"> Available </span>
                                                @else
                                                    <span class="float-right badge bg-danger">Not Available </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @if(count($offer->products) > 0)
                                    <div class="row  mt-2">
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                <label class="form-label" for="permissions">Products</label>
                                                <span class="float-end">:</span>
                                            </div>
                                        </div>
                                        <div class="col-xl-6">
                                            <div class="form-group mb-3">
                                                @foreach($offer->products as $product)
                                                    <a href="{{ route('product.show',$product->uuid) }}"
                                                       class="float-right badge border border-theme text-light mt-1"
                                                       style="text-decoration: none;font-size: 12px">{{ ucwords( $product->title)  ?? 'N/A'}}</a>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>

                                <div class="col-xl-12 text-center mt-5">
                                    <div class="ms-auto">
                                        <a href="{{ route('offer.edit',$offer->uuid) }}"
                                           class="btn btn-outline-theme btn-lg"><i
                                                class="bi bi-send-check fa-lg"></i>
                                            <span class="small">Update</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <x-card-border></x-card-border>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('customScripts')

@endpush
