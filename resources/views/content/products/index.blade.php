
@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün List')

@section('content')

    <!-- Basic table -->
    <section id="basic-datatable">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-12">
                            <div class="mb-md-1">
                                @php
                                    $options = [
                                        [
                                            'name' => 'Tümü',
                                            'value' => 'all',
                                        ],
                                        [
                                            'name' => 'Stokta Olanlar',
                                            'value' => 'stock',
                                        ],
                                        [
                                            'name' => 'Biten Stok',
                                            'value' => 'nostock',
                                        ],
                                        [
                                            'name' => 'Azalan Stok',
                                            'value' => 'less_stock',
                                        ],
                                        [
                                            'name' => 'Fiyatı 0 TL',
                                            'value' => 'no_price',
                                        ],
                                        [
                                            'name' => 'Kategorisiz',
                                            'value' => 'no_category',
                                        ],
                                        [
                                            'name' => 'Markasız',
                                            'value' => 'no_brand',
                                        ],
                                        [
                                            'name' => 'Varyantsız',
                                            'value' => 'no_variant',
                                        ],
                                        [
                                            'name' => 'Son 24 Saatte Harekete Giren Ürünler',
                                            'value' => 'last_24',
                                        ],
                                        [
                                            'name' => 'Son 24 Saatte Tükenen Ürünler',
                                            'value' => 'last_24_nostock',
                                        ],
                                        [
                                            'name' => 'Pasif Ürünler',
                                            'value' => 'passive',
                                        ],
                                    ];
                                @endphp
                                <x-inputs.select-input name="options" label="Seçenekler" :items="$options" />
                            </div>

                            <button type="button" class="btn btn-success waves-effect waves-light mt-lg-0 mt-1">Net Hesaptan Ürünleri Çek</button>
                            <button type="button" class="btn btn-warning waves-effect waves-light mt-lg-0 mt-1">Kopyala</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light mt-lg-0 mt-1">Sil</button>
                            <button type="button" class="btn btn-danger waves-effect waves-light mt-lg-0 mt-1">Net Hesaptan Stok Güncelle</button>
                            <button type="button" class="btn btn-info waves-effect waves-light mt-lg-0 mt-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24"><path fill="currentColor" d="M3 11V3h8v8H3Zm2-2h4V5H5v4ZM3 21v-8h8v8H3Zm2-2h4v-4H5v4Zm8-8V3h8v8h-8Zm2-2h4V5h-4v4Zm4 12v-2h2v2h-2Zm-6-6v-2h2v2h-2Zm2 2v-2h2v2h-2Zm-2 2v-2h2v2h-2Zm2 2v-2h2v2h-2Zm2-2v-2h2v2h-2Zm0-4v-2h2v2h-2Zm2 2v-2h2v2h-2Z"/></svg>
                                QR Code
                            </button>
                        </div>
                    </div>
                    <table class="datatables-basic table">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>id</th>
                            <th>Stok Kodu</th>
                            <th>Ürün</th>
                            <th>Kategori</th>
                            <th>Stok</th>
                            <th>Fiyat</th>
                            <th>Bayi</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic table -->
@endsection


@section('vendor-script')
    {{-- vendor files --}}
    <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.checkboxes.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/jszip.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/pdfmake.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/vfs_fonts.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.html5.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/buttons.print.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/tables/products/product-table.js')) }}"></script>
@endsection
