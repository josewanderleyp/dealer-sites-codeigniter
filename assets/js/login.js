$(function () {
	$("form.login").on("submit", function (e) {
		e.preventDefault();
		var form = $(this);
		var submit = false;
		var x = 0;

		var notification = $("#notification");

		form.find(".form-control").each(function () {
			if ($(this).val() == "") {
				submit = false;
				x++;
			} else if (x == 0) {
				submit = true;
			}
		});

		if (submit) {
			$.ajax({
				url: urlSite + "Login/CheckLogin",
				type: "POST",
				data: form.serialize(),
				success: function (response) {
					console.log(response);
					var json = $.parseJSON(response);

					if (json.stats) {
						notification.addClass("active").removeClass("warning");
						notification.find("strong").html(json.msg);
						notification.find("span").html("");

						setTimeout(() => {
							window.location.href = urlSite + "Admin/Users";
						}, 1500);
					} else {
						notification.addClass("active warning");
						notification.find("strong").html("Confira os campos");
						notification.find("span").html(json.msg);
					}
				},
			});
		} else {
			notification.addClass("active");
			notification.find("span").html("Preencha os dados corretamente");
		}
	});

	$("form.formRecuperar").on("submit", function (e) {
		e.preventDefault();
		var form = $(this);
		var submit = false;
		var x = 0;

		var action = $(this).attr("action");

		var notification = $("#notification");

		form.find(".form-control").each(function () {
			if ($(this).val() == "") {
				submit = false;
				x++;
			} else if (x == 0) {
				submit = true;
			}
		});

		if (submit) {
			$.ajax({
				url: action,
				type: "POST",
				data: form.serialize(),
				beforeSend: function () {
					notification.addClass("active").removeClass("warning");
					notification.find("strong").html("Só um momento");
					notification.find("span").html("Estamos enviando para seu e-mail");
				},
				success: function (response) {
					console.log(response);
					var json = $.parseJSON(response);

					if (json.stats) {
						notification.addClass("active").removeClass("warning");
						notification.find("strong").html(json.msg);
						notification.find("span").html("");

						// setTimeout(() => {
						// 	window.location.href = urlSite + "Admin/Dashboard";
						// }, 1500);
					} else {
						notification.addClass("active warning");
						notification.find("strong").html("Confira os campos");
						notification.find("span").html(json.msg);
					}
				},
			});
		} else {
			notification.addClass("active");
			notification.find("span").html("Preencha os dados corretamente");
		}
	});

	$("form.redefinirSenha").on("submit", function (e) {
		e.preventDefault();
		var form = $(this);
		var submit = false;
		var x = 0;

		var action = $(this).attr("action");
		var notification = $("#notification");

		form.find(".form-control").each(function () {
			if ($(this).val() == "") {
				submit = false;
				x++;
			} else if (x == 0) {
				submit = true;
			}
		});

		if (submit) {
			$.ajax({
				url: action,
				type: "POST",
				data: form.serialize(),
				success: function (response) {
					console.log(response);
					var json = $.parseJSON(response);

					if (json.stats) {
						notification.addClass("active").removeClass("warning");
						notification.find("strong").html(json.msg);
						notification.find("span").html("");

						setTimeout(() => {
							window.location.href = urlSite;
						}, 1500);
					} else {
						notification.addClass("active warning");
						notification.find("strong").html("Confira os campos");
						notification.find("span").html(json.msg);
					}
				},
			});
		} else {
			notification.addClass("active").removeClass("warning");
			notification.find("strong").html("Preencha os dados corretamente");
			notification.find("span").html("As senhas não batem");
		}
	});

	// $(".redefinirSenha")
	// 	.find('input[type*="submit"]')
	// 	.attr("disabled", "disabled");

	$(".password1").keyup(function (e) {
		e.preventDefault();

		if ($(this).val().length > 0 && $(this).val().length <= 8) {
			$(".redefinirSenha").find(".8char").addClass("ok");
			// $(".redefinirSenha").find('input[type*="submit"]').attr("disabled", "");
		} else {
			$(".redefinirSenha").find(".8char").removeClass("ok");
			// $(".redefinirSenha")
			// 	.find('input[type*="submit"]')
			// 	.attr("disabled", "disabled");
		}

		if (/[a-z]/gm.test($(this).val())) {
			$(".redefinirSenha").find(".minuscula").addClass("ok");
			// $(".redefinirSenha").find('input[type*="submit"]').attr("disabled", "");
		} else {
			$(".redefinirSenha").find(".minuscula").removeClass("ok");
			// $(".redefinirSenha")
			// 	.find('input[type*="submit"]')
			// 	.attr("disabled", "disabled");
		}

		if (/[A-Z]/gm.test($(this).val())) {
			$(".redefinirSenha").find(".maiuscula").addClass("ok");
			// $(".redefinirSenha").find('input[type*="submit"]').attr("disabled", "");
		} else {
			$(".redefinirSenha").find(".maiuscula").removeClass("ok");
			// $(".redefinirSenha")
			// 	.find('input[type*="submit"]')
			// 	.attr("disabled", "disabled");
		}

		if (/(\W)|(\d)/gim.test($(this).val())) {
			$(".redefinirSenha").find(".especial").addClass("ok");
			// $(".redefinirSenha").find('input[type*="submit"]').attr("disabled", "");
		} else {
			$(".redefinirSenha").find(".especial").removeClass("ok");
			// $(".redefinirSenha")
			// 	.find('input[type*="submit"]')
			// 	.attr("disabled", "disabled");
		}
	});

	$(".verifySenha").focusout(function (e) {
		e.preventDefault();
		var val = $(".verifySenha").val();
		var password = $(".password1").val();
		var notification = $("#notification");

		if (val == password) {
			console.log("aqui");
			// $(".redefinirSenha")
			// 	.find('input[type*="submit"]')
			// 	.attr("disabled", false);
		} else {
			// $(".redefinirSenha")
			// 	.find('input[type*="submit"]')
			// 	.attr("disabled", "disabled");

			notification.addClass("active").removeClass("warning");
			notification.find("strong").html("Preencha os dados corretamente");
			notification.find("span").html("As senhas não batem");
		}
	});

	$("#notification .closeNotification").on("click", function (e) {
		e.preventDefault();
		$(this).parent().removeClass("active");
	});
});
