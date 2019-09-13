$(function() {
	function reposition() {
		var modal = $(this),
			dialog = modal.find(".modal-dialog");
		modal.css("display", "block");
		dialog.css(
			"margin-top",
			Math.max(0, ($(window).height() - dialog.height()) / 2)
		);
	}

	$(".modal").on("show.bs.modal", reposition);
	$(window).on("resize", function() {
		$(".modal:visible").each(reposition);
	});
});

$(document).ready(function() {
	$("#goRight").on("click", function() {
		$("#slideBox").animate({
			marginLeft: "0"
		});

		$(".topLayer").animate({
			marginLeft: "100%"
		});
	});

	if ($(this).width() <= 600) {
		return $("#goLeft").on("click", function() {
			$("#slideBox").animate({
				marginLeft: "0"
			});
			$(".topLayer").animate({
				marginLeft: "0"
			});
		});
	}

	if ($(this).width() >= 991) {
		$("#button_register").click(function() {
			$("#slideBox").css("margin-right", "0");
			$("#slideBox").css("margin-left", "50%");
			$(".topLayer").css("margin-right", "100%");
			$(".topLayer").css("margin-left", "0");
		});
	}

	$("#goLeft").on("click", function() {
		$("#slideBox").animate({
			marginLeft: "50%"
		});

		$(".topLayer").animate({
			marginLeft: "0"
		});
	});

	$(".modal").on("show.bs.modal", reposition);

	$(window).on("resize", function() {
		$(".modal:visible").each(reposition);
	});

	$('.have-to-login').click(function() {
		$("#slideBox").css("margin-left", "0");
		$(".topLayer").css("margin-left", "100%");
	});

	$("#button_login").click(function() {
		$("#slideBox").css("margin-left", "0");
		$(".topLayer").css("margin-left", "100%");
	});

	$("#button_register").click(function() {
		$("#slideBox").css("margin-left", "50%");
		$(".topLayer").css("margin-left", "0");
	});
});

function reposition() {
	var modal = $(this),
		dialog = modal.find(".modal-dialog");
	modal.css("display", "block");
	dialog.css(
		"margin-top",
		Math.max(0, ($(window).height() - dialog.height()) / 2)
	);
}

$('a[data-toggle="modal"]').click(function() {
	window.location.hash = $(this).attr("data-target");
});

function revertToOriginalURL() {
	var original = window.location.href.substr(
		0,
		window.location.href.indexOf("#")
	);
	history.replaceState({}, document.title, original);
}

$(".modal").on("hidden.bs.modal", function() {
	revertToOriginalURL();
});

$(window).on("popstate", function(event) {
	//pressed back button
	if (event.state !== null) $(".modal").modal("hide");
});

$(window).bind("hashchange", function() {
	if (location.hash == null || location.hash == "") {
		$(".modal").modal("hide");
	}
});

$(".navbar-nav li a").click(function(event) {
	if (
		!$(this)
			.parent()
			.hasClass("dropdown")
	)
		$(".navbar-collapse").collapse("hide");
});

$("#formLogin > div.content > div.form-check > #pass-check").click(function() {
	if ($(this).is(":checked")) {
		$("#pass-id").attr("type", "text");
	} else {
		$("#pass-id").attr("type", "password");
	}
});
