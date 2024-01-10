<form class="ajax-form" method="post" action="{{ route('user.edit', $user['userId']) }}">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Kullanıcı Kodu</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="code" required class="form-control" name="user[code]" value="{{isset($user['code'])?$user['code']:''}}" placeholder="Benzersiz bir kod giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Kullanıcı Adı</label>
                </div>
                <div class="col-sm-5">
                    <input type="text" id="firstName" required class="form-control" name="user[firstName]" value="{{isset($user['firstName'])?$user['firstName']:''}}" placeholder="Kullanıcı adı giriniz">
                </div>
                <div class="col-sm-4">
                    <input type="text" id="lastName" required class="form-control" name="user[lastName]" value="{{isset($user['lastName'])?$user['lastName']:''}}" placeholder="Kullanıcı soyadı giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Kullanıcı Telefonu</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="telefon" required class="form-control" name="user[telefon]" value="{{isset($user['telefon'])?$user['telefon']:''}}" placeholder="Kullanıcı Telefonu giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Kullanıcı Epostası</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="email" required class="form-control" name="user[email]" value="{{isset($user['email'])?$user['email']:''}}" placeholder="Kullanıcı Epostası giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Kullanıcı Şifresi</label>
                </div>
                <div class="col-sm-9">
                    <input type="text" id="password" required class="form-control" name="user[password]" value="{{isset($user['password'])?$user['password']:''}}" placeholder="Kullanıcı Şifresi giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Yetki Grubu</label>
                </div>
                <div class="col-sm-9">
                    <select id="permission" required class="form-select" name="permission">
                    <option value=""></option>
                        @foreach (\Enum::list(UserRole::class) as $yetkigrubuId=>$yetkigrubuName)
                            <option value="{{ $yetkigrubuId }}">{{ $yetkigrubuName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-sm-9 offset-sm-3">
            @if(isset($user['userId']) && $user['userId']=='new')
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Oluştur</button>
            @else
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
            @endif
        </div>
    </div>
    <input type="hidden" name="user[userId]" value="{{isset($user['userId'])?$user['userId']:'new'}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
