/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$("#form-noticiaadd").submit(function(){
    tinyMCE.triggerSave();
    var form = new FormData($(this));
    var tipo_requisicao = "inserir";
    var noticia_id = getParametro("noticia_id");
    
    if(noticia_id){
        tipo_requisicao = "atualizar";
    }
    form.append("noticia", tipo_requisicao);
    form.append("noticia_id", noticia_id);
    
    if(valida_noticia()){
        $.ajax({
            url: "controller/NoticiaController.php",
            type: "POST",
            cache: false,
            contentType: false,
            processData: false,
            data: form,
            succes: function(response){
                console.log(response);
                var result = $.parseJSON(response);

            },
            error: function(err){
                console.log(err);

                alert(err);
            }
        });
    }
    event.preventDefault();
});

function valida_noticia(){
    var titulo = $("#inputTitulo").val();
    var categoria = $("#inputCategoria").val();
    var conteudo = $("#inputConteudo").val();
    var status = $("#inputStatus").val();
    
    var result = "<h2>Atenção, Campos obrigatórios!</h2>";
    var sucesso = true;
    
    if(isEmpty(titulo)){
        sucesso = false;
        result += "<p>* Campo Título é obrigatório!</p>";
    }
    if(isEmpty(categoria)){
        sucesso = false;
        result += "<p>* Campo Categoria é obrigatório!</p>";
    }
    if(isEmpty(conteudo)){
        sucesso = false;
        result += "<p>* Campo Conteudo é obrigatório!</p>";
    }
    if(isEmpty(status)){
        sucesso = false;
        result += "<p>* Campo Status é obrigatório!</p>";
    }
    
    if(!sucesso){
        var div = $("#div-retorno");
        div.attr("class", "alert alert-danger");
        div.html(result);
    }
    return sucesso;
}