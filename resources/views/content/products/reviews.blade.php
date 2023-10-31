
@extends('layouts/contentLayoutMaster')

@section('title', 'Ürün Birimleri')

@section('content')

    <!-- Basic table -->
    <section id="basic-datatable">

        <div class="row">

            <div class="col-12">
                <div class="card">
                    <table class="datatables-basic table">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>Tarih</th>
                            <th>Ad Soyad</th>
                            <th>Ürün</th>
                            <th>Oy</th>
                            <th>İçerik</th>
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
