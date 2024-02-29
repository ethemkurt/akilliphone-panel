@if($trendyol_categories['subCategories'])
<select class="nextselect form-select" data-nexturl="{{ route('trendyol.category') }}">
    <option>Yeni select</option>
    <option value=""> -- </option>
    @foreach($trendyol_categories['subCategories'] as $trendyol_category)
        <option value="{{ $trendyol_category['id'] }}">{{ $trendyol_category['name'] }}</option>
    @endforeach
</select>
@elseif(isset($trendyol_categories['specs']))
    @foreach($trendyol_categories['specs'] as $spec)
        @if($spec['attributeValues'])
            <select class="form-select spec-value" name="attribute[{{$spec['attribute']['id']}}]">
                <option value="">{{$spec['attribute']['name']}} Seçiniz</option>
                @foreach($spec['attributeValues'] as $attributeValue)
                    <option value="{{$attributeValue['id']}}">{{$attributeValue['name']}}</option>
                @endforeach
            </select>
        @else
            <input class="form-control spec-value" name="attribute[{{$spec['attribute']['id']}}]" placeholder="{{$spec['attribute']['name']}} Giriniz">
        @endif
    @endforeach
@endif
