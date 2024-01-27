@if($review)
    <form class="ajax-form" method="post" action="{{ route('review.save', isset($review['reviewId'])?$review['reviewId']:'new') }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Başlık </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="review[title]" value="{{isset($review['title'])?$review['title']:''}}" placeholder="Yorum Başlığı">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Yorum </label>
                    </div>
                    <div class="col-sm-9">
                        <textarea  id="code"  class="form-control" name="review[review]" placeholder="Yorum">{{isset($review['review1'])?$review['review1']:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Yıldız </label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" id="code"  class="form-control" name="review[rating]" value="{{isset($review['rating'])?$review['rating']:' '}}" placeholder="Rayting">
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="name">Yorum Onaylı mı?</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="hidden" name="review[status]" value="0">
                        <input type="checkbox" id="active" name="review[status]" {{ isset($review['status'])&&$review['status']?'checked':'' }} value="1" >

                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
                <input type="hidden" name="review[reviewId]" value="{{isset($review['reviewId'])?$review['reviewId']:''}}" />
                <input type="hidden" name="review[customerId]" value="{{isset($review['customerId'])?$review['customerId']:''}}" />
                <input type="hidden" name="review[productId]" value="{{isset($review['productId'])?$review['productId']:''}}" />
            </div>
        </div>

    </form>
@else
    Yorum bulunamadı
@endif
