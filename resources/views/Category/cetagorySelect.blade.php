@if($categories)
<div class="col-12 category-row">
    <div class="mb-1 row">
        <div class="col-sm-3">
            <label class="col-form-label" for="code">Kategori Seçiniz</label>
        </div>
        <div class="col-sm-9">
            <div class="input-group main-category-select">
                <select class="form-select" data-nexturl="{{ route('trendyol.category') }}" multiple>
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
@else
    <div class="col-12 category-row">
        <div class="mb-1 row">
            <div class="col-sm-3">
                <label class="col-form-label" for="code"></label>
            </div>
            <div class="col-sm-9">Alt Kategori Bulunamadı</div>
        </div>
    </div>
@endif
