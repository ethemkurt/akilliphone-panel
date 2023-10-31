
@extends('layouts/contentLayoutMaster')

@section('title', 'Kullanıcı Yetkileri')

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
                            <th>id</th>
                            <th>Kod</th>
                            <th>Ad</th>
                            <th>Durum</th>
                            <th>İşlemeler</th>
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
