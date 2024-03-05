@if(isset($n11_categories['subCategory']))
<select class="nextselect form-select" data-nexturl="{{ route('n11.category') }}">
    <option>Yeni select</option>
    <option value=""> -- </option>
    @foreach($n11_categories['subCategory'] as $n11_category)
        <option value="{{ $n11_category['id'] }}">{{ $n11_category['name'] }}</option>
    @endforeach
</select>
@elseif(isset($n11_categories['attributeList']))
        <?php
            if(isset($n11_categories['attributeList']['attribute']['id'])){
                $n11_categories['attributeList']['attribute'] = [$n11_categories['attributeList']['attribute']];
            }
        ?>
        @foreach($n11_categories['attributeList']['attribute'] as $attribute)

        @if($attribute['valueList'])
            <select class="form-select spec-value" name="attribute[{{$attribute['id']}}]">
                <option value="">{{$attribute['name']}} Seçiniz</option>
                @foreach($attribute['valueList']['value'] as $attributeValue)
                    <option value="{{$attributeValue['name']}}">{{$attributeValue['name']}}</option>
                @endforeach
            </select>
        @else
            <input class="form-control spec-value" name="attribute[{{$attribute['id']}}]" placeholder="{{$attribute['name']}} Giriniz">
        @endif
    @endforeach
@endif
