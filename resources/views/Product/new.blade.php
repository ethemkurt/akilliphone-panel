
@extends('layouts/contentLayoutMaster')

@section('title', 'Yeni Sipariş')

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
            <div class="col-md-3">
                <select name="userRole" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                    <option value="">Ödeme Türü</option>
                    @foreach(Enum::list('PaymentType') as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <x-inputs.text-input label="Fatura No'ya Göre Ara" placeholder="Fatura No'ya Göre Ara" name="search_receipt_no" />
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
