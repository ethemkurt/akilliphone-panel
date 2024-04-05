
<div id="product-stock" class="content">
    <div class="row equal mb-3">
        <form action="{{route('product.addCategories')}}" method="post" id="productCategoryForm">
            @csrf
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
                                        <select class="form-select" data-nexturl="{{ route('product.catlist') }}">
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
                                    @if(isset($product['productCategories']))
                                        @if($product['productCategories']!=[])
                                            @foreach($product['productCategories'] as $catlist)
                                                <div class="col-sm-4 mb-1">
                                                    <input id="{{$catlist['categoryId']}}" name="productCategories[]" type="hidden" value="{{$catlist['categoryId']}}">
                                                    <div class="input-group input-group-merge">
                                                        <input type="text" disabled class="form-control"  value="{{$catlist['category']['name']}}">
                                                        <button class="btn btn-danger" type="button">
                                                            <i class="tf-icons ti ti-minus" style="color: #FFFFFF">

                                                            </i>
                                                        </button>
                                                    </div>
                                                </div>

                                            @endforeach

                                        @endif

                                    @endif
                                </div>


                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i data-feather="save"></i>
                        <span class="align-middle">Kaydet</span>
                    </button>

                </div>
            </div>
        </div>
            <input type="text" value="" id="categoryId" name="productId" style="display: none">
        </form>
        <form action="{{route('product.addStock')}}" method="post" id="productStockForm">
            @csrf

        <div class="col-md-12" >
            <div class="card full-height mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title m-0">Stok Bilgisi</h5>

                </div>
                <div class="card-body">

                    <div class="col-12">
                        <div class="mb-1 row">
                            <div class="col-sm-3"><label class="col-form-label" for="contact-info">Renk</label></div>
                            <div class="col-sm-9" style="width: 100%;">
                                <select class="select-with-name form-select" id="renkler" name="variant[name]" multiple style="height: 150px">

                                    @foreach($colors as $color)

                                        <option value="{{$color['optionValueId']}}">{{$color['value']}}</option>
                                    @endforeach


                                </select>
                            </div>
                        </div>
                    </div>
                    <h6 class="m-0">
                      <button type="button" class="btn btn-danger" id="renkbtn">
                          <i class="tf-icons ti ti-plus"></i></button>
                      </h6>
                    <table id="renkTablosu">
                        <thead>
                        <tr>
                            <th>Renk</th>
                            <th>Resim</th>
                            <th>Miktar</th>
                            <th>Barkod</th>
                        </tr>
                        </thead>
                        <tbody>



                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary" style="margin-top: 15px">
                        <i data-feather="save"></i>
                        <span class="align-middle">Kaydet</span>
                    </button>



                </div>
            </div>
        </div>
            <input type="text" value="" id="stockId" name="productId" style="display: none">
        </form>
    </div>
</div>

</form>
