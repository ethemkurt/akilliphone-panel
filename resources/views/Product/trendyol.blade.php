
@extends('layouts/contentLayoutMaster')

@section('title', 'Trendyol')

@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
    <style>
        .form-control.spec-value, .form-select.spec-value {
            width: 80%;
            float: right;
        }
    </style>
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
                        <h5 class="card-title m-0">Trendyol Özellikleri</h5>


                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="code">Kategori</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <select class="nextselect form-select" data-nexturl="{{ route('trendyol.category') }}">
                                            <option value=""> -- </option>
                                            @foreach($trendyol_categories as $trendyol_category)
                                                <option value="{{ $trendyol_category['id'] }}">{{ $trendyol_category['name'] }}</option>
                                            @endforeach
                                        </select>
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
<script>
    $('body').on('change', '.nextselect', function(){
        $(this).nextAll().remove();
        $.ajax( {
            url:$(this).data('nexturl')+ '?categoryId=' + $(this).val(),
            target:$(this)[0],
        } )
            .done(function(select) {
               console.log(this);
               $(this.target).after(select)
            })
            .fail(function() {
                alert( "error" );
            });
    })
</script>
@endsection
