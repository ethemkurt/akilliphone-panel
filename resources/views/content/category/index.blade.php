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
                            <div class="col-md-6 mb-1">
                                <div class="input-group">
                                    <select class="form-select" id="inputGroupSelect04"
                                        aria-label="Example select with button addon">
                                        @php
                                            $options = [
                                                [
                                                    'name' => 'Aksesuarlar',
                                                    'value' => 'accesories',
                                                ],
                                                [
                                                    'name' => 'Diğer Ürünler',
                                                    'value' => 'others',
                                                ],
                                                [
                                                    'name' => 'Ev & Yaşam',
                                                    'value' => 'home',
                                                ],
                                                [
                                                    'name' => 'Kablolar & Dönüştürücüler',
                                                    'value' => 'cables',
                                                ],
                                                [
                                                    'name' => 'Şarj Aletleri',
                                                    'value' => 'charge',
                                                ],
                                                [
                                                    'name' => 'Ses Sistemleri',
                                                    'value' => 'sound',
                                                ],
                                                [
                                                    'name' => 'Tamir Malzemeleri',
                                                    'value' => 'tamir',
                                                ],
                                                [
                                                    'name' => 'Yedek Parçalar',
                                                    'value' => 'yedek',
                                                ],
                                            ];
                                        @endphp
                                        @foreach ($options as $option)
                                            <option value="{{ $option['value'] }}">{{ $option['name'] }}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-primary" type="button">İşaretli Kategorileri Bu Kategoride
                                        Birleştir</button>
                                </div>
                            </div>
                            {{-- <a href="/category/add">
                                <button type="button" class="btn btn-success waves-effect waves-light mt-lg-0 mt-1">
                                    <i data-feather="file-plus"></i>
                                    Yeni Kategori
                                </button>
                            </a> --}}
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

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script>
@endsection
