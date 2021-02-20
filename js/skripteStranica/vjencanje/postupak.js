$(function() {
	$("#printP").children().click(function() {
		$("#postupakZaZenidbu").attr('action', '../../printanje/vjencanje/postupak.php?vrstaDokumenta=4&stranica=' + $("#hfStranica").val());
		$('#postupakZaZenidbu').submit();
	});

	$("#previewP").children().click(function() {
		$('#postupakZaZenidbu').attr('action', '../../printanje/vjencanje/postupak.php?preview=true&vrstaDokumenta=4&stranica=' + $("#hfStranica").val());
		$('#postupakZaZenidbu').submit();
	});

	$("#saveP").children().click(function() {
		if ($("#prezimena").val().length == 0) {
			swal('Greška!', 'Obavezno u prvo polje unijeti prezimena zaručnika izaručnice prije spremanja', 'error');
		} else {
			$('form').attr('action', window.location.pathname);
			$('form').removeAttr('target');
			$('form').submit();
		}
	});

	$("#maloljetan").click(function() {
		$("#postupakZaZenidbu").attr('action', 'izjavaRoditelja.php?maloljetnik=1');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#onKatolikIzjava").click(function() {
		$("#postupakZaZenidbu").attr('action', 'izjave.php?katolik=1');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#onaKatolikIzjava").click(function() {
		$("#postupakZaZenidbu").attr('action', 'izjave.php?katolik=0');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#onKatolikMolbaZaOprost").click(function() {
		$("#postupakZaZenidbu").attr('action', 'molbaZaOprost.php?katolik=1');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#onaKatolikMolbaZaOprost").click(function() {
		$("#postupakZaZenidbu").attr('action', 'molbaZaOprost.php?katolik=0');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#onKatolikMolbaZaDopustenje").click(function() {
		$("#postupakZaZenidbu").attr('action', 'molbaZaMjesovituZenidbu.php?katolik=1');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#onaKatolikMolbaZaDopustenje").click(function() {
		$("#postupakZaZenidbu").attr('action', 'molbaZaMjesovituZenidbu.php?katolik=0');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("#maloljetna").click(function() {
		$("#postupakZaZenidbu").attr('action', 'izjavaRoditelja.php?maloljetnik=0');
		$('#postupakZaZenidbu').submit();
		event.preventDefault();
	});

	$("a[href*='stranica']").click(function() {
		$("#hfStranica").val($(this).attr('id'));
	});

	$("#imeIPrezimeOn").focusout(function() {
		$("#zarucnik").val($(this).val());
	});

	$("#imeIPrezimeOna").focusout(function() {
		$("#zarucnica").val($(this).val());
	});

	$("input[id^='zupa']").each(function() {
		$(this).autocomplete({
			source : '../../ajax/admin/zupe/nadjiZupu.php?distinct=true',
			minLength : 2,
			autoFocus : true,
			focus : function(event, ui) {
				event.preventDefault();
			},
			select : function(event, ui) {
				$(this).val(ui.item.nazivZupe);
				event.preventDefault();
			}
		}).data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>").append("<a>" + item.nazivZupe + "</a>").appendTo(ul);
		};
	});

	$("input[id^='mjestoKrstenja']").each(function() {
		$(this).autocomplete({
			source : '../../ajax/admin/mjesta/nadjiMjesto.php?distinct=true',
			minLength : 2,
			autoFocus : true,
			focus : function(event, ui) {
				event.preventDefault();
			},
			select : function(event, ui) {
				$(this).val(ui.item.nazivMjesta);
				event.preventDefault();
			}
		}).data("ui-autocomplete")._renderItem = function(ul, item) {
			return $("<li>").append("<a>" + item.nazivMjesta + "</a>").appendTo(ul);
		};
	});

	$("#datumRodjenjaOn").change(function() {
		je_li_punoljetnost($("#datumRodjenjaOn").val(), $("#maloljetan"));
	});

	$("#datumRodjenjaOna").change(function() {
		je_li_punoljetnost($("#datumRodjenjaOna").val(), $("#maloljetna"));
	});

	function je_li_punoljetnost(datum, target) {
		var splitted = datum.split("-");
		var g = splitted[0];
		var m = splitted[1];
		var d = splitted[2];
		danasnjiDatum = new Date();
		god = danasnjiDatum.getFullYear();
		mj = danasnjiDatum.getMonth();
		dan = danasnjiDatum.getDate();
		godina = god - g;

		if (mj < m - 1) {
			godina--;
		}

		if (m - 1 == mj && dan < d) {
			godina--;
		}

		if (godina < 18 && godina >= 0) {
			target.show();
		} else {
			target.hide();
		}
	}


	$('input[name=vjeraOn]').on('click', function() {
		if ($('input[name=vjeraOn]:checked').val() == 'drugo') {
			$("#vjeraOstaloOn").removeAttr('readonly');
			if ($('input[name=vjeraOna]:checked').val() && $('input[name=vjeraOna]:checked').val() == 'katolik') {
				$("#onKatolik").hide();
				$("#onaKatolik").show();
			} else {
				$("#onKatolik").hide();
				$("#onaKatolik").hide();
			}
		} else {
			$("#vjeraOstaloOn").attr('readonly', 'true');
			if ($('input[name=vjeraOna]:checked').val() && $('input[name=vjeraOna]:checked').val() == 'drugo') {
				$("#onKatolik").show();
				$("#onaKatolik").hide();
			} else {
				$("#onKatolik").hide();
				$("#onaKatolik").hide();
			}
		};

	});

	$('input[name=vjeraOna]').on('click', function() {
		if ($('input[name=vjeraOna]:checked').val() == 'drugo') {
			$("#vjeraOstaloOna").removeAttr('readonly');
			if ($('input[name=vjeraOn]:checked').val() && $('input[name=vjeraOn]:checked').val() == 'katolik') {
				$("#onKatolik").show();
				$("#onaKatolik").hide();
			} else {
				$("#onKatolik").hide();
				$("#onaKatolik").hide();
			}
		} else {
			$("#vjeraOstaloOna").attr('readonly', 'true');
			if ($('input[name=vjeraOn]:checked').val() && $('input[name=vjeraOn]:checked').val() == 'drugo') {
				$("#onKatolik").hide();
				$("#onaKatolik").show();
			} else {
				$("#onKatolik").hide();
				$("#onaKatolik").hide();
			}
		};
	});
});

