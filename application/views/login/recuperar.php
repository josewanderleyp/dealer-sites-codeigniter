<div id="formulario_recuperar" class="recuperar">
	<div class="center">

		<img src="<?=IMAGE_PATH?>/logo_green.png">

		<div class="title">Gerar nova senha</div>
		<div class="text">Insira seu email e enviaremos a você um link para voltar a acessar sua conta.</div>

		<form action="<?=base_url()?>/Login/sendEmailRecuperar" class="formRecuperar">
			<div class="block">
				<label for="">E-mail</label>
				<input class="form-control" type="email" name="email" placeholder="Seu e-mail">
			</div>

			<div class="buttons">
				<input type="submit" value="Enviar Link para Login">

				<a href="<?php echo base_url('Login'); ?>">Voltar</a>
			</div>
		</form>

	</div>
</div>
