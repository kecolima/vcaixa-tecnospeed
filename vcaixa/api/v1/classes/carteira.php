<?php 
 
 class Carteira{
     
     public function mostrarclientedata($parametros){         
        
        require_once 'conexao.php'; 
         
        $parametros = explode('/',$parametros);
        $id = $parametros[0];
        $data = $parametros[1];

        $stmt = $obj_mysqli->query("SELECT mv.id_movimentacao AS id, mv.data, mv.valor, mv.descricao, tp.tipo, ca.id_categoria, ca.nome As nome_categoria, ci.nome, ci.id_cliente, cc.saldo AS saldoTotal FROM movimentacao mv INNER JOIN tipo tp ON mv.id_tipo = tp.id_tipo INNER JOIN categoria ca ON ca.id_categoria = mv.id_categoria INNER JOIN cliente ci ON ci.id_carteira = mv.id_carteira INNER JOIN carteira cc ON mv.id_carteira = cc.id_carteira WHERE mv.data = '$data' AND ci.id_cliente = '$id'"); 
         
        foreach($stmt as $carteira){
              $carteiras[] = $carteira;
        }                  
         
         return @$carteiras;
     }
     
     public function mostrar($parametros){         
        
        require_once 'conexao.php';
         
        $id = $parametros;        
        
        $data = date("Y-m-d");

        $stmt = $obj_mysqli->query("SELECT mv.id_movimentacao AS id, mv.data, mv.valor, mv.descricao, tp.tipo, ca.id_categoria, ca.nome As nome_categoria, ci.nome, ci.id_cliente, cc.saldo AS saldoTotal FROM movimentacao mv INNER JOIN tipo tp ON mv.id_tipo = tp.id_tipo INNER JOIN categoria ca ON ca.id_categoria = mv.id_categoria INNER JOIN cliente ci ON ci.id_carteira = mv.id_carteira INNER JOIN carteira cc ON mv.id_carteira = cc.id_carteira WHERE mv.data = '$data' AND ci.id_cliente = '$id'");
     
        foreach($stmt as $carteira){
              $carteiras[] = $carteira;
        }                  
         
         return @$carteiras;
     }
     
     public function mostrartodastransacoes(){
         
        require_once 'conexao.php';	

        $stmt = $obj_mysqli->query("SELECT mv.id_movimentacao AS id, mv.data, mv.valor, mv.descricao, tp.tipo, ca.id_categoria, ca.nome As nome_categoria, ci.nome, ci.id_cliente, cc.saldo AS saldoTotal FROM movimentacao mv INNER JOIN tipo tp ON mv.id_tipo = tp.id_tipo INNER JOIN categoria ca ON ca.id_categoria = mv.id_categoria INNER JOIN cliente ci ON ci.id_carteira = mv.id_carteira INNER JOIN carteira cc ON mv.id_carteira = cc.id_carteira");
         
        foreach($stmt as $carteira){
              $carteiras[] = $carteira;
        }                  
         
         return @$carteiras;
     }
 }
 
