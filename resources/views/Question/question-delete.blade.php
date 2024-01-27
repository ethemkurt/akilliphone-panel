@if($question)
    <form class="ajax-form" method="post" action="{{ route('question.delete', $question['questionId']) }}">
        <div class="col-12">
            <p>
                @if($question['customer'])<b>{{ $question['customer']['firstName'] }} {{ $question['customer']['lastName'] }}</b> @endif
                Sorusu Silinecek. Emin misiniz?</p>
        </div>
        <div class="col-12 text-end">
            <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>

        <input type="hidden" name="questionId" value="{{isset($question['questionId'])?$question['questionId']:''}}" />
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    </form>
@else
    Soru bulunamadı
@endif
