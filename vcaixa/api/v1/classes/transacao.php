<?php 
 
 class Transacao{
     
     public function movimentar($parametros){         
        
         require_once 'conexao.php';

         $id_cliente = $parametros['id_cliente'];
         $tipo = $parametros['tipo'];
         $categoria_id = $parametros['categoria']['id'];
         $valor = $parametros['valor']; 
         $data = date("Y-m-d H:i:s");
         $descricao = $parametros['descricao'];
         
         if(($tipo == 1) || ($tipo == 2)){
             $ctmt = $obj_mysqli->query("SELECT cl.id_carteira, cc.saldo  FROM cliente cl INNER JOIN carteira cc ON cl.id_cliente = cc.id_carteira WHERE cl.id_cliente = '$id_cliente'");        

             foreach($ctmt as $cliente_carteira){
                  $saldo_atual = $cliente_carteira['saldo'];
                  $id_carteira = $cliente_carteira['id_carteira'];
             }
         
             if($tipo == 1){
                 $valor_atual = ($saldo_atual + $valor);
             }else if($tipo == 2){
                 $valor_atual = ($saldo_atual - $valor);
             }
             $pstm = $obj_mysqli->prepare("UPDATE carteira SET saldo = ? WHERE id_carteira = ?");          
             $pstm->bind_param('di', $valor_atual, $id_cliente);

             if(!$pstm->execute()){
                 $erro = $pstm->error;
             }else{
                 $sucesso = "Saldo atualizado com sucesso!";
             }

             $stmt = $obj_mysqli->prepare("INSERT INTO `movimentacao`(`id_carteira`, `id_tipo`, `valor`, `data`, `descricao`, `id_categoria`) VALUES (?,?,?,?,?,?)");          
             $stmt->bind_param('iidssi', $id_carteira, $tipo, $valor,$data,$descricao,$categoria_id); 

             if(!$stmt->execute()){
                 $erro = $stmt->error;
             }else{
                 $sucesso = "Movimentação cadastrada com sucesso!";
             }
         
             return @$parametros;
             
         }else{
             
             return json_encode(array('status' => 'erro', 'mensagem' => 'Tipo inexistente!'));
         }  
      }
         
 }
