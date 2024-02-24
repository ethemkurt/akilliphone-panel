
@extends('layouts/contentLayoutMaster')

@section('title', 'Sipariş Detayı')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection



@section('content')

    <!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="col-md-12">
                <div class="card full-height mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="card-title m-0">Genel Tanımlar</h5>


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                   <b> <label class="col-form-label col-4" for="first-name">Ürün Kodu:</label></b>
                                    <div class="col-9">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Ürün Kodu">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                   <b> <label class="col-form-label col-4" for="last-name">Ana Ürün Kodu:</label></b>
                                    <div class="col-9">
                                        <input value="" type="text" class="form-control" name="order[customer][lastName]" id="last-name" placeholder="Ana Ürün Kodu">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b>  <label class="col-form-label col-4" for="email">Muhasebe Açıklama</label></b>
                                        <div class="col-9">
                                        <input value="" type="text" class="form-control" name="order[customer][email]" id="email" placeholder="Muhasebe Açıklama">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Ürün Adı :</label></b>
                                    <div class="col-11">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Ürün Adı">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Ürün Seçenek Etiketi :</label></b>
                                    <div class="col-10">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Ürün Seçenek Etiketi">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Ürün Seçenek Türü :</label></b>
                                    <div class="col-10">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option value=""> Renk </option>
                                            <option value=""> Beden </option>
                                            <option value=""> Numara </option>
                                            <option value=""> Malzeme </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Satış Fiyatı :</label></b>
                                    <div class="col-10">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Satış Fiyatı">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Para Birimi :</label></b>
                                    <div class="col-10">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option value=""> USD </option>
                                            <option value=""> EUR </option>
                                            <option value=""> TL </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Bayi Fiyatı :</label></b>
                                    <div class="col-10">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Bayi Fiyatı">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Ürün Bölümü :</label></b>
                                    <div class="col-10">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Ürün Bölümü">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Alış Fiyatı :</label></b>
                                    <div class="col-10">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Alış Fiyatı">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">KDV :</label></b>
                                    <div class="col-10">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option value=""> KDV %18 </option>
                                            <option value=""> KDV %8 </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Ürün Tagı Çekme :</label></b>
                                    <div class="col-10">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Ürün Tagı Çekme">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Ürün Birimi :</label></b>
                                    <div class="col-10">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option value="0"> --- Kullanılmayacak --- </option>
                                            <option value="2" selected="">Adet</option>
                                            <option value="3">Cm</option>
                                            <option value="4">Düzine</option>
                                            <option value="5">Gr</option>
                                            <option value="6">Kg</option>
                                            <option value="7">Kişi</option>
                                            <option value="8">Paket</option>
                                            <option value="9">Metre</option>
                                            <option value="10">m2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Kampanya Fiyatı :</label></b>
                                    <div class="col-9">
                                        <input value="" type="text" class="form-control" name="order[customer][firstName]" id="first-name" placeholder="Kampanya Fiyatı ">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="last-name">Sepet Limiti :</label></b>
                                    <div class="col-9">
                                        <input value="" type="text" class="form-control" name="order[customer][lastName]" id="last-name" placeholder="Sepet Limiti">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b>  <label class="col-form-label col-4" for="email">İndirimsiz Fiyatı : </label></b>
                                    <div class="col-9">
                                        <input value="" type="text" class="form-control" name="order[customer][email]" id="email" placeholder="İndirimsiz Fiyatı">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div style="align-items: center;display: flex; justify-content: center;padding: 30px;"> <h1> Ürün Özellikleri</h1></div>
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title m-0">Ürün Özellikleri</h5>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name"> </label></b>
                                    <div class="col-12">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option data-ordernumber="0" selected="selected" value="">-- Özellik Grubu Seçiniz --</option>
                                            <option data-ordernumber="0" value="2">
                                                Alt Özellikler </option>
                                            <option data-ordernumber="0" value="120">
                                                İlişkiler </option>
                                            <option data-ordernumber="0" value="1">
                                                Üst Özellikler </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="last-name"> </label></b>
                                    <div class="col-12">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option value="79">Malzeme</option><option value="70">Şarj Kablo Çıkışı</option><option value="94">Şarj - Data Kablo Giriş A uç</option><option value="97">Şarj - Data Kablo Giriş B uç</option><option value="109">Kablo Uzunluğu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="last-name"> </label></b>
                                    <div class="col-12">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                            <option value="121">Genel</option><option value="184">Ses 3.5mm</option><option value="189">USB Mikro</option><option value="190">Type-C</option><option value="191">Iphone</option><option value="204">samsung</option><option value="206">Wireless Şarj Ürünleri</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title m-0"> </h5>
                                <h6 class="m-0"><a href=" javascript:void(0)"><button type="button" class="btn btn-danger btn-popup-form" data-url="{{ route('order.find-product-form') }}"><i class="feather icon-plus"></i></button></a></h6>
                            </div>
                            <div class="card-datatable table-responsive">
                                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                    <table class="datatables-order-details table border-top dataTable no-footer dtr-column"
                                           id="DataTables_Table_0" style="width: 802px;">
                                        <thead>
                                        <tr>
                                            <th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1"
                                                style="width: 0px; display: none;" aria-label=""></th>
                                            <th class="w-50 sorting_disabled" rowspan="1" colspan="1" style="width: 296px;"
                                                aria-label="products">Group
                                            </th>
                                            <th class="w-25 sorting_disabled" rowspan="1" colspan="1" style="width: 124px;"
                                                aria-label="price">Özellik
                                            </th>
                                            <th class="w-25 sorting_disabled" rowspan="1" colspan="1" style="width: 115px;"
                                                aria-label="qty">Değer
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" style="width: 53px;"
                                                aria-label="total">

                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                            <tr class="odd">
                                                <td class="  control" tabindex="0" style="display: none;"></td>
                                                <td class="sorting_1">
                                                    <div class="d-flex justify-content-start align-items-center text-nowrap">
                                                        <div class="avatar-wrapper">
                                                            <div class="avatar me-2"><img src="" class="rounded-2"></div>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="text-body mb-0 text-wrap">Deneme</h6>

                                                        </div>
                                                    </div>
                                                </td>
                                                <td><span>Deneme2</span></td>
                                                <td><span class="text-body">Deneme3</span></td>

                                                <td><button class="btn btn-primary delete-order-item"><i class="menu-icon tf-icons ti ti-trash"></i></button></td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                        <div class="row" style="margin-top:50px; ">

                            <div class="col-sm-12">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Özel Uyarı :</label></b>
                                    <div class="col-12">
                                        <textarea name="order[billingAddress][addressLine1]" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-sm-12">
                                <div class="mb-1 row align-items-center">
                                    <b> <label class="col-form-label col-4" for="first-name">Kategori :</label></b>
                                    <div class="col-10">
                                        <select id="ShippingCompany" class="select-with-name form-select" data-nametarget=".select-district" name="order[shippingCompany]">
                                        <option data-ordernumber="0" selected="selected" value="-1">-- Kategori Seçiniz --</option>
                                        <option data-ordernumber="4" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="207">Aksesuarlar</option>
                                        <option data-ordernumber="1" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="217">Diğer Ürünler</option>
                                        <option data-ordernumber="0" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="327">Ev Yaşam</option>
                                        <option data-ordernumber="1" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="209">Kablolar ve Dönüştürücüler</option>
                                        <option data-ordernumber="0" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="203">Şarj Aletleri</option>
                                        <option data-ordernumber="999" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="157">Ses Sistemleri</option>
                                        <option data-ordernumber="1" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="168">Tamir Malzemeleri</option>
                                        <option data-ordernumber="5" data-usecolor="0" data-productsets="-1" data-productproperties="-1" value="179">Yedek Parçalar</option>
                                        </select>
                                       <a href=" javascript:void(0)"><button type="button" class="btn btn-danger btn-popup-form" data-url="{{ route('order.find-product-form') }}"><i class="feather icon-plus"></i></button></a>

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
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
