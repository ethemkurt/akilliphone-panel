
@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Ekleme')

@section('page-style')
    {{-- Page Css files --}}
    <link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection


@section('content')
    <style>
        /* Eklenen CSS */
        #renkTablosu {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        #renkTablosu th, #renkTablosu td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        #renkTablosu th {
            background-color: #f2f2f2;
        }
        .tab{
            width: 100%;
            background-color: white;
        }
        .tab ul li{
            display: inline-block;
            padding: 15px;
            font-weight: bold;
        }
        .tab ul li a{
            text-decoration: none;
            color: #5E5873;
        }

    </style>

    <!-- Advanced Search -->
    <section id="advanced-search-datatable">
        <div class="tab">
            <ul>
                <li><a href="" onclick="openSpec(event, 'urunfiyat')">Ürün / Fiyat Bilgileri</a></li>
                <li><a href="" onclick="openSpec(event, 'stokkategori')">Stok / Kategori Bilgileri</a></li>
                <li><a href="" onclick="openSpec(event, 'detay')">Detay / Fotoğraf Bilgileri</a></li>
                <li><a href="" onclick="openSpec(event, 'pazaryerleri')">Pazaryerleri</a></li>
                <li><a href="">Diğer Bilgiler</a></li>

            </ul>

        </div>
    <form action="{{route('product.addProduct')}}" method="post">
        @csrf
        <div class="row" >

            <div class="tabspec" id="urunfiyat">
                <div class="col-12">
                    <div class="row equal mb-3">

                        <div class="col-md-6">
                            <div class="card full-height mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title m-0">Ürün Bilgileri</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün kodu</label></div>
                                            <div class="col-sm-9">

                                                <input value="{{ $product['code'] ?? '' }}" type="text" class="form-control" name="product[code]" placeholder="Ürün kodu" >
                                            </div>
                                        </div>
                                    </div>

                                     <div class="col-12">
                                         <div class="mb-1 row">
                                             <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ana Ürün kodu</label></div>
                                             <div class="col-sm-9">
                                                 <input value="" type="text" class="form-control" name="" placeholder="Ana Ürün kodu">
                                             </div>
                                         </div>
                                     </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Adı</label></div>
                                            <div class="col-sm-9">
                                                <input value="{{$product['name']?? '' }}" type="text" class="form-control" name="product[name]" placeholder="Ürün Adı">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Seçenek Etiketi</label></div>
                                            <div class="col-sm-9">

                                                <input value="" type="text" class="form-control" name="" placeholder="Ürün Etiketi">


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Seçenek Türü</label></div>
                                            <div class="col-sm-9">

                                                <select id="" class="select-with-name form-select" data-nametarget="" name="product[brandId]">
                                                    <option value="">Renk </option>
                                                    <option value="">Beden  </option>
                                                    <option value="">Numara </option>
                                                    <option value="">Malzeme </option>


                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Bölümü</label></div>
                                            <div class="col-sm-9">

                                                <input value="" type="text" class="form-control" name="" placeholder="Ürün Bölümü">


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Tagı Çekme</label></div>
                                            <div class="col-sm-9">

                                                <input value="" type="text" class="form-control" name="" placeholder="Ürün Tagı Çekme">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Markası</label></div>
                                            <div class="col-sm-9">
                                                <select id="" class="select-with-name form-select" data-nametarget="" name="product[brandId]">
                                                    <option value="">Marka Seçiniz </option>

                                                    @foreach($brand['items'] as $brands)
                                                        @if($product!=null)
                                                            <option value="{{$brands['brandId']}}" {{ $brands['brandId'] ==  $product['brandId']  ? 'selected' : '' }}>
                                                                {{$brands['name']}}
                                                            </option>
                                                        @else
                                                            <option value="{{$brands['brandId']}}">
                                                                {{$brands['name']}}
                                                            </option>
                                                        @endif


                                                    @endforeach


                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Birimi</label></div>
                                            <div class="col-sm-9">
                                                <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                    <option value="">Adet</option>
                                                    <option value="">Kg</option>
                                                    <option value="">Metre</option>
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                         <div class="col-12">
                                         <div class="mb-1 row">
                                             <div class="col-sm-3">
                                                 <label class="col-form-label" for="code">Ürün Ana Fotoğrafı </label>
                                             </div>
                                             <div class="col-sm-9">
                                                 <div class="image-upload small brand" style="background-image: url({{ _CdnImageUrl($product['featuredImage']?? '' , 200,200) }}) ">
                                                     <input type="text" name="product[featuredImage]" value="" style="display: none">
                                                     <input type="hidden" name="imageFile" value="">
                                                 </div>
                                             </div>
                                         </div>
                                         </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card full-height mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title m-0">Fiyat Bilgileri </h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Para Birimi</label></div>
                                            <div class="col-sm-9">
                                                <select id="" class="select-with-name form-select" data-nametarget="" name="product[currency]">
                                                    @if(isset($product['currency']))
                                                        @foreach($currency['currency'] as $currency )
                                                            <option value="{{$currency}}" {{ $currency ==  $product['currency']  ? 'selected' : '' }}>{{$currency}} </option>
                                                        @endforeach
                                                    @else
                                                        @foreach($currency['currency'] as $currency )
                                                            <option value="{{$currency}}"> {{$currency}} </option>
                                                        @endforeach
                                                    @endif



                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Satış Fiyatı</label></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="" placeholder="Satış Fiyatı" value="{{$product['variants'][0]['price']?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Bayi Fiyatı</label></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="" placeholder="Bayi Fiyatı">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Alış Fiyatı</label></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="" placeholder="Alış Fiyatı">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">KDV</label></div>
                                            <div class="col-sm-9">
                                                <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                    <option value="">10%</option>
                                                    <option value="">20%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Kampanya Fiyatı</label></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="" placeholder="Kampanya Fiyatı">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">İndirimsiz Fiyat</label></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="" placeholder="İndirimsiz Fiyat" value="{{$product['variants'][0]['oldPrice']?? '' }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Sepet Limiti</label></div>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="" placeholder="Sepet Limiti">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <div class="tabspec" id="stokkategori" style="display: none">
                <div class="col-12" >
                    <div class="row equal mb-3">
                        <div class="col-md-6" >
                            <div class="card full-height mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title m-0">Kategori Bilgileri</h5>
                                </div>
                                <div class="card-body">
                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ana Kategori</label></div>
                                            <div class="col-sm-9">
                                                <select id="mainCategory" class="select-with-name form-select" data-nametarget="" name="" >

                                                        <option value="">Anakategori Seçiniz</option>
                                                        <?php foreach ($categories as $item) : ?>
                                                            <?php if ($item['parentId'] === null) : ?>
                                                        <option value="<?= $item['categoryId'] ?>"><?= $item['name'] ?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>

                                                </select>


                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12" id="altkategori">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Alt Kategori</label></div>
                                            <div class="col-sm-9">
                                                <select name="subCategory" id="subCategory" style="display: none;"class="select-with-name form-select" data-nametarget="" >

                                                        <?php foreach ($categories as $item) : ?>
                                                        <?php if ($item['parentId'] !== null) : ?>
                                                    <option class="subCategory" value="<?= $item['categoryId'] ?>" data-parent="<?= $item['parentId'] ?>"><?= $item['name'] ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <h6 class="m-0">
                                       <button type="button" class="btn btn-danger" onclick="addSubcategory()">
                                                <i class="feather icon-plus"></i></button>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" >
                            <div class="card full-height mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title m-0">Stok Bilgisi</h5>

                                </div>
                                <div class="card-body">

                                    <div class="col-12">
                                        <div class="mb-1 row">
                                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Renk</label></div>
                                            <div class="col-sm-9" style="width: 100%;">
                                                <select class="select-with-name form-select" id="renkler" name="renkler" multiple style="height: 150px">
                                                    <option value="kirmizi">Kırmızı</option>
                                                    <option value="yesil">Yeşil</option>
                                                    <option value="mavi">Mavi</option>
                                                    <option value="sari">Sarı</option>
                                                    <option value="turuncu">Turuncu</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <h6 class="m-0">
                                        <a href=" javascript:void(0)"><button type="button" class="btn btn-danger" id="renkbtn">
                                                <i class="feather icon-plus"></i></button>
                                        </a></h6>
                                    <table id="renkTablosu">
                                        <thead>
                                        <tr>
                                            <th>Renk</th>
                                            <th>Miktar</th>
                                            <th>Barkod</th>
                                        </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                    <a href=" javascript:void(0)" ><button type="button" class="btn btn-success btn-popup-form"style="margin-top: 10px">
                                            <i>Kaydet</i></button>
                                    </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tabspec" id="detay" style="display: none">
                <div class="col-12">
                    <div class="mb-1 row">
                        <div class="col-sm-3">
                            <label class="col-form-label" for="description">Açıklama </label>
                        </div>
                        <div class="col-sm-9">
                            <x-textarea-editor id="description" name="brand[description]" placeholder="Açıklama" value="{{isset($brand['description'])?$brand['description']:''}}" />
                        </div>
                    </div>

                    <div id="froala"></div>
                </div>
            </div>
            <div class="tabspec" id="pazaryerleri" style="display: none">
                <div class="col-12" >
                    <div class="row equal mb-3">

                        <div class="col-md-12" >
                            <div class="card full-height mb-4">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="card-title m-0">Pazaryerleri</h5>

                                </div>
                                <div class="tab">
                                    <ul class="tablist">



                                        <li><a href="" onclick="pazaryeriTab(event, 'gittigidiyor')">Gittigidiyor</a></li>
                                        <li><a href="" onclick="pazaryeriTab(event, 'n11')">N11</a></li>
                                        <li><a href="" onclick="pazaryeriTab(event, 'hb')">Hepsi Burada</a></li>
                                        <li><a href="" onclick="pazaryeriTab(event, 'amazon')">Amazon</a></li>
                                        <li><a href="" onclick="pazaryeriTab(event, 'trendyol')">Trendyol</a></li>
                                        <li><a href="" onclick="pazaryeriTab(event, 'ciceksepeti')">Çiçek Sepeti</a></li>
                                        <li><a href="" onclick="pazaryeriTab(event, 'pazarama')">Pazarama</a></li>


                                    </ul>

                                </div>


                                <div class="card-body pazaryeri" id="gittigidiyor">
                                    <div class="col-12">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title m-0">Gittigidiyor Ayarları</h5>

                                        </div>
                                        <hr>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Kategori Kodu : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Kategori Kodu">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">GG Katalog Id : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="GG Katalog Id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">GG Komisyon % : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="GG Komisyon %">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" style="margin-top: 20px;">

                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>GG Bilgisini Kaydet</i></button>
                                            </a><a href=" javascript:void(0)" ><button type="button" class="btn btn-success btn-popup-form"style="margin-top: 10px;margin-left: 10px">
                                                    <i>GG'de Yenile</i></button>
                                            </a><a href=" javascript:void(0)" ><button type="button" class="btn btn-success btn-popup-form"style="margin-top: 10px;margin-left: 10px">
                                                    <i>Fiyat & Stok Güncelle</i></button>
                                            </a><a href=" javascript:void(0)" ><button type="button" class="btn btn-warning btn-popup-form"style="margin-top: 10px;margin-left: 10px">
                                                    <i>GG Baseusda Yenile</i></button>
                                            </a>


                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-danger btn-popup-form" style="margin-top: 10px;margin-left: 10px;float: right">
                                                    <i class="fa fa-times"></i> <i>  GG'den Sil</i></button></a>




                                        </div>




                                    </div>

                                </div>

                                <div class="card-body pazaryeri" id="amazon" style="display: none">
                                    <div class="col-12">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title m-0">Amazon Ayarları</h5>

                                        </div>
                                        <hr>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Amazon Ürün Adı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Amazon Ürün Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Amazon Komisyon % : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="GG Katalog Id">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Amazon'da Yayınlansın </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option value="">Evet </option>
                                                        <option value="">Hayır </option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" style="margin-top: 20px;">

                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>Amazon Bilgilerini Kaydet</i></button>
                                            </a>


                                        </div>

                                    </div>

                                </div>

                                <div class="card-body pazaryeri" id="trendyol" style="display: none">
                                    <div class="col-12">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title m-0">Trendyol Ayarları</h5>

                                        </div>
                                        <hr>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol Ürün Adı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Trendyol Ürün Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol Komisyon % : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Trendyol Komisyon %">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol Fiyatı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Trendyol Fiyatı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol İndirim Etiket Tutarı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Trendyol İndirim Etiket Tutarı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Ürünün Trendyol Id'si : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Ürünün Trendyol Id'si">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Rekabet İçin Minimum Fiyat : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Rekabet İçin Minimum Fiyat">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol'da Yayınlansın </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option value="">Evet </option>
                                                        <option value="">Hayır </option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol Marka </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option value="42193">Ally</option>
                                                        <option value="35379">Ally Mobile</option>
                                                        <option value="986564" selected="">Ezere</option>
                                                        <option value="986708">Dux Ducis</option>
                                                        <option value="977847" selected="">Gor</option>
                                                        <option value="990277">Baseus</option>
                                                        <option value="1037170" selected="">North Bayou</option>
                                                        <option value="22014">Floveme</option>
                                                        <option value="204848" selected="">Puluz</option>
                                                        <option value="20026" selected="">Usams</option>
                                                        <option value="30057">Plextone</option>
                                                        <option value="276348" selected="">Haweel</option>
                                                        <option value="31736">Memo</option>
                                                        <option value="734551" selected="">Jakemy</option>
                                                        <option value="22015" selected="">Hoco</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Trendyol Kategorisi </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option></option>
                                                        <option value="368">Aksesuar</option>
                                                        <option value="403">Ayakkabı</option>
                                                        <option value="522">Giyim</option>
                                                        <option value="685">Hobi &amp; Eğlence</option>
                                                        <option value="687">Kitap</option>
                                                        <option value="758">Ev &amp; Mobilya</option>
                                                        <option value="790">Otomobil &amp; Motosiklet</option>
                                                        <option value="1070">Kozmetik &amp; Kişisel Bakım</option>
                                                        <option value="1071">Elektronik</option>
                                                        <option value="1216">Kırtasiye &amp; Ofis Malzemeleri</option>
                                                        <option value="1219">Süpermarket</option>
                                                        <option value="2469">Bahçe ve Yapı Market</option>
                                                        <option value="2862">Anne &amp; Bebek &amp; Çocuk</option>
                                                        <option value="3186">Spor &amp; Outdoor</option>
                                                        <option value="3981">Ek Hizmetler</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" style="margin-top: 20px;">

                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>Trendyol Bilgilerini Kaydet</i></button>
                                            </a>


                                        </div>

                                    </div>

                                </div>
                                <div class="card-body pazaryeri" id="ciceksepeti" style="display: none">
                                    <div class="col-12">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title m-0">Çiçeksepeti Ayarları</h5>

                                        </div>
                                        <hr>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çiçeksepeti Ürün Adı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Çiçeksepeti Ürün Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çiçeksepeti Komisyon % : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Çiçeksepeti Komisyon %">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çiçeksepeti Fiyatı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Çiçeksepeti Fiyatı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çiçeksepeti İndirim Etiket Tutarı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Çiçeksepeti İndirim Etiket Tutarı">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çiçeksepeti'nde Yayınlansın </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option value="">Evet </option>
                                                        <option value="">Hayır </option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çiçeksepeti Kategorisi </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option></option>
                                                        <option value="368">Çicek</option>
                                                        <option value="403">Yenilebilir Çicek</option>
                                                        <option value="522">Hediye</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" style="margin-top: 20px;">

                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>Çiçeksepeti Bilgilerini Kaydet</i></button>
                                            </a>
                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-success btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>Çiçeksepeti'nde Yayınla</i></button>
                                            </a>
                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-warning btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>Çiçeksepeti'nde Güncelle</i></button>
                                            </a>


                                        </div>

                                    </div>

                                </div>


                                <div class="card-body pazaryeri" id="n11" style="display: none">
                                    <div class="col-12">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title m-0">N11 Ayarları</h5>

                                        </div>
                                        <hr>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Ürün Adı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="N11 Ürün Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Ürün Fiyatı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="N11 Ürün Fiyatı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Sabit Fiyatı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="N11 Sabit Fiyatı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 İndirim Etiket Tutarı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="N11 İndirim Etiket Tutarı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Birleşme Rengi : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Ürün Hangi Renkte Birleşsin">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Çoklu İsimler Seçeneğe Dönüşsün</label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option value="">Evet </option>
                                                        <option value="">Hayır </option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Komisyon % : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="N11 Komisyon %">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">OEM : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Oem">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Kritik Stok Adedi : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="">
                                                </div>
                                            </div>
                                        </div>





                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11'de Yayınlansın : </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option></option>
                                                        <option >Evet</option>
                                                        <option >Hayır</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Katalog Id : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="N11 Katalog Id ">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">N11 Kategorisi : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Kategori Kodu ">
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-12" style="margin-top: 20px;">

                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>N11 Bilgilerini Kaydet</i></button>
                                            </a>
                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-success btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>N11'de Yenile</i></button>
                                            </a>
                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-danger btn-popup-form"style="margin-top: 10px;float:right ; margin-left: 10px;background-color: #58c9f3">
                                                    <i>N11'de Güncelle</i></button>
                                            </a>


                                        </div>

                                    </div>

                                </div>


                                <div class="card-body pazaryeri" id="pazarama" style="display: none">
                                    <div class="col-12">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="card-title m-0">Pazarama Ayarları</h5>

                                        </div>
                                        <hr>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Gördüm Aldım Ürün Adı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Gördüm Aldım  Ürün Adı">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Gördüm Aldım Komisyon % : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Gördüm Aldım  Komisyon %">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Gördüm Aldım  İndirim Etiket Tutarı : </label></div>
                                                <div class="col-sm-4">
                                                    <input type="text" class="form-control" name="" placeholder="Gördüm Aldım  İndirim Etiket Tutarı">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Gördüm Aldım 'da Yayınlansın </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option value="">Evet </option>
                                                        <option value="">Hayır </option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Gördüm Aldım  Marka Seçimi </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option></option>
                                                        <option value="f3a08ff4-13d1-4e83-abf8-97ff3005913a"> - - </option>
                                                        <option value="0b758736-cb49-4d79-a578-08d97dabde7e">Hawell</option>
                                                        <option value="67fd106e-ef77-4982-43d3-08d97e850492">Gor</option>
                                                        <option value="c99da465-55cb-4660-a577-08d97dabde7e">Duxducis</option>
                                                        <option value="890d337d-2e4d-482d-a576-08d97dabde7e">Mijobs</option>
                                                        <option value="8c8c4bac-9033-4923-90ff-47aa8aafabc2">Ally</option>
                                                        <option value="f3a08ff4-13d1-4e83-abf8-97ff3005913a">ally mobile</option>
                                                        <option value="6abf51ac-b5a0-4642-8a3b-f6a666e05a1a">Baseus</option>
                                                        <option value="947343c3-06b0-4c73-9883-6568d88a3ac2">Plextone</option>
                                                        <option value="2b75d62f-bcae-44e4-9781-7fdcb5a3707f">Kuulaa</option>
                                                        <option value="703735bc-04ad-4740-97fa-e56ec42ccff4">Northbayou</option>
                                                        <option value="f676f1bc-435c-4660-9cd0-2939b54f967e">Puluz</option>
                                                        <option value="fe97153e-bd79-49df-8167-667deb5641d0">Memo</option>
                                                        <option value="c99da465-55cb-4660-a577-08d97dabde7e">Duxducis</option>
                                                        <option value="cae92adf-aaf7-42b0-8720-3fb3859e7c5e">Ezere</option>
                                                        <option value="1fd030d8-f55f-4589-865d-798a163aabfb">Floveme</option>
                                                        <option value="2dfa454f-6934-4e04-97d1-73754e385b12">USAMS</option>
                                                        <option value="2e72717f-3b97-4a07-b86c-a505d354dc4a">Uslion</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="mb-1 row">
                                                <div class="col-sm-2"><label class="col-form-label" for="contact-info" style="font-size: 1rem">Gördüm Aldım  Kategorisi </label></div>
                                                <div class="col-sm-4">


                                                    <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                        <option></option>
                                                        <option value="">Kategori Seçiniz</option><option value="7fdb3777-613b-434a-8c6f-00de25cfe2ef" data-leaf="0" data-tree="">Kitap, Kırtasiye, Hobi, Ofis</option><option value="e3104621-4c09-4428-a0e3-03d88fe684ee" data-leaf="0" data-tree="">Elektronik</option><option value="583fdcb9-f33a-4b4d-8165-14b730c826b3" data-leaf="0" data-tree="">Oyun, Konsol ve Dijital Servisler</option><option value="892c16ef-6f4b-40b6-a250-204a4363148a" data-leaf="0" data-tree="">Ev, Yaşam, Yapı Market</option><option value="dce1de0b-840b-43e4-9aa5-3837d94835b4" data-leaf="0" data-tree="">Moda</option><option value="f0d9e9df-8ade-43ec-be98-68716b7bb742" data-leaf="0" data-tree="">Ayakkabı, Çanta ve Aksesuar</option><option value="390bcbfb-83c2-42e6-b63d-6a2e745f6d85" data-leaf="0" data-tree="">Kişisel Bakım ve Kozmetik</option><option value="d0c03783-8809-4675-8e29-a5467fa205f0" data-leaf="0" data-tree="">Otomobil, Motosiklet ve Aksesuarları</option><option value="5b4aea58-4a3d-41b8-84bb-a5eaf69ea252" data-leaf="0" data-tree="">Spor ve Outdoor</option><option value="8d46d6df-82f3-491c-9730-e5576fab651a" data-leaf="0" data-tree="">Süpermarket</option><option value="0ad99e6f-25fd-4e90-9e50-e8bd315cd02c" data-leaf="0" data-tree="">Anne Bebek</option><option value="06df4534-b915-4d85-990b-f374b2a6d27f" data-leaf="0" data-tree="">Cep Telefonu ve Aksesuar</option><option value="1787" data-leaf="1" data-tree="">0</option>


                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12" style="margin-top: 20px;">

                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>G&A Bilgilerini Kaydet</i></button>
                                            </a>
                                            <a href=" javascript:void(0)" ><button type="button" class="btn btn-success btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                                                    <i>G&A Yayınla</i></button>
                                            </a>



                                        </div>

                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-12" style="margin-top: 20px;">

                <a href=" javascript:void(0)" ><button type="button" class="btn btn-info btn-popup-form"style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                        <i>Sıfırla</i></button>
                </a>

                <button type="submit" class="btn btn-success "style="margin-top: 10px;margin-left: 10px;background-color: #58c9f3">
                    <i>Kaydet</i></button>




            </div>
        </div>


    </form>
    </section>
    <!--/ Advanced Search -->

@endsection


@section('vendor-script')
    {{-- vendor files --}}

@endsection

@section('page-script')
    {{-- Page js files --}}
    <script>

        TulparUploader.createUploder();

    </script>
    <script>
        document.getElementById('renkbtn').addEventListener('click', function () {
            var selectedOptions = document.getElementById('renkler').selectedOptions;
            var renkTablosuBody = document.getElementById('renkTablosu').getElementsByTagName('tbody')[0];

            // Renk listesini tabloya ekle
            for (var i = 0; i < selectedOptions.length; i++) {
                var renk = selectedOptions[i].value;

                var row = renkTablosuBody.insertRow();
                var cellRenk = row.insertCell(0);
                var cellBarkod = row.insertCell(1);
                var cellMiktar = row.insertCell(2);

                cellRenk.innerHTML = renk;

                cellMiktar.innerHTML = '<input type="text" class="form-control"  style="width: 100px">';
                cellBarkod.innerHTML = '<input type="text" class="form-control" style="width: 50px">';

            }
        });
    </script>
    <script>


        function openSpec(event, specName) {
            event.preventDefault(); // Bu satır, varsayılan davranışın engellenmesi için eklenmiştir.

            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabspec");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByTagName("a");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(specName).style.display = "block";
            event.currentTarget.classList.add("active");
        }




    </script>
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
    <script>
        document.getElementById('mainCategory').addEventListener('change', function () {
            var selectedCategoryId = this.value;

            // Hide all subcategories initially
            document.querySelectorAll('.subCategory').forEach(function (option) {
                option.style.display = 'none';
            });

            // Show subcategories for the selected main category
            document.querySelectorAll('.subCategory[data-parent="' + selectedCategoryId + '"]').forEach(function (option) {
                option.style.display = '';
            });

            // Show or hide the second dropdown based on selection
            document.getElementById('subCategory').style.display = selectedCategoryId !== '' ? '' : 'none';
        });
    </script>
    <script>
        function addSubcategory() {
            // Seçilen ana kategori
            var mainCategoryId = document.getElementById('mainCategory').value;

            if (mainCategoryId !== '') {
                // Tüm alt kategori seçimlerini gizle
                var subCategories = document.getElementsByClassName('subCategory');
                for (var i = 0; i < subCategories.length; i++) {
                    subCategories[i].style.display = 'none';
                }

                // Seçilen ana kategoriye bağlı olan alt kategorileri göster
                var selectedSubCategories = document.querySelectorAll('.subCategory[data-parent="' + mainCategoryId + '"]');
                for (var j = 0; j < selectedSubCategories.length; j++) {
                    selectedSubCategories[j].style.display = 'inline-block';
                }
            }
        }
    </script>

    <script>


        function openSpec(event, specName) {
            event.preventDefault(); // Bu satır, varsayılan davranışın engellenmesi için eklenmiştir.

            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("tabspec");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }
            tablinks = document.getElementsByTagName("a");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }
            document.getElementById(specName).style.display = "block";
            event.currentTarget.classList.add("active");
        }
        function pazaryeriTab(event, specName) {
            event.preventDefault(); // Bu satır, varsayılan davranışın engellenmesi için eklenmiştir.

            var i, tabcontent, tablinks;
            tabcontent = document.getElementsByClassName("pazaryeri"); // "tabspec" yerine "pazaryeri" sınıfını kullan
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            tablinks = document.getElementsByClassName("card-body pazaryeri"); // "a" yerine "card-body pazaryeri" sınıfını kullan
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }

            document.getElementById(specName).style.display = "block";
            event.currentTarget.classList.add("active");
        }

        function kategori(){

            var alt =document.getElementById("altkategori")
            alt.style.display="block"

        }


    </script>

@endsection
