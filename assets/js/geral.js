$(function () {
	var deviceDetect = {
		// Especifc
		Android: function () {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function () {
			return navigator.userAgent.match(/BlackBerry|BB10|PlayBook/i);
		},
		iPhone: function () {
			return navigator.userAgent.match(/iPhone|iPod/i);
		},
		iPad: function () {
			return navigator.userAgent.match(/iPad/i);
		},
		WindowsPhone: function () {
			return navigator.userAgent.match(/Windows Phone/i);
		},
		Windows: function () {
			return navigator.userAgent.match(/Windows/i);
		},
		Mac: function () {
			return navigator.userAgent.match(/Mac/i);
		},
		Linux: function () {
			return navigator.userAgent.match(/Linux/i);
		},

		// General
		desktop: function () {
			return (
				deviceDetect.Windows() || deviceDetect.Mac() || deviceDetect.Linux()
			);
		},
		tablet: function () {
			return deviceDetect.iPad();
		},
		mobile: function () {
			return (
				deviceDetect.Android() ||
				deviceDetect.BlackBerry() ||
				deviceDetect.iPhone() ||
				deviceDetect.WindowsPhone()
			);
		},

		// Navigators
		Chrome: function () {
			return navigator.userAgent.indexOf("Chrome") !== -1;
		},
		Firefox: function () {
			return typeof InstallTrigger !== "undefined";
		},
		Opera: function () {
			return (
				(!!window.opr && !!opr.addons) ||
				!!window.opera ||
				navigator.userAgent.indexOf(" OPR/") >= 0
			);
		},
		Safari: function () {
			return (
				/constructor/i.test(window.HTMLElement) ||
				(function (p) {
					return p.toString() === "[object SafariRemoteNotification]";
				})(
					!window["safari"] ||
						(typeof safari !== "undefined" && safari.pushNotification)
				)
			);
		},
		IE: function () {
			return /*@cc_on!@*/ false || !!document.documentMode;
		},
		Edge: function () {
			return !deviceDetect.IE() && !!window.StyleMedia;
		},
	};

	if (deviceDetect.mobile()) {
		$(document).ready(function () {
			$("#menuAnchor").removeClass("active");
			$("nav#menu").removeClass("open");
			$("#content").removeClass("menuopen");
			$(".search").removeClass("menuopen");
		});
	}

	$("#menuAnchor").on("click", function (e) {
		e.preventDefault();
		$(this).toggleClass("active");
		$("nav#menu").toggleClass("open");
		$("#content").toggleClass("menuopen");
		$(".search").toggleClass("menuopen");
	});

	$("#userAnchor").on("click", function (e) {
		e.preventDefault();
		$(this).parent().find(".popMenu").toggleClass("open");
	});

	$("#example1").DataTable({
		ordering: true,
		ajax: urlSite + "Admin/Users/getUsers",
		responsive: {
			details: false,
		},
		columns: [
			{ data: "ID" },
			{ data: "name" },
			{ data: "email" },
			{ data: "active" },
			{ data: "numberLogin" },
			{ data: "last_login" },
		],
		columnDefs: [{ className: "dt-center", targets: "_all" }],
	});
});
