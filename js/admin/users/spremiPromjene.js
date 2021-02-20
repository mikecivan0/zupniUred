//kontrola za unos korisničkog imena
$("#username").keyup(function() {
	if ($("#username").val().length < 1) {
		$(".button").attr("disabled", true);
		$("#forusername").addClass("error");
		if ($("smallErrorusername").length < 1) {
			$("<small id='smallErrorusername' class='error'>Obavezno korisničko ime</small>").insertAfter("#forusername");
		}
	} else {
		makniErrore("#forusername", "#smallErrorusername");
	}
});

//kontrola za unos lozinki
$("#password").keyup(function() {
	provjeriPodudarnostLozinki();
});

$("#passwordAgain").keyup(function() {
	provjeriPodudarnostLozinki();
});

function provjeriPodudarnostLozinki() {
	if ($("#password").val().length > 0 && $("#password").val() != $("#passwordAgain").val()) {
		$(".button").attr("disabled", true);
		$("#forpassword").addClass("error");
		$("#forpasswordAgain").addClass("error");
		if ($("#smallErrorpassword").length < 1) {
			$("<small id='smallErrorpassword' class='error'>Lozinka i ponovno lozinka se ne poklapaju</small>").insertAfter("#forpassword");
		}
		if ($("#smallErrorpasswordAgain").length < 1) {
			$("<small id='smallErrorpasswordAgain' class='error'>Lozinka i ponovno lozinka se ne poklapaju</small>").insertAfter("#forpasswordAgain");
		}
	} else {
		makniErrore("#forpassword", "#smallErrorpassword");
		makniErrore("#forpasswordAgain", "#smallErrorpasswordAgain");
	}
}

function makniErrore(selektor1, selektor2) {
	$(selektor1).removeClass("error");
	$(selektor2).remove();
	oslobodiButton();
}

function oslobodiButton() {
	if ($("small").length < 1) {
		$(".button").attr("disabled", false);
	}
}

function spremi() {
	var podaci = "id=" + $("#hfUserId").val() + "&username=" + $("#username").val() + "&razina=" + $("#razina option:selected").val() + "&aktivan=" + $("#aktivan option:selected").val() + "&istekLicence=" + $("#istekLicence").val();
	if ($("#password").val().length > 0) {
		podaci = podaci + "&password=" + $("#password").val();
	}
	$.ajax({
		type : "POST",
		url : "../../ajax/admin/users/spremiPromjene.php",
		data : podaci,
		success : function(vratioServer) {
			swal({
				title : 'Traženo - učinjeno!',
				text : vratioServer,
				type : 'success',
				timer : 1500,
				showConfirmButton : false
			});
		}
	});
}