
@extends('layouts/contentLayoutMaster')

@section('title', 'Kategori Öğreticisi')

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
                        <h5 class="card-title m-0">Kategori Seçiniz</h5>

                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 category-row">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="code">Kategori Seçiniz</label>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="input-group main-category-select">
                                            <select class="form-select" data-nexturl="{{ route('trendyol.category') }}">
                                                <option value=""> -- </option>
                                                @foreach($categories as $category)
                                                    <option value="{{ $category['categoryId'] }}">{{ $category['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-success waves-effect select-categories" type="button"><i class="tf-icons ti ti-plus" style="color: #FFFFFF"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-1 row">
                                    <div class="col-sm-3">
                                        <label class="col-form-label" for="code">Seçilen Kategoriler</label>
                                    </div>
                                    <div id="selected-categories" class="col-sm-9 row">

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

    $('body').on('change', '.main-category-select select', function(){
        $(this).parents('.category-row').nextAll('.category-row').remove();

        $.ajax( {
            url: '{{ route('category.category-select') }}?categoryId=' + $(this).val(),
            target:$(this).parents('.category-row')[0],
        } )
            .done(function(select) {
                $(this.target).after(select)
            })
            .fail(function() {
                //alert( "error" );
            });
    });
    $('body').on('click', '.select-categories', function(){
        $('.main-category-select option:selected').each(function() {
            if(!$('body').find('#selected-'+$(this).val()).length){
                $('#selected-categories').append( get_selected_category($(this)) );
            }
        });
    });
    function get_selected_category(el){
        console.log(el.text(), el.val(), el.html());
        let id = 'selected-' + el.val();
        let value = el.val();
        let text = el.text();
        let html = `<div class="col-sm-4 mb-1"><input id="${id}" name="productCategories[]" type="hidden" value="${value}"><div class="input-group input-group-merge"><input type="text" disabled class="form-control"  value="${text}"><button class="btn btn-danger" type="button"><i class="tf-icons ti ti-minus" style="color: #FFFFFF"></i></button></div></div>`;
        return html;
    }
</script>
@endsection
