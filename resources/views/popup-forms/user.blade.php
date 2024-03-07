
<form class="ajax-form" method="post" action="{{ route('user.edit', $user['id']) }}">
    <div class="row">
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="code">Kullanıcı Kodu</label>
                </div>
                <div class="col-sm-8">
                    <input type="text" id="code" required class="form-control" name="user[code]" value="{{isset($user['code'])?$user['code']:''}}" placeholder="Benzersiz bir kod giriniz">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Adı Soyadı</label>
                </div>
                <div class="col-sm-4">
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
                    <label class="col-form-label" for="name">Kullanıcı Telefonları</label>
                </div>
                <div class="col-sm-4">
                    <input type="text" id="telefon" required class="form-control" name="user[telefon]" value="{{isset($user['telefon'])?$user['telefon']:''}}" placeholder="Kullanıcı Telefonu giriniz">
                </div>
                <div class="col-sm-4">
                    <input type="text" id="phoneNumber" required class="form-control" name="user[phoneNumber]" value="{{isset($user['phoneNumber'])?$user['phoneNumber']:''}}" placeholder="Kullanıcı Telefonu giriniz">
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Kullanıcı Epostası</label>
                </div>
                <div class="col-sm-8">
                    @if(isset($user['email']) && $user['email'])
                        <div class="form-control">{{isset($user['email'])?$user['email']:''}}</div>
                    @else
                        <input type="text" id="email" required class="form-control" name="user[email]" value="{{isset($user['email'])?$user['email']:''}}" placeholder="Kullanıcı Epostası giriniz">
                    @endif
                </div>
            </div>
        </div>
        @if(isset($user['id']) && $user['id']=='new')
            <div class="col-12">
                <div class="mb-1 row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="name">Kullanıcı Şifresi</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="password" id="password" required class="form-control" name="user[password]" value="{{isset($user['password'])?$user['password']:'nochange'}}" placeholder="Kullanıcı Şifresi giriniz">
                            <span id="generate-password" class="input-group-text cursor-pointer"><i class="fmenu-icon tf-icons ti ti-password"></i></span>
                            <span id="show-password" class="input-group-text cursor-pointer"><i class="menu-icon tf-icons ti ti-eye"></i></span>
                        </div>

                    </div>
                </div>
            </div>
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Yetki Grubu</label>
                </div>
                <div class="col-sm-8">
                    <select id="role" required class="form-select" name="role">
                    <option value=""></option>
                        @foreach (\Enum::list(UserRole::class) as $roleId=>$roleName)
                            <option value="{{ $roleId }}">{{ $roleName }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <div class="col-12">
            <div class="mb-1 row">
                <div class="col-sm-3">
                    <label class="col-form-label" for="name">Kullanıcı Aktif mi?</label>
                </div>
                <div class="col-sm-8">
                    <input type="hidden" name="user[active]" value="0">
                    <input type="checkbox" id="active" name="user[active]" {{ isset($user['active'])&&$user['active']?'checked':'' }} value="1" placeholder="Kullanıcı Şifresi giriniz">

                </div>
            </div>
        </div>

        <div class="col-sm-8 offset-sm-3">
            @if(isset($user['id']) && $user['id']=='new')
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Oluştur</button>
            @else
                <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Güncelle</button>
            @endif
        </div>
    </div>
    <input type="hidden" name="user[userId]" value="{{isset($user['id'])?$user['id']:'new'}}" />
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
</form>
