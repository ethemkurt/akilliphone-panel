<div id="product-pazaryerleri" class="content">
    <div class="d-flex">
        <button class="btn btn-primary waves-effect waves-light me-2 load-product-specs" data-url="{{ route('trendyol.product-specs', ['productId'=>1]) }}">
            <i data-feather="save"></i>
            <span class="align-middle">Trendyol</span>
        </button>

        <button class="btn btn-primary waves-effect waves-light me-2 load-product-specs" data-url="{{ route('n11.product-specs', ['productId'=>1]) }}">
            <i data-feather="save"></i>
            <span class="align-middle">N11</span>
        </button>

        <button class="btn btn-primary waves-effect waves-light me-2 load-product-specs" data-url="{{ route('ciceksepeti.product-specs', ['productId'=>1]) }}">
            <i data-feather="save"></i>
            <span class="align-middle">Çiçeksepeti</span>
        </button>

    </div>
    <div class="d-flex" id="product-specs"></div>

</div>

