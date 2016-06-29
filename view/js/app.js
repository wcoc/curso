function getParametro(param){
    
    var url = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    
    var valor = null;
    var valores = [];
    
    for(var i =0; i < url.length; i++){
        var urlparam = url[i].split('=');
        
        if(urlparam[0] == param){
            valor = urlparam[1];
            valores.push(urlparam[1]);
        }
    }
    
    if(valores.length > 1){
        return valores;
    }
    return valor;
}

function isEmpty(val){
    
    if(val === null){
        return true;
    }else if(val == ""){
        return true;
    }else if(val === undefined){
        return true;
    }
    return false;
}

function reset_form(form){
    $(form).each(function(){
        this.reset();
    });
}

tinymce.init({
  selector: 'textarea',
  height: 500,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_css: [
    '//fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
    '//www.tinymce.com/css/codepen.min.css'
  ]
});