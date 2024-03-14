@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Listesi')

@section('page-style')
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ _Asset('vendor/libs/@form-validation/umd/styles/index.min.css') }}" />
@endsection
@section('nav-buttons')
    <a class="btn btn-primary" href="{{ route('product.new','new') }}">
        <i data-feather="save"></i>
        <span class="align-middle">Kaydet</span>
    </a>
@endsection
@section('content')
    <section >
        <div class="row">
            <!-- Default Wizard -->
            <div class="col-12 mb-4">
                <?php
                $forms = [
                    'product-basic'=>[
                        'code'=>'product-basic',
                        'title'=>'Temel Özellikler',
                        'description'=>'Ürüne Ait Temel Özellikler',
                        'icon'=>'',
                        'file'=>'product-basic',
                    ],
                    'product-stock'=>[
                        'code'=>'product-stock',
                        'title'=>'Stok Bilgileri',
                        'description'=>'Ürüne Ait Stok ve Kategori Bilgileri',
                        'icon'=>'',
                        'file'=>'product-stock'
                    ],
                    'product-detail'=>[
                        'code'=>'product-detail',
                        'title'=>'Detay Bilgisi',
                        'description'=>'Ürüne Ait Detay Bilgileri',
                        'icon'=>'',
                        'file'=>'product-detail'
                    ],
                    'product-pazaryerleri'=>[
                        'code'=>'product-pazaryerleri',
                        'title'=>'Pazaryerleri',
                        'description'=>'Ürüne Ait Pazaryerleri Ayarları',
                        'icon'=>'',
                        'file'=>'product-pazaryerleri'
                    ],
                ];
                $sira = 1;
                ?>
                @if($forms)
                    <div class="bs-stepper wizard-numbered mt-2">
                        <div class="bs-stepper-header">
                            @foreach($forms as $form)
                                <div class="step" data-target="#{{ $form['code'] }}">
                                    <button type="button" class="step-trigger">
                                        <span class="bs-stepper-circle">{{ $sira++ }}</span>
                                        <span class="bs-stepper-label">
                            <span class="bs-stepper-title">{{ $form['title'] }}</span>
                            <span class="bs-stepper-subtitle">{{ $form['description'] }}</span>
                          </span>
                                    </button>
                                </div>

                                <div class="line">
                                    <i class="ti ti-chevron-right"></i>
                                </div>
                            @endforeach
                        </div>
                        <div class="bs-stepper-content">
                            <form onSubmit="return false">
                                <!-- Account Details -->
                                @foreach($forms as $form)
                                    @include('Product.tabs.'.$form['file'])
                                @endforeach
                            </form>
                        </div>
                    </div>
                @endif

            </div>
            <!-- /Default Wizard -->
        </div>
    </section>
@endsection

@section('vendor-script')
@endsection

@section('page-script')
    <script src="{{ _Asset('vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/bootstrap-select/bootstrap-select.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/@form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/@form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ _Asset('vendor/libs/@form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ _Asset('js/form-wizard-numbered.js') }}"></script>
    <script>
        $('body').on('click', '.load-product-specs', function(){
            $.ajax( $(this).data('url') )
                .done(function(response) {
                    $('#product-specs').html(response.html)
                })
                .fail(function() {
                    $('#product-specs').html('error')
                });
        });
    </script>
@endsection
