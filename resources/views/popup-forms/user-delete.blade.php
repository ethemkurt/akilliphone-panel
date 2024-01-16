@if($user)
<form class="ajax-form" method="post" action="{{ route('user.delete', $user['id']) }}">
    <div class="col-12">
        <p>
            {{ $user['firstName'] }} {{ $user['lastName'] }} <b>({{ $user['email'] }})</b>
            Kullanıcısı Silinecek. Emin misiniz?</p>
    </div>
    <div class="col-12 text-end">
                <button type="submit" class="btn btn-danger me-1 waves-effect waves-float waves-light">Evet Sil</button>
        </div>

    <input type="hidden" name="userId" value="{{isset($user['id'])?$user['id']:''}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
@else
    Kullanıcı bulunamadı
@endif
