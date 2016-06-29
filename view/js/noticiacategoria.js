/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function registrar_categoria(){
    var descricao = $("#inputDescricao").val();
    var status = $("#inputStatus").val();
    var categoria_id = getParametro("noticiacategoria_id");
    var tipo_requisicao = "inserir";
    
    if(categoria_id != null){
        tipo_requisicao = "atualizar";
    }
    
    if(valida_categoria()){
        $.post("controller/NoticiaCategoriaController.php",{
            noticiacategoria: tipo_requisicao,
            noticiacategoria_id: categoria_id,
            inputDescricao: descricao,
            inputStatus: status
        }, function(data){
            var result = $.parseJSON(data);

            var div = $("#div-retorno");
            if(result.erro){
                div.attr("class", "alert alert-danger");
            }else{
                div.attr("class", "alert alert-success");
                
                if(categoria_id == null){
                    reset_form("#form-addcategoria");
                }
            }
            div.html(result.mensagem);
        });
    }
}

function valida_categoria(){
    var descricao = $("#inputDescricao").val();
    var status = $("#inputStatus").val();
    
    var result = "<h2>Atenção</h2>";
    var sucesso = true;
    
    if(isEmpty(descricao)){
        sucesso = false;
        result += "<p>* Campo <strong>descrição</strong> é obrigatório!</p>";
    }
    
    if(isEmpty(status)){
        sucesso = false;
        result += "<p>* Campo <strong>status</strong> é obrigatório!</p>";
    }
    
    if(sucesso == false){
        var div = $("#div-retorno");
        div.attr("class", "alert alert-danger");
        div.html(result);
    }
    return sucesso;
}