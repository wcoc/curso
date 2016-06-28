/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function login(){
    
    var login = $("#inputLogin").val();
    var senha = $("#inputSenha").val();
    
    $.post("controller/UsuarioController.php",{
        usuario: "login",
        login: login,
        senha: senha
    }, function(data){
        console.log(data);
        
    });
}