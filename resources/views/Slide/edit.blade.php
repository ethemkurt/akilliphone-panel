
@extends('layouts/contentLayoutMaster')

@section('title', 'Slayt Resimleri')

@section('page-style')
    {{-- Page Css files --}}
@endsection

@section('content')
    <section class="form-control-repeater">
        <div class="row">
            <!-- Invoice repeater -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Invoice</h4>
                    </div>
                    <div class="card-body">
                        <form action="#" class="invoice-repeater">
                            <div data-repeater-list="invoice">
                                <div style="display: none">
                                    <div data-repeater-item class="draggable">
                                        <div class="row d-flex align-items-end">
                                            <div class="col-md-4 col-12">
                                                    <div class="item-img text-center mb-1">
                                                        <a href="app-ecommerce-details.html">
                                                            <img src="file:///C:/Users/ahmet/Desktop/vuexy-html-bootstrap5-admin-template/app-assets/images/pages/eCommerce/1.png" class="img-fluid" alt="img-placeholder">
                                                        </a>
                                                    </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemcost">Cost</label>
                                                    <input type="number" class="form-control" id="itemcost" aria-describedby="itemcost" placeholder="32" />
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="itemquantity">Quantity</label>
                                                    <input type="number" class="form-control" id="itemquantity" aria-describedby="itemquantity" placeholder="1" />
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12">
                                                <div class="mb-1">
                                                    <label class="form-label" for="staticprice">Price</label>
                                                    <input type="text" readonly class="form-control-plaintext" id="staticprice" value="$32" />
                                                </div>
                                            </div>

                                            <div class="col-md-2 col-12 mb-50">
                                                <div class="mb-1">
                                                    <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Invoice repeater -->
        </div>
    </section>
@endsection

@section('vendor-script')
    {{-- vendor files --}}
@endsection

@section('page-script')
    <script src="{{ url('vendors/js/forms/repeater/jquery.repeater.min.js') }}"></script>
    <script src="{{ url('vendors/js/extensions/dragula.min.js') }}"></script>

    <script>
            // form repeater jquery
            $('.invoice-repeater, .repeater-default').repeater({
                show: function () {
                    $(this).slideDown();
                    // Feather Icons
                    if (feather) {
                        feather.replace({ width: 14, height: 14 });
                    }
                },
                hide: function (deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
            dragula([document.getElementById('multiple-list-group-a'), document.getElementById('multiple-list-group-b')]);

    </script>
@endsection
