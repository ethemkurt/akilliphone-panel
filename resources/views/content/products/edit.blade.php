@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Ekle')

@section('vendor-style')
    {{-- Vendor Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/katex.min.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('vendors/css/editors/quill/quill.snow.css')) }}">
@endsection

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
    <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-quill-editor.css')) }}">
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
                          <div class="mb-1">
                            <form action="#" class="invoice-repeater">
                                <div class="mb-1" id="full-wrapper">
                                    <label class="form-label">Ürün Açıklaması</label>
                                    <div id="full-container">
                                      <div class="editor">
                                      </div>
                                    </div>
                                  </div>
                               <div class="mb-1">
                                <div data-repeater-list="invoice">
                                    <div data-repeater-item>
                                      <div class="row d-flex align-items-end">
                                        <div class="col-md-5 col-12">
                                            <label class="form-label" for="basicSelect">Renk Seçin</label>
                                            <select class="form-select" id="basicSelect">
                                                <option>Siyah</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5 col-12">
                                                <x-inputs.file-input label="Resim Seçin" name="file_input" />
                                        </div>
                                        <div class="col-md-2 col-12">
                                            <button class="btn btn-outline-danger text-nowrap px-1" data-repeater-delete type="button">
                                              <i data-feather="x" class="me-25"></i>
                                              <span>Sil</span>
                                            </button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                    <div class="col-12 mt-1">
                                      <button class="btn btn-icon btn-primary" type="button" data-repeater-create>
                                        <i data-feather="plus" class="me-25"></i>
                                        <span>Yeni Ekle</span>
                                      </button>
                                    </div>
                               </div>
                              </form>
                          </div>
                    </div>
                    <div class="tab-pane" id="attributes" role="tabpanel" aria-labelledby="attributes-tab"
                        aria-expanded="false">
                        <form>
                            <div class="row mt-1">
                                <div class="col-md-12 mb-1">
                                    <x-inputs.text-input name="productName" label="Sipariş Notu" placeholder="" />
                                </div>
                                <div class="col-12 mb-1">
                                        <label class="form-label" for="select2-multiple">Ürün Etiketleri</label>
                                        <select class="select2 form-select" id="select2-multiple" multiple>

                                            <option value="1">Yeni Ürünler</option>
                                            <option value="2">Çok Satanlar</option>
                                            <option value="3">Popüler Ürünler</option>
                                            <option value="4">Kampanya Sayfası</option>
                                            <option value="5">İndirimdekiler</option>
                                            <option value="6">Editör Seçimi</option>
                                        </select>
                                </div>
                                <div class="col-md-6 col-12 mb-1">
                                    @php
                                        $currencyTypes = [
                                            [
                                                "name" => "Bayiye Özel Ürün",
                                                "value" => "reseller"
                                            ],
                                            [
                                                "name" => "Genel Ürün",
                                                "value" => "general"
                                            ],
                                            [
                                                "name" => "Müşteriye Özel Ürün",
                                                "value" => "customer"
                                            ]
                                        ];
                                    @endphp
                                    <x-inputs.select-input :items="$currencyTypes" label="Ürün Tipi" name="currencyType" />
                                </div>
                                <div class="col-md-6 col-12 mb-1">
                                    <div class="row">
                                        <div class="col-md-6 col-12 mb-1">
                                            @php
                                            $currencyTypes = [
                                                [
                                                    "name" => "Ekstra Ücret",
                                                    "value" => "2"
                                                ],
                                                [
                                                    "name" => "Ücretsiz",
                                                    "value" => "1"
                                                ],
                                                [
                                                    "name" => "Hayır",
                                                    "value" => "0"
                                                ],
                                            ];
                                        @endphp
                                        <x-inputs.select-input :items="$currencyTypes" label="Hediye Paketi" name="currencyType" />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-inputs.text-input name="productPart" label="Fiyatı" placeholder="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-12 mb-1">
                                    @php
                                        $currencyTypes = [
                                            [
                                                "name" => "Orijinal",
                                                "value" => "original"
                                            ],
                                            [
                                                "name" => "A++",
                                                "value" => "aQuality"
                                            ],
                                        ];
                                    @endphp
                                    <x-inputs.select-input :items="$currencyTypes" label="Ürün Durumu" name="currencyType" />
                                </div>
                                <div class="col-md-6 col-12 mb-1">
                                    <x-inputs.text-input name="productPart" label="Desi Değeri" placeholder="0.00" />
                                </div>
                                <div class="col-md-6 col-12 mb-1">
                                    <x-inputs.text-input name="price" label="Tedarikçi Kodu" placeholder="" />
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group px-0">
                                            <span class="input-group-text">Genel Sıra No</span>
                                            <input type="text" aria-label="First name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group px-0">
                                            <span class="input-group-text">Kategori Sıra No</span>
                                            <input type="text" aria-label="First name" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group px-0">
                                            <span class="input-group-text">Marka Sıra No</span>
                                            <input type="text" aria-label="First name" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my-2">
                                    <h4>Pazar Yeri Fiyat Çarpanları</h4>
                                </div>
                                <div class="col-12 mb-1">
                                    <x-inputs.text-input name="price" label="N11 Çarpanı" placeholder="" />
                                </div>
                                <div class="col-12 mb-1">
                                    <x-inputs.text-input name="price" label="Hepsiburada Çarpanı" placeholder="" />
                                </div>
                                <div class="col-12 mb-1">
                                    <x-inputs.text-input name="price" label="Amazon Çarpanı" placeholder="" />
                                </div>
                                <div class="col-12 mb-1">
                                    <x-inputs.text-input name="price" label="Trendyol Çarpanı" placeholder="" />
                                </div>
                            </div>
                            <div class="mt-1">
                                <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane" id="tags" role="tabpanel" aria-labelledby="tags-tab"
                        aria-expanded="false">
                        Etiket Yönetimi
                    </div>
                    <div class="tab-pane" id="seo" role="tabpanel" aria-labelledby="seo-tab"
                        aria-expanded="false">
                        <form>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Kategori Adı"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Marka Adı"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Ürün Adı"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Ürün Fiyat"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Anahtar Kelimeler" rows="6" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Açıklama" rows="6" />
                            </div>
                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                        </form>
                    </div>
                    <div class="tab-pane" id="seo-report" role="tabpanel" aria-labelledby="seo-report-tab"
                        aria-expanded="false">
                        <form>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Önerilen Anahtar Kelimeler" rows="3" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="En Ucuz Fiyat (cimri.com)"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Google Sırası"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-input name="product_name" label="Kelime Yoğunluğu"
                                    placeholder="GaN Lite Quick Charger" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="İlk Site ve Meta Tagları" rows="3" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="İkinci Site ve Meta Tagları" rows="3" />
                            </div>
                            <div class="mb-1">
                                <x-inputs.text-field name="text_field" label="Üçüncü Site ve Meta Tagları" rows="3" />
                            </div>
                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                        </form>
                    </div>
                    <div class="tab-pane" id="marketplace" role="tabpanel" aria-labelledby="marketplace-tab"
                        aria-expanded="false">
                        <div class="card">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a id="home-tab" data-bs-toggle="pill" href="#n11" aria-expanded="true" class="nav-link active">
                                            N11
                                        </a>
                                    </li>
                                    @php
                                        $tabs = [
                                            [
                                                "href" => "hepsiburada",
                                                "title" => "HepsiBurada"
                                            ],
                                            [
                                                "href" => "amazon",
                                                "title" => "Amazon"
                                            ],
                                            [
                                                "href" => "trendyol",
                                                "title" => "Trendyol"
                                            ],
                                            [
                                                "href" => "ciceksepet",
                                                "title" => "ÇiçekSepeti"
                                            ],
                                            [
                                                "href" => "pazarama",
                                                "title" => "Pazarama"
                                            ]
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
                                    <div class="tab-pane active" id="n11" role="tabpanel" aria-labelledby="seo-report-tab" aria-expanded="false">
                                        <form>
                                            <div class="mb-1">
                                                <x-inputs.file-input label="N11 Ürün Resmi" name="file_input" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Ürün Adı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Ürün Alt Başlık"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Fiyatı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Sabit Fiyatı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 İndirim Etiket Tutarı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Birleşme Rengi"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                @php
                                                $answer = [
                                                    [
                                                        "name" => "Evet",
                                                        "value" => "2"
                                                    ],
                                                    [
                                                        "name" => "Hayır",
                                                        "value" => "0"
                                                    ],
                                                ];
                                                @endphp
                                                <x-inputs.select-input :items="$answer" label="Çoklu İsimler Seçeneğe Dönüşsün" name="" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Komisyon %"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="OEM"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="Kritik Stok Adedi"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                @php
                                                $answer = [
                                                    [
                                                        "name" => "Evet",
                                                        "value" => "2"
                                                    ],
                                                    [
                                                        "name" => "Hayır",
                                                        "value" => "0"
                                                    ],
                                                ];
                                                @endphp
                                                <x-inputs.select-input :items="$answer" label="N11'de Yayınlansın" name="" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Katalog ID"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                                        </form>
                                    </div>
                                    <div class="tab-pane active" id="hepsiburada" role="tabpanel" aria-labelledby="seo-report-tab" aria-expanded="false">
                                        <form>
                                            <div class="mb-1">
                                                <x-inputs.file-input label="Ürün Resmi" name="file_input" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label=Ürün Adı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label=Ürün Alt Başlık"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="Fiyatı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="Sabit Fiyatı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="İndirim Etiket Tutarı"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="Birleşme Rengi"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                @php
                                                $answer = [
                                                    [
                                                        "name" => "Evet",
                                                        "value" => "2"
                                                    ],
                                                    [
                                                        "name" => "Hayır",
                                                        "value" => "0"
                                                    ],
                                                ];
                                                @endphp
                                                <x-inputs.select-input :items="$answer" label="Çoklu İsimler Seçeneğe Dönüşsün" name="" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="Komisyon %"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="OEM"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="Kritik Stok Adedi"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <div class="mb-1">
                                                @php
                                                $answer = [
                                                    [
                                                        "name" => "Evet",
                                                        "value" => "2"
                                                    ],
                                                    [
                                                        "name" => "Hayır",
                                                        "value" => "0"
                                                    ],
                                                ];
                                                @endphp
                                                <x-inputs.select-input :items="$answer" label="N11'de Yayınlansın" name="" />
                                            </div>
                                            <div class="mb-1">
                                                <x-inputs.text-input name="product_name" label="N11 Katalog ID"
                                                    placeholder="GaN Lite Quick Charger" />
                                            </div>
                                            <x-button type="submit" buttonType="primary" value="Submit" name="submit" label="Kaydet" />
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script src="{{ asset(mix('vendors/js/editors/quill/katex.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/highlight.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/editors/quill/quill.min.js')) }}"></script>
    <script src="{{ asset(mix('vendors/js/forms/repeater/jquery.repeater.min.js')) }}"></script>
@endsection

@section('page-script')
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/forms/form-validation.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-quill-editor.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-repeater.js')) }}"></script>
    <script>
        var flatpickrRange = document.querySelector("#flatpickr-range");

        flatpickrRange.flatpickr({
            mode: "range"
        });
    </script>
    <script>
        $(".selectpicker").selectpicker();
    </script>
@endsection
