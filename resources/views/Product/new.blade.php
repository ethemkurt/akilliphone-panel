
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
         <div class="tabspec" id="stokkategori">
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


     </div>

  </section>
  <!--/ Advanced Search -->

@endsection


@section('vendor-script')
{{-- vendor files --}}

@endsection

@section('page-script')
  {{-- Page js files --}}
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

      function kategori(){
          console.log("asd")
             var alt =document.getElementById("altkategori")
          alt.style.display="block"

      }


  </script>
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
