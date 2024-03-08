<div class="row g-1">
    <div class="col-md-4">
        <x-inputs.text-input class="datatable-filter" label="Ada veya Koda Göre Ara" placeholder="Ada Göre Ara" name="search_name" />
    </div>
    <div class="col-md-4">
        <label class="form-label" for="brandId">Markaya Göre</label>
        <select name="brandId" id="brandId" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Marka Seçiniz</option>
            @foreach($brands['items'] as $key=>$brand)
                <option value="{{ $brand['brandId'] }}">{{ $brand['name'] }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label" for="brandId">Kategoriye Göre</label>
        <select name="categoryId" id="categoryId" class="form-select text-capitalize mb-md-0 mb-2 datatable-filter">
            <option value="">Kategoriye Seçiniz</option>
            @foreach($categories['items'] as $key=>$category)
                <option value="{{ $category['categoryId'] }}">{{ $category['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row g-1 mt-1">
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Aktif" :checked="'checked'" :id="'active'" name="active" />
    </div>
    <div class="col-md-2">
        <x-inputs.checkbox-input class="datatable-filter" label="Pasif" :id="'passive'" name="passive" />
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
