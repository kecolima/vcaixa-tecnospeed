<?php
header('Content-Type: application/json; charset=utf-8');

require_once 'classes/carteira.php';
require_once 'classes/transacao.php';
require_once 'classes/categoria.php';

class Rest{
    
	public static function open($requisicao){
        
        $method = $_SERVER['REQUEST_METHOD'];
       
		$url = explode('/', $requisicao['url']);
        
		$classe = ucfirst($url[0]);
		array_shift($url);

		$metodo = $url[0];
		array_shift($url);

		$parametros = array();
		$parametros = $url;
        
        if(isset($url[1])){           
            $parametros = array($url[0].'/'.$url[1]);
        }
        
        if($method === 'GET'){
         try {
			if (class_exists($classe)) {
				if (method_exists($classe, $metodo)) {                    
					$retorno = call_user_func_array(array(new $classe, $metodo), $parametros);
                    if($retorno){
                        foreach($retorno as $retorno){
                            $categoria = array('id' => $retorno['id_categoria'],'name' => $retorno['nome_categoria']);                    
                            $movimentacao[] = array('id' =>$retorno['id_categoria'],'data' => $retorno['data'],'categoria' => $categoria,'tipo' =>$retorno['tipo'],'valor' => $retorno['valor'],'descricao' => $retorno['descricao']);
                        } 
                        return json_encode(array('status' => 'sucesso','saldoTotal' => $retorno['saldoTotal'],'movimentacoes' =>$movimentacao));
                    }else{
                        return json_encode(array('status' => 'erro', 'mensagem' => 'Dados inexistentes!'));
                    }
				} else {
					return json_encode(array('status' => 'erro', 'mensagem' => 'Método inexistente!'));
				}
			} else {
				return json_encode(array('status' => 'erro', 'mensagem' => 'Classe inexistente!'));
			}	
		} catch (Exception $e) {
			return json_encode(array('status' => 'erro', 'mensagem' => $e->getMessage()));
		}   
            
        }else if($method === 'POST'){
            $body = file_get_contents('php://input');
            $jsonBody = json_decode($body, true);
            $parametros = $jsonBody;
            try {
                if (class_exists($classe)) {
                    if (method_exists($classe, $metodo)) {                       
                        $retorno = call_user_func_array(array(new $classe, $metodo), array($parametros));
                        return json_encode(array('status' => 'sucesso', 'mensagem' => 'Inserido!'));
                    } else {
                        return json_encode(array('status' => 'erro', 'mensagem' => 'Método inexistente!'));
                    }
                } else {
                    return json_encode(array('status' => 'erro', 'mensagem' => 'Classe inexistente!'));
                }	
            } catch (Exception $e) {
                return json_encode(array('status' => 'erro', 'mensagem' => $e->getMessage()));
            }
        }		
	}
}

if (isset($_REQUEST)) {
	echo Rest::open($_REQUEST);
}
