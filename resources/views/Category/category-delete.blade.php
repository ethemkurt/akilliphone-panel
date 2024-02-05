@if($category)
    <form class="ajax-form" method="post" action="{{ route('category.delete', $category['categoryId']) }}">
        <div class="col-12">
            <p>
                <b>{{ $category['name'] }}</b> Kategorisi Silinecek. Emin misiniz?</p>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>
        <input type="hidden" name="categoryId" value="{{isset($category['categoryId'])?$category['categoryId']:''}}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
@else
    Özellik bulunamadı
@endif
