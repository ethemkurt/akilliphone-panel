<?php
$productKey = time();
?>
<tr class="order-items">
    <td class="  control" tabindex="0" style="display: none;"></td>
    <td class="sorting_1">
        <div class="d-flex justify-content-start align-items-center">
            <div class="avatar-wrapper">
                <div class="avatar me-2"><img src="{{ getProductImageUrl($variant['featuredImage'], 40,40) }}" class="rounded-2"></div>
            </div>
            <div class="d-flex flex-column"><h6 class="text-body mb-0 text-wrap">{{ $variant['name'] }}</h6>
                <small class="text-muted">Kodu: {{ $variant['code'] }}</small>
                <small class="text-muted">Barkodu: {{ $variant['variantOptions'][0]['barcode'] }}</small>
            </div>
        </div>
    </td>
    <td><input class="form-control text-end order-item-price calculate-order" type="number" value="{{ ($variant['price']) }}" step="0.01"></td>
    <td><input class="form-control text-end order-item-quantity calculate-order" type="number" value="1" name="order[orderProducts][{{$productKey}}][quantity]"></td>
    <td><input class="form-control disabled text-end order-item-total" type="text" value="{{ $variant['price'] }}" readonly style="min-width: 120px;" name="order[orderProducts][{{$productKey}}][total]">
        <input type="hidden" name="order[orderProducts][{{$productKey}}][productId]" value="{{$variant['product']['productId']}}">
        <input type="hidden" name="order[orderProducts][{{$productKey}}][variantId]" value="{{$variant['variantId']}}">
        <input type="hidden" name="order[orderProducts][{{$productKey}}][optionId]" value="{{$variant['variantOptions'][0]['variantOptionId']}}">
        <input type="hidden" name="order[orderProducts][{{$productKey}}][image]" value="{{$variant['featuredImage']}}">
        <input type="hidden" name="order[orderProducts][{{$productKey}}][name]" value="{{$variant['product']['name']}}">
        <input type="hidden" name="order[orderProducts][{{$productKey}}][barcode]" value="{{$variant['variantOptions'][0]['barcode']}}">


    </td>
    <td><button class="btn btn-primary"><i class="feather icon-trash-2"></i></button></td>
</tr>
