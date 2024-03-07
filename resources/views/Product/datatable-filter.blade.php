<div class="row g-1">
    <div class="col-md-3">
        <x-inputs.text-input class="datatable-filter" label="Ada Göre Ara" placeholder="Ada Göre Ara" name="search_name" />
    </div>
    <div class="col-md-3">
        <label class="form-label" for="brandId">Markaya Göre</label>
        <select name="brandId" id="brandId" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Marka Seçiniz</option>
            @foreach($brands['items'] as $key=>$brand)
                <option value="{{ $key }}">{{ $brand['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label" for="brandId">Kategoriye Göre</label>
        <select name="categoryId" id="categoryId" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Kategoriye Seçiniz</option>
            @foreach($categories['items'] as $key=>$category)
                <option value="{{ $key }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <x-inputs.text-input class="datatable-filter" label="Ürün Koduna Göre Ara" placeholder="Ürün Koduna Göre Ara" name="search_product_code" />
    </div>
</div>
<div class="row g-1 mt-1">
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Aktif" :checked="'checked'" :id="'search_active_active'" name="search_active" />
    </div>
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Pasif" :id="'search_active_passive'" name="search_active" />
    </div>
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Stoksuz" :id="'nonstock'" name="search_nonstock" />
    </div>
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Kategorisiz" :id="'noncategories'" name="search_noncategories" />
    </div>
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Markasız" :id="'nonbrands'" name="search_nonbrands" />
    </div>
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Varyantsız" :id="'nonvariants'" name="search_nonvariants" />
    </div>
</div>
