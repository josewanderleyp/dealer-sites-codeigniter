<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('debug')){
    function debug($valor, $parada = true) {

        echo "<br/>";
        echo "<div style='background-color: #555; color: #fff; margin: 20px 3% 0 2%; padding: 1%; width: 94%;'>";
        echo "<pre style='background-color: #777; padding: 15px; margin: 0; max-height: 500px; overflow: auto;'>";
        print_r($valor);
        echo "</pre>";
        echo "</div>";

    	// Para Execucao Sistema
   	 if ($parada) {
        	exit;
    	}
   }
}

if( !function_exists('antiInjection') ){
	function antiInjection($str) {
		// $str = mysql_real_escape_string($str);
		$str = preg_replace("/( from |select|insert|delete|where|drop table|show tables|#|\*|--|\\\\)/", "" ,$str);
		$str = trim($str);
		$str = addslashes($str);
		return $str;
	}
}

if( !function_exists('antiInjectionArray') ){
	function antiInjectionArray($post_get) {
        $each = array();
        foreach ($post_get as $key => $value) {
            if (gettype($value) == "array") {
                $inteach = array();
                foreach ($value as $key2 => $value2) {
                    $inteach[$key2] = antiInjection($value2);
                }
                $each[$key] = $inteach;
            } else {
                $each[$key] = antiInjection($value);
            }
        }
        return $each;
    }
}

if( !function_exists('tokenLogado') ){
    function tokenLogado($array)
    {
        $header = [
			'alg' => 'HS256',
			'typ' => 'JWT'
		];

		$header = json_encode($header);
		$header = base64_encode($header);

		$payload = [
			'iss' => base_url(),
			'idUser' => $array -> id,
			'nome' => $array -> name,
			'email' => $array -> email
		];

		$payload = json_encode($payload);
		$payload = base64_encode($payload);

		$signature = hash_hmac('sha256',"$header.$payload",'minha-senha',true);
		$signature = base64_encode($signature);

		return "$header.$payload.$signature";
    }
}

if( !function_exists('decodeTokenJWT') ){
    function decodeTokenJWT($token)
    {
        $token = $token;
		$part = explode(".", $token);

		if( isset($part[0]) ){
			$header = json_decode(base64_decode($part[0]));
		}

		if( isset($part[1]) ){
			$payload = json_decode(base64_decode($part[1]));
		}else{
			$payload = '';
		}

		if( isset($part[2]) ){
			$signature = json_decode(base64_decode($part[2]));
		}

		return $payload;
    }
}

if( !function_exists('verificaTokenJWT') ){
    function verificaTokenJWT($token)
    {
       	if( isset($token) && !empty($token) ){
			$array = array('tokenLogado' => "");

			if( isset($token -> idUser) ){
				return $token;
			}else{
				echo json_encode(array("stats" => false, "msg" => "ID de Usuário não encontrado!"));
			}
		}else{
			echo json_encode(array("stats" => false, "msg" => "Token não encontrado!"));
		}
    }
}

if( !function_exists('url_site') ){
	function url_site() {
		$script  = '<script>';
		$script .= 'var urlSite = "' . base_url() . '";';
		$script .= '</script>';
		echo $script;
	}
}
