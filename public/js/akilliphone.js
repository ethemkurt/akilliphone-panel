var Akilliphone = {
    init: function(){
        console.log('AkilliPhone runing...');
        this.documentReady();
    },
    documentReady: function(){
        $(document).ready(function(){
            Akilliphone.poupForms();
            Akilliphone._openPopupFormEvent();
            Akilliphone._ajaxFormEvent();
            Akilliphone._confirmPopupEvent();
            Akilliphone._changeOrderStateEvent();
        });
    },
    poupForms: function(){
        let html = `<div class="modal fade" id="poupForm" tabindex="-1" data-bs-keyboard="false" data-bs-backdrop="static" aria-labelledby="poupFormTitle" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                            <h4 class="modal-title"></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body"></div>
                        <div class="modal-footer ajax-form-result"></div>
                        </div>
                    </div>
                </div>`;
        html += `<div class="modal fade" id="confirmPopup" tabindex="-1" aria-labelledby="confirmPopupTitle" aria-modal="true" role="dialog">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-transparent">
                            <h4 class="modal-title"></h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body text-center">
                            <div class="col-12 ask mb-2"></div>
                            <button class="btn btn-danger cancel">Hayır</button> <a class="btn btn-success action" href="">Evet</a>
</div>
                        </div>
                    </div>
                </div>`;
        $('body').append(html);
        $('#confirmPopup').modal();
    },
    select2:function(){
        $('.select2-ajax').select2({
            ajax: {
                url: this._select2Url,
                dataType: 'json'
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
        });
    },
    popupByUrl: function(url, method, data){
        $('#poupForm .modal-body').html('<i class="fas fa-circle-notch fa-spin"></i>');
        $('#poupForm .ajax-form-result').html('');
        //$('body .ajax-form-result').html('');
        $('#poupForm').modal('show');
        $.ajax({
            url: url,
            method: method,
            data: data
        }).done(function(response) {
            if(response.hasOwnProperty("status")){
                if(response.status){
                    $('#poupForm .modal-body').html(response.html);
                }  else {
                    $('#poupForm .modal-body').html(response.errors);
                }
                if(response.redirect){
                    window.location.href = response.redirect;
                }
            } else {
                $('#poupForm .modal-body').html('Oluşan hatalar için konsola bakınız');
                console.log(response);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('#poupForm .modal-body').html('Oluşan hatalar için konsola bakınız');
            console.log(jqXHR.responseText);
        }).always(function() {

        });
    },
    submitAjaxForm: function(url, method, data){
        $('#poupForm .ajax-form-result').html('<i class="fas fa-circle-notch fa-spin"></i>');
        $('#poupForm').modal('show');
        $.ajax({
            url: url,
            method: method,
            data: data
        }).done(function(response) {
            if(response.hasOwnProperty("status")){
                if(response.status){
                    $('body .ajax-form-result').html(response.html);
                }  else {
                    $('body .ajax-form-result').html(response.errors);
                }
                if(response.redirect){
                    window.location.href = response.redirect;
                }
            } else {
                $('body .ajax-form-result').html('Oluşan hatalar için konsola bakınız');
                console.log(response);
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            $('body .ajax-form-result').html('Oluşan hatalar için konsola bakınız');
            console.log(jqXHR.responseText);
        }).always(function() {

        });
    },
    _select2Url: function(){
        return  '#2365';
    },
    _openPopupFormEvent: function (){
        $('body').on('click', '.btn-popup-form', function(e){
            e.preventDefault();
            $('#poupForm .modal-header .modal-title').html($(this).data('title'));
            Akilliphone.popupByUrl($(this).data('url'), 'GET', {});
            /*$('#poupForm .modal-body').html('<i class="fas fa-circle-notch fa-spin"></i>');
            $('body .ajax-form-result').html('');
            $.ajax( $(this).data('url') ).done(function(response) {
                if(response.status){
                    $('#poupForm .modal-body').html(response.html);
                }  else {
                    $('#poupForm .modal-body').html(response.errors);
                }
                $('#poupForm').modal('show');
            }).fail(function(jqXHR, textStatus, errorThrown) {
                $('#poupForm .modal-body').html('Oluşan hatalar için konsola bakınız');
                console.log(jqXHR.responseText);
                $('#poupForm').modal('show');
            }).always(function() {
            });*/
        });
    },
    _ajaxFormEvent: function (){
        $('body').on('submit', '.ajax-form', function(e){
            e.preventDefault();
            Akilliphone.submitAjaxForm($(this).attr('action'), $(this).attr('method'), $(this).serialize());
            /*
            $.ajax( {
                url: $(this).attr('action'),
                method: $(this).attr('method'),
                data: $(this).serialize()
            } ).done(function(response) {
                if(response.hasOwnProperty("status")){
                    if(response.status){
                        $('body .ajax-form-result').html(response.html);
                    }  else {
                        $('body .ajax-form-result').html(response.errors);
                    }
                    if(response.redirect){
                        window.location.href = response.redirect;
                    }
                } else{
                    $('body .ajax-form-result').html('Oluşan hatalar için konsola bakınız');
                    console.log(response);
                }
            }).fail(function(jqXHR, textStatus, errorThrown) {
                $('body .ajax-form-result').html('Oluşan hatalar için konsola bakınız');
                console.log(jqXHR.responseText);
            }).always(function() {

            });
            */
            return false;
        })
    },
    _changeOrderStateEvent: function(){
        $('body').on('click', '.btn-change-order-state', function(e){
            e.preventDefault();
            let orderId = $(this).data('orderid');
            let orderStatusId = $(this).parents('.input-group').find('.select-order-status-id').val();
            Akilliphone.popupByUrl('popup/changeOrderState?orderId='+orderId+'&orderStatusId='+orderStatusId, 'GET', {});
        });
    },
    _confirmPopupEvent: function(){
        $('body').on('click', 'a.confirm-popup', function(e){
            e.preventDefault();
            $('#confirmPopup a.action').attr('href', $(this).attr('href'));
            $('#confirmPopup .ask').html($(this).attr('title'));
            $('#confirmPopup').modal('show');
        });
        $('body').on('click', '#confirmPopup .cancel', function(e){
            e.preventDefault();
            $('#confirmPopup').modal('hide');
        });
        return false;
    }
}
Akilliphone.init();
