@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Ekle')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-body">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a id="home-tab" data-bs-toggle="pill" href="#home" aria-expanded="true" class="nav-link active">
                            Genel Tanımlar
                        </a>
                    </li>
                    @php
                        $tabs = [
                            [
                                "href" => "stock",
                                "title" => "Stok Durumu"
                            ],
                            [
                                "href" => "details",
                                "title" => "Detaylar"
                            ],
                            [
                                "href" => "attributes",
                                "title" => "Diğer Özellikler"
                            ],
                            [
                                "href" => "tags",
                                "title" => "Etiket Yönetimi"
                            ],
                            [
                                "href" => "seo",
                                "title" => "SEO Yönetimi"
                            ],
                            [
                                "href" => "seo-report",
                                "title" => "SEO Raporu"
                            ],
                            [
                                "href" => "marketplace",
                                "title" => "Pazaryerleri"
                            ],
                        ];
                    @endphp
                    @foreach ($tabs as $tab)
                    <li class="nav-item">
                        <a id="{{ $tab["href"] }}-tab" data-bs-toggle="pill" aria-expanded="false" href="#{{ $tab["href"] }}" class="nav-link">
                            {{ $tab["title"] }}
                        </a>
                    </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                        <form>
                            <div class="row g-1 mt-1">
                                <div class="col-md-4 mb-1">
                                    <x-inputs.text-input name="productCode" label="Ürün Kodu" placeholder="34066" />
                                </div>
                                <div class="col-md-4 mb-1">
                                    <x-inputs.text-input name="mainProductCode" label="Ana Ürün Kodu" placeholder="60061" />
                                </div>
                                <div class="col-md-4 mb-1">
                                    <x-inputs.text-input name="accountingDescription" label="Muhasebe Açıklama" placeholder="Nethesap Açıklama" />
                                </div>
                                <div class="col-md-12 mb-1">
                                    <x-inputs.text-input name="productName" label="Ürün Adı" placeholder="HAWEEL 15 İnch Universal Evrak Ve Laptop Çantası" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="productOptionTag" label="Ürün Seçenek Etiketi" placeholder="Çoklu Ürün Etiketi" />
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $options = [
                                            [
                                                "name" => "Renk",
                                                "value" => "color",
                                            ],
                                            [
                                                "name" => "Beden",
                                                "value" => "size"
                                            ],
                                            [
                                                "name" => "Numara",
                                                "value" => "number"
                                            ],
                                            [
                                                "name" => "Malzeme",
                                                "value" => "material"
                                            ],
                                        ];
                                    @endphp

                                    <x-inputs.select-input :items="$options" label="Ürün Seçenek Türü" name="productOptionType" />
                                </div>
                                <div class="col-md-12 mt-2">
                                    <h4>Diğer Seçenekler</h4>
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="salePrice" label="Satış Fiyatı" placeholder="34.60" />
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $currencyTypes = [
                                            [
                                                "name" => "USD",
                                                "value" => "usd"
                                            ],
                                            [
                                                "name" => "TL",
                                                "value" => "tl"
                                            ],
                                            [
                                                "name" => "EUR",
                                                "value" => "eur"
                                            ]
                                        ];
                                    @endphp

                                    <x-inputs.select-input :items="$currencyTypes" label="Para Birimi" name="currencyType" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="listPrice" label="Bayi Fiyatı" placeholder="34.66" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="productPart" label="Ürün Bölümü" placeholder="Ürün Bölümü" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="price" label="Alış Fiyatı" placeholder="60.66" />
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $kdv = [
                                            [
                                                "name" => "KDV %8",
                                                "value" => "kdv8"
                                            ],
                                            [
                                                "name" => "KDV %18",
                                                "value" => "kdv18"
                                            ],
                                        ];
                                    @endphp

                                    <x-inputs.select-input :items="$kdv" label="KDV" name="kdv" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="getProductTag" label="Ürün Tagı Çekme" placeholder="Stok kodu giriniz" />
                                </div>
                                <div class="col-md-6">
                                    @php
                                        $units = [
                                            [
                                                "name" => "--Kullanılmayacak--",
                                                "value" => "no"
                                            ],
                                            [
                                                "name" => "Adet",
                                                "value" => "adet"
                                            ],
                                            [
                                                "name" => "Santimetre",
                                                "value" => "cm"
                                            ],
                                            [
                                                "name" => "Düzine",
                                                "value" => "duzine"
                                            ],
                                            [
                                                "name" => "Gram",
                                                "value" => "gr"
                                            ],
                                            [
                                                "name" => "Kilogram",
                                                "value" => "kg"
                                            ],
                                            [
                                                "name" => "Paket",
                                                "value" => "packet"
                                            ],
                                            [
                                                "name" => "Metre",
                                                "value" => "m"
                                            ],
                                            [
                                                "name" => "Metre kare",
                                                "value" => "m2"
                                            ],
                                        ];
                                    @endphp

                                    <x-inputs.select-input :items="$units" label="Ürün Birimi" name="productUnit" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="campaignPrice" label="Kampanya Fiyatı" placeholder="0.00" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="basketLimit" label="Sepet Limiti" placeholder="0.00" />
                                </div>
                                <div class="col-md-6">
                                    <x-inputs.text-input name="priceWithoutDiscount" label="İndirimsiz Fiyatı" placeholder="0.00" />
                                </div>
                                <div class="col-md-6"></div>
                                {{-- TODO: Add Product Attributes --}}
                                <div class="col-md-12">
                                    <x-inputs.text-field name="specialWarning" label="Özel Uyarı" rows="3" />
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $categories = [
                                            [
                                                "name" => "Aksesuarlar",
                                                "value" => "aksesuarlar"
                                            ],
                                            [
                                                "name" => "Diğer ürünler",
                                                "value" => "others"
                                            ],
                                            [
                                                "name" => "Ev & Yaşam",
                                                "value" => "ev_yasam"
                                            ],
                                            [
                                                "name" => "Kablolar ve Dönüştürücüler",
                                                "value" => "kablolar"
                                            ],
                                            [
                                                "name" => "Şarj Aletleri",
                                                "value" => "sarj_aletleri"
                                            ],
                                            [
                                                "name" => "Ses Sistemleri",
                                                "value" => "ses_sistemleri"
                                            ],
                                            [
                                                "name" => "Tamir Malzemeleri",
                                                "value" => "tamir_malzemeleri"
                                            ],
                                            [
                                                "name" => "Yedek Parçalar",
                                                "value" => "yedek_parca"
                                            ],
                                        ];
                                    @endphp

                                    <x-inputs.select-input :items="$categories" label="Kategori" name="category" />
                                </div>
                                <div class="col-md-12">
                                    @php
                                        $brands = [
                                            [
                                                "name" => "Baseus",
                                                "value" => "baseus"
                                            ],
                                            [
                                                "name" => "Dux Ducis",
                                                "value" => "dux_ducis"
                                            ],
                                            [
                                                "name" => "Hoco",
                                                "value" => "hoco"
                                            ],
                                            [
                                                "name" => "Duzzona",
                                                "value" => "duzzona"
                                            ],
                                            [
                                                "name" => "Biltzwolf",
                                                "value" => "biltzwolf"
                                            ],
                                        ];
                                    @endphp
                                    <x-inputs.select-input :items="$brands" label="Marka" name="brand" />
                                </div>
                            </div>
                            <div class="mt-2">
                                <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="stock" role="tabpanel" aria-labelledby="stock-tab"
                        aria-expanded="false">
                    </div>
                    <div class="tab-pane" id="details" role="tabpanel" aria-labelledby="details-tab"
                        aria-expanded="false">
                    </div>
                    <div class="tab-pane" id="attributes" role="tabpanel" aria-labelledby="attributes-tab"
                        aria-expanded="false">
                    </div>
                    <div class="tab-pane" id="tags" role="tabpanel" aria-labelledby="tags-tab"
                        aria-expanded="false">
                    </div>
                    <div class="tab-pane" id="seo" role="tabpanel" aria-labelledby="seo-tab"
                        aria-expanded="false">
                    </div>
                    <div class="tab-pane" id="seo-report" role="tabpanel" aria-labelledby="seo-report-tab"
                        aria-expanded="false">
                    </div>
                    <div class="tab-pane" id="marketplace" role="tabpanel" aria-labelledby="marketplace-tab"
                        aria-expanded="false">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('vendor-script')
    <!-- vendor files -->
    <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
    <script>
        var flatpickrRange = document.querySelector("#flatpickr-range");

        flatpickrRange.flatpickr({
            mode: "range"
        });
    </script>
@endsection
