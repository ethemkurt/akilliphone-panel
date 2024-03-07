const TulparUploader = {
    loadImageFile : function (event, element) {
        var reader = new FileReader();
        reader.onload = function(){
            console.log($(element).parent('.image-upload'));
            var output = $(element).parent('.image-upload');
            output.css('background-image', 'url(' + reader.result + ')');
            output.find('input[type=hidden]').val(reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    },
    createUploder: function(){
        if(!$('#uploader-style').length){
            var uploadsSyle = document.createElement('style');
            uploadsSyle.id = 'uploader-style'
            uploadsSyle.innerHTML = `
.image-upload {
    width: 100%;
    height: 220px;
    border: 1px solid #cdcdcd;
    position: relative;
    background-size: contain;
    background-repeat: no-repeat;
    background-position: center;
}
.image-upload input[type=text]{
display:none;
}
.image-upload input[type=file]{
    width: 100%;
    height: 100%;
    position: absolute;
    opacity:0
}

  `;
            document.head.appendChild(uploadsSyle);
        }
        $('.image-upload').each(function (){
            if(!$(this).hasClass('uploader-created')){
                let input = $(this).find('input[type=text]');
                //$(this).css('background-image', 'url(' + input.val() + ')');
                let fileSelector = document.createElement('input');
                fileSelector.setAttribute('type', 'file');
                fileSelector.setAttribute("onchange", "TulparUploader.loadImageFile(event, this)");
                $(this).append(fileSelector);
                $(this).addClass('uploader-created');
            }
        });
    }
}
console.log('TulparUploader is runing...');
