@if($review)
    <form class="ajax-form" method="post" action="{{ route('review.delete', $review['reviewId']) }}">
        <div class="col-12">
            <p>
                @if($review['customer'])<b>{{ $review['customer']['firstName'] }} {{ $review['customer']['lastName'] }}</b> @endif
                Yorumu Silinecek. Emin misiniz?</p>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>

        <input type="hidden" name="reviewId" value="{{isset($review['reviewId'])?$review['reviewId']:''}}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
@else
    Yorum bulunamadı
@endif
