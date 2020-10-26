<?php 
 
 class Categoria{
     
     public function criar($parametros){
         
         require_once 'conexao.php';
         
         $nome = $parametros['nome'];         
        
         $stmt = $obj_mysqli->prepare("INSERT INTO `categoria`(`nome`) VALUES (?)");          
         $stmt->bind_param('s', $nome); 

         if(!$stmt->execute()){
             $erro = $stmt->error;
         }else{
             $sucesso = "Categoria cadastrada com sucesso!";
         }
         
         return @$parametros;
     } 
 }
?>
 
