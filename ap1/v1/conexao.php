<?php      
        $obj_mysqli = new mysqli("localhost", "root", "root", "vcaixa");

        if ($obj_mysqli->connect_errno){
            echo "Ocorreu um erro na conexão com o banco de dados.";
            exit;
        }
?>        
