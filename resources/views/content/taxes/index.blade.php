
@extends('layouts/contentLayoutMaster')

@section('title', 'Vergi Tanımları')


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
                            <th>ID</th>
                            <th>ID</th>
                            <th>Vergi Adı</th>
                            <th>Vergi Oranı</th>
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
