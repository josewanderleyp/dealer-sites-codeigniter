<div id="formulario_recuperar" class="recuperar">
	<div class="center">

		<img src="<?=IMAGE_PATH?>/logo_green.png">

		<div class="title">Redefinir Sua senha</div>

		<form action="<?=base_url()?>/Login/changePassword" class="changePasswordForm redefinirSenha">
			<input type="hidden" name="idUser" value="<?=$idUser?>">
			
			<div class="block">
				<label for="">Senha</label>
				<input class="form-control password1" maxlength="8" type="password" name="password" placeholder="Senha">
			</div>

			<div class="block">
				<label for="">Confirme sua Senha</label>
				<input class="form-control verifySenha" maxlength="8" type="password" name="password2" placeholder="Confirme sua Senha">
			</div>

			<ul class="tips">
				<li class="8char">No máximo 8 caracteres</li>
				<li class="maiuscula">Letra maiúscula</li>
				<li class="minuscula">Letra minúscula</li>
				<li class="especial">Números, ou caracteres especial</li>
			</ul>

			<div class="buttons">
				<input type="submit" value="Salvar Senha">
			</div>
		</form>

	</div>
</div>
