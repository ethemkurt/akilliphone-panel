@if($brand)
    <style>
        .image-upload.small.brand{
            height: 80px;
            border: 1px solid #d8d6de;
        }
        body {
            --ck-z-default: 100;
            --ck-z-modal: calc( var(--ck-z-default) + 999 );
        }
    </style>
    <form class="ajax-form" method="post" action="{{ route('brand.save', isset($brand['brandId'])?$brand['brandId']:'new') }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Kodu </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="brand[code]" placeholder="Kodu" value="{{isset($brand['code'])?$brand['code']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Adı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="name"  class="form-control" name="brand[name]" placeholder="Adı" value="{{isset($brand['name'])?$brand['name']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Seo Url </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="slug"  class="form-control" name="brand[slug]" placeholder="Seo Url" value="{{isset($brand['slug'])?$brand['slug']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Resim </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="image-upload small brand" style="background-image: url({{ _CdnImageUrl($brand['image'], 200,200) }}) ">
                            <input type="text" name="brand[image]" value="{{ $brand['image'] }}" style="display: none">
                            <input type="hidden" name="imageFile" value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Açıklama </label>
                    </div>
                    <div class="col-sm-9">
                        <x-textarea-editor id="description" name="brand[description]" placeholder="Açıklama" value="{{isset($brand['description'])?$brand['description']:''}}" />
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="name">Aktif mi?</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="hidden" name="brand[status]" value="0">
                        <input type="checkbox" id="active" name="brand[status]" {{ isset($brand['status'])&&$brand['status']?'checked':'' }} value="1" >
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>
                <input type="hidden" name="brand[brandId]" value="{{isset($brand['brandId'])?$brand['brandId']:''}}" />
            </div>
        </div>
    </form>
@else
    Yorum bulunamadı
@endif


