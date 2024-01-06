@extends('layout.admin')
@section('page_title')
    Admin Dashboard
@endsection

@section('page_content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-md-9">
                    @include('pos.search')
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <input type="text" id="customer" class="form-control py-1"
                            placeholder="Enter customer name or phone number">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card mt-3  all_content ">
                <div class="card-body p-3 ">
                    <form>
                        <div class="d-flex justify-content-between " style="font-weight: 600">
                            <div class="w-5">
                                <span>item #</span>
                            </div>
                            <div class="w-lg-50 w-sm-30 text-start">
                                <span>Item Name</span>
                            </div>
                            <div class="w-5 text-end">
                                <span>Avail Qty</span>
                            </div>
                            <div class="w-5 d-flex  " style="width: 150px">
                                <span class="me-5" >Qty</span>
                                <span>Price</span>
                            </div>
                            <div class="w-5 ">
                                <span class="text-start" >Ext Price</span>
                            </div>
                            <div class="w-5">

                            </div>
                        </div>

                        <div>
                            <div class="cart_list">

                            </div>

                        </div>

                        <div class="d-flex mt-2 justify-content-end ">
                            <div class=" ">
                                <button class="btn checkout btn-primary py-1">Checkout</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
  
@endpush
