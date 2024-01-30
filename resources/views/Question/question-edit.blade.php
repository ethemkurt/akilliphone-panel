@if($question)
    <form class="ajax-form" method="post" action="{{ route('question.save', isset($question['questionId'])?$question['questionId']:'new') }}" enctype="multipart/form-data" >
        @csrf
        <div class="row">
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Soru </label>
                    </div>
                    <div class="col-sm-9">
                        <textarea id="code"  class="form-control" name="question[question]" placeholder="Soru">{{isset($question['question1'])?$question['question1']:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="code">Cevap </label>
                    </div>
                    <div class="col-sm-9">
                        <textarea  id="code"  class="form-control" name="question[answer]" placeholder="Yorum">{{isset($question['answer'])?$question['answer']:''}}</textarea>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="name">Soru Yayınlanmsın mı?</label>
                    </div>
                    <div class="col-sm-8">
                        <input type="hidden" name="question[status]" value="0">
                        <input type="checkbox" id="active" name="question[status]" {{ isset($question['status'])&&$question['status']?'checked':'' }} value="1" >

                    </div>
                </div>
            </div>
            <div class="col-sm-9 offset-sm-3">
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
                <input type="hidden" name="question[questionId]" value="{{isset($question['questionId'])?$question['questionId']:''}}" />
                <input type="hidden" name="question[customerId]" value="{{isset($question['customerId'])?$question['customerId']:''}}" />
                <input type="hidden" name="question[productId]" value="{{isset($question['productId'])?$question['productId']:''}}" />
            </div>
        </div>

    </form>
@else
    Yorum bulunamadı
@endif
