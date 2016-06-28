<?php
require_once(BASEPATH ."/model/Retorno.php");

class FileUtil{
    
    
    public static function upload_file($anexo, $caminho){
        $retorno = new Retorno();
        if(isset($anexo)){
            $tipoPermissao = '@\.(jpg|png|gif|jpeg|bmp)$@i';
            if($anexo['inputFile']['size'] > (1024*1024)*10 ){
                $retorno->setErro(true);
                $retorno->setCodigo(2);
                $retorno->setMensagem("Tamanho do Arquivo excedeu o tamanho limite!");
            }else if( preg_match($tipoPermissao, $anexo['inputFile']['name'], $reg)) { // '@\.(jpg|png|gif|jpeg|bmp)$@i'
                $extensao = $reg[1];
                
                if ($anexo["inputFile"]["error"] > 0){
                    switch ($anexo["inputFile"]["error"]) {
                        case UPLOAD_ERR_INI_SIZE:
                            $response = 'Tamanho de arquivo excedido pelo servidor.';
                            break;
                        case UPLOAD_ERR_FORM_SIZE:
                            $response = 'Tamanho excedido.';
                            break;
                        case UPLOAD_ERR_PARTIAL:
                            $response = 'O arquivo não foi totalmente enviado.';
                            break;
                        case UPLOAD_ERR_NO_FILE:
                            $response = 'Nenhum arquivo inserido para upload.';
                            break;
                        case UPLOAD_ERR_NO_TMP_DIR:
                            $response = 'Algo deu errado no servidor, entre em contato com o administrador do sistema.';
                            break;
                        case UPLOAD_ERR_CANT_WRITE:
                            $response = 'Algo deu errado no servidor, entre em contato com o administrador do sistema.';
                            break;
                        case UPLOAD_ERR_EXTENSION:
                            $response = 'Extensão não permitida.';
                            break;
                        default:
                            $response = 'Algo deu errado, entre em contato com o administrador do sistema.';
                            break;
                    }
                    $retorno->setErro(true);
                    $retorno->setCodigo(1);
                    $retorno->setMensagem($response);
                    
                }else{
                    
                    $nomeArquivo = md5(uniqid(time())) . "." . $extensao;
                    $caminhoUpload = BASEPATH . "/" . $caminho;
                    if(!is_dir($caminhoUpload)){
                        mkdir($caminhoUpload);
                    }
                    move_uploaded_file($anexo["inputFile"]["tmp_name"], $caminhoUpload.$nomeArquivo);
                    
                    $retorno->setErro(false);
                    $retorno->setCodigo(0);
                    $retorno->setMensagem($caminho.$nomeArquivo);
                    
                }
            }else{
                $retorno->setErro(true);
                $retorno->setCodigo(3);
                $retorno->setMensagem("Extensão de Arquivo não permitida!");
            }
        }else{
            $retorno->setErro(true);
            $retorno->setCodigo(4);
            $retorno->setMensagem("O Arquivo enviado é inválido!");
        }
        
        return $retorno;
    }
}