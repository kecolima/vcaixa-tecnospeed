<?php

	$url = 'http://localhost/vcaixa/api/v1';

	$classe = 'carteira';
	$metodo = 'mostrar';
    $parametro = '1';

	$montar = $url.'/'.$classe.'/'.$metodo.'/'.$parametro;

	$retorno = file_get_contents($montar);

	var_dump(json_decode($retorno, 1));
