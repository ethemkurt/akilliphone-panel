
@extends('layouts/contentLayoutMaster')
@if($routeName=='user.admin')
    @section('title', 'Personel Listesi')
@elseif($routeName=='user.bayi')
    @section('title', 'Bayi Listesi')
@elseif($routeName=='user.uye')
    @section('title', 'Müşteri Listesi')
@else
    @section('title', 'Kullanıcı Listesi')
@endif


@section('page-style')
{{-- Page Css files --}}
<link rel="stylesheet" type="text/css" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
@endsection

@section('content')
    <!-- Advanced Search -->
<section id="advanced-search-datatable">
    <div class="row">
      <div class="col-12">
        <div class="card">
                    @if($routeName=='user.admin')
                <div class="card-body">
                    <form class="dt_adv_search" method="POST">
                        <div class="row g-1 mb-md-1">
                            <div class="col-md-4">
                                <x-button-popup-form :title="'Yeni Personel'" :text="'Yeni Personel'" :url="route('popup', 'User').'?userType=admin'" />
                            </div>
                        </div>
                    </form>
                </div>
                    @endif
          <hr class="my-0" />
            <input type="hidden" class="datatable-filter" id="search_route" name="search_route" value="{{ $routeName }}">
            <x-data-table :dataTable="$dataTable"/>
        </div>
      </div>
    </div>
  </section>
  <!--/ Advanced Search -->

@endsection


@section('vendor-script')
{{-- vendor files --}}

@endsection

@section('page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/tables/table-datatables-advanced.js')) }}"></script>
    <script>
        jQuery('body').on('click', '#show-password', function(){
            if(jQuery('#password').attr('type')== 'text'){
                jQuery('#password').attr('type', 'password');
            } else {
                jQuery('#password').attr('type', 'text');
            }
        });
        jQuery('body').on('click', '#generate-password', function(){
            jQuery('#password').val(getPassword(12));
            jQuery('#password').attr('type', 'text');

        });
        /*
        var Password = {
            _pattern : /[a-zA-Z0-9_\-\+\.]/,
            _getRandomByte : function()
            {
                // http://caniuse.com/#feat=getrandomvalues
                if(window.crypto && window.crypto.getRandomValues)
                {
                    var result = new Uint8Array(1);
                    window.crypto.getRandomValues(result);
                    return result[0];
                }
                else if(window.msCrypto && window.msCrypto.getRandomValues)
                {
                    var result = new Uint8Array(1);
                    window.msCrypto.getRandomValues(result);
                    return result[0];
                }
                else
                {
                    return Math.floor(Math.random() * 256);
                }
            },

            generate : function(length)
            {
                return Array.apply(null, {'length': length})
                    .map(function()
                    {
                        var result;
                        while(true)
                        {
                            result = String.fromCharCode(this._getRandomByte());
                            if(this._pattern.test(result))
                            {
                                return result;
                            }
                        }
                    }, this)
                    .join('');
            }

        };
*/
        function getPassword(passwordLength)
        {
            var upperChars = ["A","B","C","D","E","F","G","H","J","K","M","N","P","Q","R","S","T","U","V","W","X","Y","Z"];
            var lowerChars = ["a","b","c","d","e","f","g","h","j","k","m","n","p","q","r","s","t","u","v","w","x","y","z"];
            var numbers = ["2","3","4","5","6","7","8","9"];
            var symbols = ["!","#","$","%","&","*","+","-","?","@"];
            var similars_lower = ["i","l","o"];
            var similars_upper = ["I","L","O"];
            var similars_numbers = ["1","0"];
            var similars_symbols = ["|"];
            var ambiguous = ["(",")",",",".","/",":",";","<","=",">","[","]","^","_","{","}","~"];

            var passwordLength = 16;
            var chkIncludeLowerChar = 1;
            var chkIncludeUpperChar = 1;
            var chkIncludeNumbers = 1;
            var chkIncludeSymbols =true;
            var chkExcludeSimilar = false;
            var chkExcludeAmbiguous = true;

            var password="";
            var array = [];
            var count = 0;
            if(chkIncludeLowerChar){
                array = array.concat(lowerChars);
            }
            if(chkIncludeUpperChar){
                array = array.concat(upperChars);
            }
            if(chkIncludeNumbers){
                array = array.concat(numbers);
            }
            if(chkIncludeSymbols){
                array = array.concat(symbols);
            }
            if(!chkExcludeSimilar){
                if(chkIncludeLowerChar)
                {
                    array = array.concat(similars_lower);
                }
                if(chkIncludeUpperChar)
                {
                    array = array.concat(similars_upper);
                }
                if(chkIncludeNumbers)
                {
                    array = array.concat(similars_numbers);
                }
                if(chkIncludeSymbols)
                {
                    array = array.concat(similars_symbols);
                }
            }
            if(!chkExcludeAmbiguous && chkIncludeSymbols){
                array = array.concat(ambiguous);
            }
            var randomIndex;
            if(array.length > 1)
            {
                for (var i = 0; i < passwordLength; i++) {
                    randomIndex = Math.floor(Math.random() * array.length);
                    password = password + array[randomIndex];
                }
            }
            return password;
        }
    </script>
@endsection
