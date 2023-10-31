
@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün List')

@section('content')

    <!-- Basic table -->
    <section id="basic-datatable">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-12">
                            <x-button type="button" buttonType="primary waves-effect waves-light mt-lg-0 mt-1" value="Submit" name="submit" label='<i data-feather="file-plus"></i> Yeni Ürün Ekle' />
                        </div>
                    </div>
                    <table class="datatables-basic table">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>id</th>
                            <th>Logo</th>
                            <th>Marka</th>
                            <th>Durumu</th>
                            <th>İşlemler</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
    <!--/ Basic table -->
@endsection


@section('vendor-script')
    {{-- vendor files --}}

@endsection
@section('page-script')
    {{-- Page js files --}}
    <script src="{{ asset(mix('js/scripts/tables/table-datatables-basic.js')) }}"></script>
@endsection
