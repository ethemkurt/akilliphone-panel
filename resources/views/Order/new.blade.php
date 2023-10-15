
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
            <div class="col-md-4 user_role">
                <select name="userRole" id="UserRole" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
                    <option value="">Ödeme Türü</option>
                    @foreach(Enum::list('PaymentType') as $key=>$val)
                        <option value="{{ $key }}">{{ $val }}</option>
                    @endforeach
                </select>
            </div>

        </div>
      </div>
    </div>
  </section>
  <!--/ Advanced Search -->

@endsection


@section('vendor-script')
{{-- vendor files --}}
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
