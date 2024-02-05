
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
        .tablist li{
            background-color: #f2f2f2;
            border-radius: 5px;
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
                                             <input value="" type="text" class="form-control" name="" placeholder="Ürün kodu">
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
                                             <input value="" type="text" class="form-control" name="" placeholder="Ürün Adı">
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="mb-1 row">
                                         <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Etiketi</label></div>
                                         <div class="col-sm-9">

                                             <input value="" type="text" class="form-control" name="" placeholder="Ürün Etiketi">


                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="mb-1 row">
                                         <div class="col-sm-3"><label class="col-form-label" for="contact-info">Ürün Markası</label></div>
                                         <div class="col-sm-9">
                                             <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                 <option value="">Marka Seçiniz </option>
                                                 <option value="">Baseus </option>
                                                 <option value="">Ally </option>
                                                 <option value="">Diğer</option>

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
                                             <select id="" class="select-with-name form-select" data-nametarget="" name="">
                                                 <option value="">USD</option>
                                                 <option value="">EUR </option>
                                                 <option value="">TRY </option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12">
                                     <div class="mb-1 row">
                                         <div class="col-sm-3"><label class="col-form-label" for="contact-info">Satış Fiyatı</label></div>
                                         <div class="col-sm-9">
                                             <input type="text" class="form-control" name="" placeholder="Satış Fiyatı">
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
                                             <input type="text" class="form-control" name="" placeholder="İndirimsiz Fiyat">
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
                                             <select id="" class="select-with-name form-select" data-nametarget="" name="" onchange="kategori()">
                                                 <option value="">Aksesuarlar</option>
                                                 <option value="">Ev yaşam</option>
                                                 <option value="">Şarj Aletleri</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <div class="col-12" style="display: none" id="altkategori">
                                     <div class="mb-1 row">
                                         <div class="col-sm-3"><label class="col-form-label" for="contact-info">Alt Kategori</label></div>
                                         <div class="col-sm-9">
                                             <select  class="select-with-name form-select" data-nametarget="" name="" >
                                                 <option value="" selected>Alt Kategori Seçiniz</option>
                                                 <option value="">Ev yaşam</option>
                                                 <option value="">Şarj Aletleri</option>
                                             </select>
                                         </div>
                                     </div>
                                 </div>
                                 <h6 class="m-0">
                                     <a href=" javascript:void(0)"><button type="button" class="btn btn-danger btn-popup-form">
                                             <i class="feather icon-plus"></i></button>
                                     </a></h6>

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
                                             <select  class="select-with-name form-select" id="renkler" name="renkler" multiple style="height: 150px">
                                                 <option value="kirmizi">Kırmızı</option>
                                                 <option value="yesil">Yeşil</option>
                                                 <option value="mavi">Mavi</option>
                                                 <option value="sari">Sarı</option>
                                                 <option value="turuncu">Turuncu</option>
                                                 <option value="kirmizi">Kırmızı</option>
                                                 <option value="yesil">Yeşil</option>
                                                 <option value="mavi">Mavi</option>
                                                 <option value="sari">Sarı</option>
                                                 <option value="turuncu">Turuncu</option>
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
                                     <a href=" javascript:void(0)"><button type="button" class="btn btn-danger btn-popup-form" id="renkbtn">
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
             <div class="col-12" >
                 <div class="row equal mb-3">
                     <div class="col-md-12" >
                         <textarea id="myTextarea" style="height: 500px;"></textarea>

                         </div>
                     </div>

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

                         </div>
                     </div>
                 </div>
             </div>
         </div>

         </div>

     </div>

  </section>
  <!--/ Advanced Search -->

@endsection


@section('vendor-script')
{{-- vendor files --}}

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="https://cdn.tiny.cloud/1/7d3q2hlbrmnp7cekakiuvxoeujxh8vedk8rsj7rezkl292c1/tinymce/5/tinymce.min.js"></script>
  <script>
      tinymce.init({
          selector: '#myTextarea'
      });
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
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
