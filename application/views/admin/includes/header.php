<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->helper('url');
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8" />
	<title><?=$title?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5" />
	<meta name="HandheldFriendly" content="true" />
	<!-- CSS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="<?=CSS_PATH?>/geral.css">
	<link rel="shortcut icon" href="<?=IMAGE_PATH?>favicon.ico" />

	<!-- JS -->
	<script src="<?=JS_PATH?>/vendor/jquery-3.3.1.min.js"></script>
	<script src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	<script src="<?=JS_PATH?>geral.js?=1"></script>
</head>

<body>

<header id="top">

	<div id="notification">
		<strong>Confira os campos</strong>

		<span>Usuário ou senha inválidos</span>

		<a href="javascript:;" class="closeNotification">X</a>
	</div>
	
	<div class="container">
		<div class="row">
			<div id="menuAnchor" class="active">
				<span></span>
				<span></span>
				<span></span>
			</div>

			<div class="logo">
				<a href="<?=base_url()?>Admin/Users"><img src="http://dealersites.com.br/assets/images/logo_white_2x.png" width="180"></a>
			</div>

			<div class="user">
				<div id="userAnchor">
					<span><?=$this -> session -> userdata['name']?></span>

					<?php
						if(!empty($this -> session -> userdata['fotoPerfil'])){
							?>
								<div class="img"><img src="<?=IMAGE_PATH?>/users/user_<?=$this -> session -> userdata['id']?>/<?=$this -> session -> userdata['fotoPerfil']?>"></div>
							<?php
						}else{
							?>
								<div class="img"><img src="<?=IMAGE_PATH?>temp/user1.png"></div>
							<?php
						}
					?>
					
				</div>
				<div class="popMenu">
					<div class="inner">
						<ul>
							<li><a href="<?=base_url()?>/Login/logout?token=<?=$this -> session -> userdata['tokenUser']?>">Sair</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<nav id="menu" class="open">
	<ul>
		<li>
			<a href="<?php echo base_url('Admin/Users'); ?>" <?php echo ($this->uri->segment(2) == "Users") ? 'class="active"': '';?>>
				<i class="icon-user"></i>
				<span>Users</span>
			</a>
		</li>
	</ul>
</nav>

<div id="content" class="menuopen">
	<div class="inner">
