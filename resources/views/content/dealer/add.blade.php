@extends('layouts/contentLayoutMaster')

@section('title', 'Adres Ekle')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
@endsection

@section('content')
<div class="col-xl">
    <div class="card mb-4">
      <div class="card-header d-flex justify-content-between align-items-center">
      </div>
      <div class="card-body">
        <ul class="nav nav-pills">
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-bs-toggle="pill" href="#home" aria-expanded="true">Üye Bilgileri</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-bs-toggle="pill" href="#address" aria-expanded="false"
                >Adres Bilgileri</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" id="about-tab" data-bs-toggle="pill" href="#payment" aria-expanded="false">Ödeme ve Kargo</a>
            </li>
          </ul>
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="home" aria-labelledby="home-tab" aria-expanded="true">
                <form id="jquery-val-form" method="post">
                    <div class="mb-1">
                      <label class="form-label" for="basic-default-name">Ad</label>
                      <input
                        type="text"
                        class="form-control"
                        id="basic-default-name"
                        name="basic-default-name"
                        placeholder="John Doe"
                      />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="basic-default-name">Soyad</label>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-default-name"
                          name="basic-default-name"
                          placeholder="John Doe"
                        />
                      </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-default-email">Email</label>
                      <input
                        type="text"
                        id="basic-default-email"
                        name="basic-default-email"
                        class="form-control"
                        placeholder="john.doe@email.com"
                      />
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="select-country">Üyelik Tipi</label>
                        <select class="form-select" id="select-country" name="select-country">
                          <option value="">Üyelik Tipi Seçiniz</option>
                          <option value="usa">Üye Genel</option>
                          <option value="usa">Bayiler</option>
                        </select>
                      </div>
                    <div class="mb-1">
                      <label class="form-label" for="basic-default-password">Şifre</label>
                      <input
                        type="password"
                        id="basic-default-password"
                        name="basic-default-password"
                        class="form-control"
                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      />
                    </div>
                    <div class="mb-1">
                            <label class="form-label" for="fp-default">Doğum Tarihi</label>
                            <input type="text" id="fp-default" class="form-control flatpickr-basic" placeholder="YYYY-MM-DD" />
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="basic-default-name">TC Kimlik No</label>
                        <input
                          type="text"
                          class="form-control"
                          id="basic-default-name"
                          name="basic-default-name"
                          placeholder="John Doe"
                        />
                      </div>
                      <div class="mb-1">
                        <label class="form-label" for="select-country">E-Bülten Üyelik</label>
                        <select class="form-select" id="select-country" >
                          <option value="usa">Evet</option>
                          <option value="usa">Hayır</option>
                        </select>
                      </div>
                    <div class="mb-1">
                      <label class="d-block form-label">Cinsiyet</label>
                      <div class="form-check my-50">
                        <input type="radio" id="validationRadiojq1" name="validationRadiojq" class="form-check-input" />
                        <label class="form-check-label" for="validationRadiojq1">Erkek</label>
                      </div>
                      <div class="form-check">
                        <input type="radio" id="validationRadiojq2" name="validationRadiojq" class="form-check-input" />
                        <label class="form-check-label" for="validationRadiojq2">Kadın</label>
                      </div>
                    </div>
                    <div class="mb-1">
                        <label class="form-label" for="select-country">Satın Almadan Yorum</label>
                        <select class="form-select" id="select-country" >
                          <option value="usa">Yapabilir</option>
                          <option value="usa"></option>
                        </select>
                      </div>
                    <button type="submit" class="btn btn-primary" name="submit" value="Submit">Kaydet</button>
                  </form>
            </div>
            <div class="tab-pane" id="address" role="tabpanel" aria-labelledby="address-tab" aria-expanded="false">
                <button type="button" class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                   Adres Ekle
                  </button>
                    <div class="table-responsive">
                        <table class="table">
                          <thead>
                            <tr>
                              <th>Adres Açıklama</th>
                              <th>Adres</th>
                              <th>Adres Türü</th>
                              <th>İşlem</th>
                            </tr>
                          </thead>
                          <tbody class="table-border-bottom-0">
                            <tr>
                              <td>Empty</td>
                              <td>Empty</td>
                              <td>Empty</td>
                              <td>Empty</td>
                            </tr>
                        </table>
                      </div>
                      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="row g-2">
                                        <div class="col-md-6 col-12">
                                            <x-inputs.text-input name="product_name" label="Adres Açıklama"
                                                placeholder="" />
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <x-inputs.text-input name="product_name" label="Ülke"
                                                placeholder="" />
                                        </div>
                                        @php
                                        $city = [
                                            [
                                                'name' => "Şehir",
                                                'value' => 'city',
                                            ],
                                        ];
                                    @endphp
                                    <div class="col-md-6 col-12">
                                        <x-inputs.select-input :items="$city" label="Şehir" name="city" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.select-input :items="$city" label="Semt" name="city" />
                                    </div>
                                    <div class="col-12">
                                        <x-inputs.text-input name="product_name" label="Adres"
                                            placeholder="" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.select-input :items="$city" label="Adres Tipi" name="city" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.text-input name="product_name" label="Telefon"
                                            placeholder="" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.text-input name="product_name" label="Cep Telefonu"
                                            placeholder="" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.text-input name="product_name" label="İş Telefonu"
                                            placeholder="" />
                                    </div>
                                    <div class="col-12">
                                        <x-inputs.text-input name="product_name" label="Firma Adı"
                                            placeholder="" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.text-input name="product_name" label="Vergi Dairesi"
                                            placeholder="" />
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <x-inputs.text-input name="product_name" label="Vergi No"
                                            placeholder="" />
                                    </div>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary">Kaydet</button>
                            </div>
                          </div>
                        </div>
                      </div>
            </div>
            <div class="tab-pane" id="payment" role="tabpanel" aria-labelledby="payment-tab" aria-expanded="false">
             <form action="#">
                <div class="table-responsive">
                    <table class="table">
                      <thead>
                        <tr>
                          <th>İşlem</th>
                          <th>Durum</th>
                        </tr>
                      </thead>
                      <tbody class="table-border-bottom-0">
                        <tr>
                          <td><label class="form-check-label" for="creditCard">Kredi Kartı</label></td>
                          <td>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="creditCard" checked />
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="form-check-label" for="eft">Havale EFT</label></td>
                            <td>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="eft" checked />
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="form-check-label" for="cash">Kapıda Nakit</label></td>
                            <td>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="cash" checked />
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="form-check-label" for="payu">Payu İle Ödeme</label></td>
                            <td>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="payu" checked />
                              </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label class="form-check-label" for="motoCourier">Moto-kurye İle Ödeme</label></td>
                            <td>
                              <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="motoCourier" checked />
                              </div>
                             </td>
                        </tr>
                        <tr>
                            <td><label class="form-check-label" for="dropshipping">Drop Shipping</label></td>
                            <td>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="dropshipping" checked />
                                </div>
                            </td>
                        </tr>
                    </table>
                  </div>
             </form>
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
  <script src="{{ asset(mix('js/scripts/forms/pickers/form-pickers.js')) }}"></script>
@endsection
