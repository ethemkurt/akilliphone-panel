
@extends('layouts/contentLayoutMaster')

@section('title', 'Yeni Sipariş')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection



@section('content')

<!-- Advanced Search -->

<form name="order" method="POST">
    @csrf
<section id="advanced-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="row g-1" style="margin: 25px">
            <h1>Müşteri Bilgileri </h1>
            <div class="col-md-3">
                <x-inputs.text-input label="Müsteri Adı:" placeholder="Müşteri Adı" name="order[customer][firstName]"/>
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Müşteri Soyadı:" placeholder="Müşteri Soyadı" name="order[customer][lastName]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Müşteri Tc Kimlik:" placeholder="Müşteri Tc Kimlik" name="order[customer][tcKimlik]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Müşteri Telefon Numarası:" placeholder="Müşteri Telefon Numarası" name="order[customer][phone]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Müşteri E-mail:" placeholder="Müşteri E-mail" name="order[customer][email]" />
            </div>
            </div>
            <div class="row g-1" style="margin: 25px">
                <h1>Kargo Bilgileri </h1>
            <div class="col-md-3">
                <x-inputs.text-input label="Adres Adı:" placeholder="Adres Adı" name="order[shippingAddress][name]" />
            </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Alıcı Ad:" placeholder="Ad" name="order[shippingAddress][firstName]" />
                </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Alıcı Soyad:" placeholder="Soyad" name="order[shippingAddress][lastName]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Adres Satırı 1:" placeholder="Adres Satırı 1 " name="order[shippingAddress][addressLine1]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Adres Satırı 2:" placeholder="Adres Satırı 2" name="order[shippingAddress][addressLine2]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Ülke :" placeholder="Ülke" name="order[shippingAddress][country]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Şehir :" placeholder="Şehir" name="order[shippingAddress][city]" />
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="İlçe:" placeholder="İlçe" name="order[shippingAddress][district]" />
            </div>
            <div class="col-md-3">
                    <x-inputs.text-input label="Telefon Numarası :" placeholder="Telefon Numarası" name="order[shippingAddress][phone]" />
            </div>
            </div>
            <div class="row g-1" style="margin: 25px">
                <h1>Fatura Bilgileri </h1>
                <div class="col-md-3">
                    <x-inputs.text-input label="Fatura Adı:" placeholder="Fatura Adı" name="order[billingAddress][name]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Ad:" placeholder="Ad" name="order[billingAddress][firsName]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Soyad:" placeholder="Soyad" name="order[billingAddress][lastName]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Adres Satırı 1:" placeholder="Adres Satırı 1 " name="order[billingAddress][addressLine1]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Adres Satırı 2:" placeholder="Adres Satırı 2" name="order[billingAddress][addressLine2]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Ülke :" placeholder="Ülke" name="order[billingAddress][country]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Şehir :" placeholder="Şehir" name="order[billingAddress][city]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="İlçe:" placeholder="İlçe" name="order[billingAddress][district]" />
                </div>
                <div class="col-md-3">
                    <x-inputs.text-input label="Fatura Tipi :" placeholder="Fatura Tipi" name="order[billingAddress][phone]" />
                </div>
            </div>

            <div class="col-md-4 user_role">
                <select name="order[paymentTypeId]" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                    <option value="">Ödeme Türü</option>
                    @foreach(\Enum::list('PaymentType') as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
                <select name="order[orderStatusId]" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                    @foreach(\Enum::list('OrderStatus') as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
                <select name="order[paymentStatusId]" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                    @foreach(\Enum::list('PaymentStatus') as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
                <select id="product-select" style="width: 300px;" name="products[]">
                    <option></option> <!-- Placeholder -->
                     @foreach ($products as $product)
                        @if($product['variants'])
                            @foreach($product['variants'] as $variants)
                                <option value="<?php echo $product['productId'] . '|' . $variants['variantId']?>"><?php echo $product['name']; ?>(<?php echo $variants['name']?>)</option>
                            @endforeach
                        @endif
                    @endforeach
                </select>


            </div>
        </div>
      </div>
    </div>
  </section>
    <button type="submit">Gönder</button>
</form>
  <!--/ Advanced Search -->
@endsection


@section('vendor-script')
{{-- vendor files --}}
<script>

    $(document).ready(function() {
        $('#product-select').select2({
            placeholder: 'Ürün seçin',
            minimumInputLength: 1
        });
    });
    var selectElement = document.getElementById('product-select');
    var selectedValue = selectElement.value;


</script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.rowGroup.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
@endsection
