$((function(){$("form.login").on("submit",(function(a){a.preventDefault();var n=$(this),s=!1,e=0,i=$("#notification");n.find(".form-control").each((function(){""==$(this).val()?(s=!1,e++):0==e&&(s=!0)})),s?$.ajax({url:urlSite+"Login/CheckLogin",type:"POST",data:n.serialize(),success:function(a){console.log(a);var n=$.parseJSON(a);n.stats?(i.addClass("active").removeClass("warning"),i.find("strong").html(n.msg),i.find("span").html(""),setTimeout(()=>{window.location.href=urlSite+"Admin/Users"},1500)):(i.addClass("active warning"),i.find("strong").html("Confira os campos"),i.find("span").html(n.msg))}}):(i.addClass("active"),i.find("span").html("Preencha os dados corretamente"))})),$("form.formRecuperar").on("submit",(function(a){a.preventDefault();var n=$(this),s=!1,e=0,i=$(this).attr("action"),t=$("#notification");n.find(".form-control").each((function(){""==$(this).val()?(s=!1,e++):0==e&&(s=!0)})),s?$.ajax({url:i,type:"POST",data:n.serialize(),beforeSend:function(){t.addClass("active").removeClass("warning"),t.find("strong").html("Só um momento"),t.find("span").html("Estamos enviando para seu e-mail")},success:function(a){console.log(a);var n=$.parseJSON(a);n.stats?(t.addClass("active").removeClass("warning"),t.find("strong").html(n.msg),t.find("span").html("")):(t.addClass("active warning"),t.find("strong").html("Confira os campos"),t.find("span").html(n.msg))}}):(t.addClass("active"),t.find("span").html("Preencha os dados corretamente"))})),$("form.redefinirSenha").on("submit",(function(a){a.preventDefault();var n=$(this),s=!1,e=0,i=$(this).attr("action"),t=$("#notification");n.find(".form-control").each((function(){""==$(this).val()?(s=!1,e++):0==e&&(s=!0)})),s?$.ajax({url:i,type:"POST",data:n.serialize(),success:function(a){console.log(a);var n=$.parseJSON(a);n.stats?(t.addClass("active").removeClass("warning"),t.find("strong").html(n.msg),t.find("span").html(""),setTimeout(()=>{window.location.href=urlSite},1500)):(t.addClass("active warning"),t.find("strong").html("Confira os campos"),t.find("span").html(n.msg))}}):(t.addClass("active").removeClass("warning"),t.find("strong").html("Preencha os dados corretamente"),t.find("span").html("As senhas não batem"))})),$(".password1").keyup((function(a){a.preventDefault(),$(this).val().length>0&&$(this).val().length<=8?$(".redefinirSenha").find(".8char").addClass("ok"):$(".redefinirSenha").find(".8char").removeClass("ok"),/[a-z]/gm.test($(this).val())?$(".redefinirSenha").find(".minuscula").addClass("ok"):$(".redefinirSenha").find(".minuscula").removeClass("ok"),/[A-Z]/gm.test($(this).val())?$(".redefinirSenha").find(".maiuscula").addClass("ok"):$(".redefinirSenha").find(".maiuscula").removeClass("ok"),/(\W)|(\d)/gim.test($(this).val())?$(".redefinirSenha").find(".especial").addClass("ok"):$(".redefinirSenha").find(".especial").removeClass("ok")})),$(".verifySenha").focusout((function(a){a.preventDefault();var n=$(".verifySenha").val(),s=$(".password1").val(),e=$("#notification");n==s?console.log("aqui"):(e.addClass("active").removeClass("warning"),e.find("strong").html("Preencha os dados corretamente"),e.find("span").html("As senhas não batem"))})),$("#notification .closeNotification").on("click",(function(a){a.preventDefault(),$(this).parent().removeClass("active")}))}));