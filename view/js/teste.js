$('#formTeste').submit(function() {
    var form = new FormData($(this)[0]); 
    form.append('teste', 'upload');
    
    $.ajax({
        url: 'controller/TesteController.php',
        type: 'POST',
        async: false,
        cache: false,
        contentType: false,
        processData: false,
        data: form,
            success: function (response) {
                console.loh(response);
            },
            error: function(err){
                
            }
    });
    event.preventDefault();
});

tinymce.init({
    theme: "modern",
    language: 'pt_BR',
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars fullscreen code", //code 
        "insertdatetime nonbreaking save table contextmenu directionality media", //media jbimages
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",
    image_advtab: true,
    relative_urls: false
});

//tinyMCE.triggerSave();