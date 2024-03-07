@if($ciceksepeti_categories['subCategories'])
<select class="nextselect form-select" data-nexturl="{{ route('ciceksepeti.category') }}">
    <option value=""> -- </option>
    @foreach($ciceksepeti_categories['subCategories'] as $ciceksepeti_category)
        <option value="{{ $ciceksepeti_category['id'] }}">{{ $ciceksepeti_category['name'] }}</option>
    @endforeach
</select>
@elseif(isset($ciceksepeti_categories['specs']))
    @foreach($ciceksepeti_categories['specs'] as $spec)
        @if($spec['attributeValues'])
            <select class="form-select spec-value" name="attribute[{{$spec['attributeId']}}]">
                <option value="">{{$spec['attributeName']}} Seçiniz</option>
                @foreach($spec['attributeValues'] as $attributeValue)
                    <option value="{{$attributeValue['id']}}">{{$attributeValue['name']}}</option>
                @endforeach
            </select>
        @else
            <input class="form-control spec-value" name="attribute[{{$spec['attributeId']}}]" placeholder="{{$spec['attributeName']}} Giriniz">
        @endif
    @endforeach
@endif
