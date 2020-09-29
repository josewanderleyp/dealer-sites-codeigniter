<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->helper('url');
?>

<!DOCTYPE html>
<html lang="pt-BR">

	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
		<meta name="HandheldFriendly" content="true" />
		<title><?=$title?></title>
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet">
		<link rel="stylesheet" href="<?=CSS_PATH?>/login.css">
		<link rel="shortcut icon" href="<?=IMAGE_PATH?>favicon.ico" />
	</head>

	<body>
		<div id="notification">
			<strong>Confira os campos</strong>

			<span>Usuário ou senha inválidos</span>

			<a href="javascript:;" class="closeNotification">X</a>
		</div>
