<form  method="post" action="{{ route('product.brand-save') }}" enctype="multipart/form-data" >
    @csrf

    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="mainCategory"> Anakategori </label>
                </div>
                <div class="col-sm-9">
                    <select id="mainCategory"  class="form-control" name="categories[cat1]" >
                        <option value="" disabled selected>Lütfen bir ana kategori seçin</option>

                            @foreach($categories as $mainCategories)

                                @if($mainCategories['parentId']==null)
                                <option value="{{$mainCategories['categoryId']}}">{{$mainCategories['name']}}</option>
                                @endif

                            @endforeach

                    </select>

                    <select id="subCategory" class="form-control" name="categories[cat2]">
                        <option value="" disabled selected>Alt kategori seçin</option>
                    </select>

                </div>
                <div id="subcategoriesContainer"></div>

            </div>
        </div>
        <div class="col-sm-9 offset-sm-3">
            <input type="hidden" name="image_default" value="">
            @if(isset($brand['brandId']))
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
            @else
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Oluştur</button>
            @endif
            <input type="hidden" name="brand[brandId]" value="{" />
        </div>
    </div>

</form>


