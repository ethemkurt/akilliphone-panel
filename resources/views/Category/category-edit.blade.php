@if($category)
    <style>
        .image-upload.small.category{
            height: 80px;
            border: 1px solid #d8d6de;
        }
        body {
            --ck-z-default: 100;
            --ck-z-modal: calc( var(--ck-z-default) + 999 );
        }
    </style>
    <form class="ajax-form" method="post" action="{{ route('category.save', isset($category['categoryId'])?$category['categoryId']:'new') }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Kodu </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="category[code]" placeholder="Kodu" value="{{isset($category['code'])?$category['code']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Adı </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="name"  class="form-control" name="category[name]" placeholder="Adı" value="{{isset($category['name'])?$category['name']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Seo Url </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="slug"  class="form-control" name="category[slug]" placeholder="Seo Url" value="{{isset($category['slug'])?$category['slug']:''}}">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Resim </label>
                    </div>
                    <div class="col-sm-9">
                        <div class="image-upload small category" style="background-image: url({{ _CdnImageUrl($category['image']) }}) ">
                            <input type="text" name="category[image]" value="{{ $category['image'] }}" style="display: none">
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
                        <x-textarea-editor id="description" name="category[description]" placeholder="Açıklama" value="{{isset($category['description'])?$category['description']:''}}" />
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="name">Aktif mi?</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="hidden" name="category[status]" value="0">
                        <input type="checkbox" id="active" name="category[status]" {{ isset($category['status'])&&$category['status']?'checked':'' }} value="1" >
                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Kaydet</button>
                <input type="hidden" name="category[categoryId]" value="{{isset($category['categoryId'])?$category['categoryId']:''}}" />
                <input type="hidden" name="category[parentId]" value="{{$parentId}}" />
            </div>
        </div>
    </form>
@else
    Yorum bulunamadı
@endif


