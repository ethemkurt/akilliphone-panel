<form method="post" action="{{ route('check-user') }}">
<input value="yonetici@mailinator.com" name="email" placeholder="email">
<input value="Passw0rd123?!*" name="password" placeholder="password">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="submit" value="post">
</form>
