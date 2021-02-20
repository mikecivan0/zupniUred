$(function() {
	definirajPromjenuIBrisanje();
});

//autocomplete za pretragu matica muža i žene
$(function() {
	$("#maticaModal").autocomplete({
		source : '../ajax/obiteljskiListovi/pretraziMatice.php',
		minLength : 2,
		autoFocus : true,
		appendTo : "#pretragaMatica",
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			var odrediste = "#" + $("#odrediste").val();
			var zanimanje = (ui.item.zanimanje.length == 0) ? "" : ui.item.zanimanje;
			var datumRodjenja = (ui.item.datumRodjenja.length == 0) ? "" : ui.item.datumRodjenja;
			var mjestoRodjenja = (ui.item.mjestoRodjenja.length == 0) ? "" : ui.item.mjestoRodjenja;
			var datumKrstenja = (ui.item.datumKrstenja.length == 0) ? "" : ui.item.datumKrstenja;
			var mjestoKrstenja = (ui.item.mjestoKrstenja.length == 0) ? "" : ui.item.mjestoKrstenja;
			var datumPricesti = (ui.item.datumPricesti.length == 0) ? "" : ui.item.datumPricesti;
			var mjestoPricesti = (ui.item.mjestoPricesti.length == 0) ? "" : ui.item.mjestoPricesti;
			var datumKrizme = (ui.item.datumKrizme.length == 0) ? "" : ui.item.datumKrizme;
			var mjestoKrizme = (ui.item.mjestoKrizme.length == 0) ? "" : ui.item.mjestoKrizme;
			var datumSmrti = (ui.item.datumSmrti.length == 0) ? "" : ui.item.datumSmrti;
			var mjestoSmrti = (ui.item.mjestoSmrti.length == 0) ? "" : ui.item.mjestoSmrti;
			$("#maticaModal").attr('placeholder', ui.item.ime + " " + ui.item.prezime);
			$(odrediste + "Ime").val(ui.item.ime);
			$(odrediste + "Zanimanje").val(zanimanje);
			$(odrediste + "DatumRodjenja").val(datumRodjenja);
			$(odrediste + "MjestoRodjenja").val(mjestoRodjenja);
			$(odrediste + "DatumKrstenja").val(datumKrstenja);
			$(odrediste + "MjestoKrstenja").val(mjestoKrstenja);
			$(odrediste + "DatumPricesti").val(datumPricesti);
			$(odrediste + "MjestoPricesti").val(mjestoPricesti);
			$(odrediste + "DatumPotvrde").val(datumKrizme);
			$(odrediste + "MjestoPotvrde").val(mjestoKrizme);
			$(odrediste + "DatumSmrti").val(datumSmrti);
			$(odrediste + "MjestoSmrti").val(mjestoSmrti);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		var dr = item.datumRodjenja.split("-");
		var datumRodjenja = dr[2] + "." + dr[1] + "." + dr[0] + ".";
		return $("<li>").append("<a>" + item.ime + " " + item.prezime + ", datum rođenja:  " + datumRodjenja + "</a>").appendTo(ul);
	};
});

//autocomplete za pretragu matica ostalih
$(function() {
	$("#maticaModalOstali").autocomplete({
		source : '../ajax/obiteljskiListovi/pretraziMatice.php',
		minLength : 2,
		autoFocus : true,
		appendTo : "#noviClan",
		focus : function(event, ui) {
			event.preventDefault();
		},
		select : function(event, ui) {
			var zanimanje = (ui.item.zanimanje.length == 0) ? "" : ui.item.zanimanje;
			var datumRodjenja = (ui.item.datumRodjenja.length == 0) ? "" : ui.item.datumRodjenja;
			var mjestoRodjenja = (ui.item.mjestoRodjenja.length == 0) ? "" : ui.item.mjestoRodjenja;
			var datumKrstenja = (ui.item.datumKrstenja.length == 0) ? "" : ui.item.datumKrstenja;
			var mjestoKrstenja = (ui.item.mjestoKrstenja.length == 0) ? "" : ui.item.mjestoKrstenja;
			var datumPricesti = (ui.item.datumPricesti.length == 0) ? "" : ui.item.datumPricesti;
			var mjestoPricesti = (ui.item.mjestoPricesti.length == 0) ? "" : ui.item.mjestoPricesti;
			var datumKrizme = (ui.item.datumKrizme.length == 0) ? "" : ui.item.datumKrizme;
			var datumVjencanja = (ui.item.datumVjencanja.length == 0) ? "" : ui.item.datumVjencanja;
			var mjestoKrizme = (ui.item.mjestoKrizme.length == 0) ? "" : ui.item.mjestoKrizme;
			var datumSmrti = (ui.item.datumSmrti.length == 0) ? "" : ui.item.datumSmrti;
			var mjestoSmrti = (ui.item.mjestoSmrti.length == 0) ? "" : ui.item.mjestoSmrti;
			$("#maticaModalOstali").attr('placeholder', ui.item.ime + " " + ui.item.prezime);
			$("#ime").val(ui.item.ime);
			$("#zanimanje").val(zanimanje);
			$("#datumRodjenja").val(datumRodjenja);
			$("#mjestoRodjenja").val(mjestoRodjenja);
			$("#datumKrstenja").val(datumKrstenja);
			$("#mjestoKrstenja").val(mjestoKrstenja);
			$("#datumPricesti").val(datumPricesti);
			$("#mjestoPricesti").val(mjestoPricesti);
			$("#datumPotvrde").val(datumKrizme);
			$("#mjestoPotvrde").val(mjestoKrizme);
			$("#datumVjencanja").val(datumVjencanja);
			$("#datumSmrti").val(datumSmrti);
			$("#mjestoSmrti").val(mjestoSmrti);
			event.preventDefault();
		}
	}).data("ui-autocomplete")._renderItem = function(ul, item) {
		var dr = item.datumRodjenja.split("-");
		var datumRodjenja = dr[2] + "." + dr[1] + "." + dr[0] + ".";
		return $("<li>").append("<a>" + item.ime + " " + item.prezime + ", datum rođenja:  " + datumRodjenja + "</a>").appendTo(ul);
	};
});

function definirajPromjenuIBrisanje() {
	//klik gumba za promjenu podataka člana
	$(".promijeni").on('click', (function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		//dodavanje podataka u modal
		$.ajax({
			type : "POST",
			url : "../ajax/obiteljskiListovi/nadjiClana.php",
			data : "id=" + id,
			success : function(vratioServer) {
				if (vratioServer == 'Error') {
					swal('Greška', 'Ne možete mijenjati podatke tuđih obiteljskih listova!', 'error');
				} else {
					$("#modalClanId").val(id);
					$("#akcija").val("promjena");
					$("#gumbModalaClana").html("Unesi izmjene");
					$("#modalTitle").html("Promjena podataka člana");
					var podaci = $.parseJSON(vratioServer);
					uvrstiUModal(podaci);
				}
			}
		});
	}));

	//klik na gumb brisanja člana iz tablice
	$(".obrisi").on('click', (function(event) {
		event.preventDefault();
		var id = $(this).attr('id');
		swal({
			title : 'Potvrda brisanja',
			text : 'Želite li doista obrisati ovog člana sa popisa?',
			type : 'warning',
			showCancelButton : true,
			confirmButtonColor : '#3085d6',
			cancelButtonColor : '#d33',
			confirmButtonText : 'Da, obriši!',
			cancelButtonText : 'Ne, odustani!',
		}).then(function(result) {
			if (result.value) {
				$.ajax({
					type : "POST",
					url : "../ajax/obiteljskiListovi/brisanjeClana.php",
					data : "id=" + id,
					success : function(vratioServer) {
						if (vratioServer == "Član obrisan") {
							$("#tr1Clan" + id).remove();
							$("#tr2Clan" + id).remove();
							swal({
								title : 'Traženo - učinjeno!',
								text : vratioServer,
								type : 'success',
								timer : 1500,
								showConfirmButton : false
							});
						} else {
							swal('Greška!', vratioServer, 'error');
						}
					}
				});
			}
		});
	}));
}


$(".brisanjeOL").click(function() {
	event.preventDefault();
	var id = $(this).attr('id');
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati ovaj obiteljski list i sve njegove članove?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			$.ajax({
				type : "POST",
				url : "../ajax/obiteljskiListovi/brisanjeOL.php",
				data : "id=" + id,
				success : function(vratioServer) {
					if (vratioServer == "Obrisano") {
						window.location.replace("index.php");
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
});

//klik gumba za brisanje podataka muža
$("#obrisiMuza").click(function() {
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati podatke muža?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			$.ajax({
				type : "POST",
				url : "../ajax/obiteljskiListovi/brisanjeClana.php",
				data : "id=" + $("#muzClanId").val(),
				success : function(vratioServer) {
					if (vratioServer == "Član obrisan") {
						$("input[name^='muz']").removeAttr("value");
						$("#obrisiMuza").hide();
						swal({
							title : 'Traženo - učinjeno!',
							text : 'Obrisani su podaci muža',
							type : 'success',
							timer : 1500,
							showConfirmButton : false
						});
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
});

//klik gumba za brisanje podataka žene
$("#obrisiZenu").click(function() {
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati podatke žene?',
		type : 'warning',
		showCancelButton : true,
		confirmButtonColor : '#3085d6',
		cancelButtonColor : '#d33',
		confirmButtonText : 'Da, obriši!',
		cancelButtonText : 'Ne, odustani!',
	}).then(function(result) {
		if (result.value) {
			$.ajax({
				type : "POST",
				url : "../ajax/obiteljskiListovi/brisanjeClana.php",
				data : "id=" + $("#zenaClanId").val(),
				success : function(vratioServer) {
					if (vratioServer == "Član obrisan") {
						$("input[name^='zena']").removeAttr("value");
						$("#obrisiZenu").hide();
						swal({
							title : 'Traženo - učinjeno!',
							text : 'Obrisani su podaci žene',
							type : 'success',
							timer : 1500,
							showConfirmButton : false
						});
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
});

//klik gumba za dodavanje novoga člana
$("#novoDijete,#noviUkucanin").click(function() {
	resetirajPoljaModala();
	if (jQuery(this).attr("id") == "novoDijete") {
		$("#ulogaId").val("3");
	} else {
		$("#ulogaId").val("4");
	}

	$("#akcija").val("novi");
	$("#gumbModalaClana").html("Unesi novog člana");
	$("#modalTitle").html("Novi član");
});

//klik gumba potvrde u modalu
$("#gumbModalaClana").click(function() {

	if ($("#ime").val().length == 0) {//prvo provjera je li ime unešeno
		swal('Greška', 'Obavezno unesite ime', 'error');
	} else {

		var postStr = '';
		//osnovna varijabla

		if ($("#akcija").val() == "promjena") {//ako je promjena

			//dodati ajax za dohvaćanje podataka člana i dodavanje vrijednosti u polja modala
			$("#noviClan").find("input").each(function() {
				postStr += $(this).attr("name") + "=" + $(this).val() + "&";
				//stvaranje stringa sa vrijednostima svih inputa u modalu
			});

		} else {//ako je unos novog člana
			var postUrl = "../ajax/obiteljskiListovi/noviClan.php";
			$("#noviClan").find("input:visible").each(function() {
				postStr += $(this).attr("name") + "=" + $(this).val() + "&";
				//stvaranje stringa sa vrijednostima svih VIDLJIVIH inputa u modalu
			});
			postStr += "uloga_id=" + $("#ulogaId").val() + "&";
		}

		postStr += "ol_id=" + $("#hfOlId").val() + "&zupa_id=" + $("input[name=zupa]:checked").val();
		//dodavanje obaveznih polja
		$.ajax({
			type : "POST",
			url : "../ajax/obiteljskiListovi/clanovi.php",
			data : postStr,
			success : function(vratioServer) {
				if (vratioServer == "Error") {
					swal('Greška', 'Ne možete mijenjati podatke tuđih obiteljskih listova!', 'error');
					resetirajPoljaModala();
				} else {
					var podaci = $.parseJSON(vratioServer);
					if ($("#akcija").val() == "promjena") {
						uvrstiUTablicu(podaci);
					} else {
						dodajUTablicu(podaci);
					}

				}

			}
		});
		resetirajPoljaModala();
	}
});

function uvrstiUTablicu(podaci) {
	var id = podaci.id;
	$("#ime" + id).html(podaci.ime);
	$("#datumRodjenja" + id).html(datum(podaci.datumRodjenja));
	$("#datumKrstenja" + id).html(datum(podaci.datumKrstenja));
	$("#datumPricesti" + id).html(datum(podaci.datumPricesti));
	$("#datumPotvrde" + id).html(datum(podaci.datumPotvrde));
	$("#datumVjencanja" + id).html(datum(podaci.datumVjencanja));
	$("#datumSmrti" + id).html(datum(podaci.datumSmrti));
	$("#mjestoRodjenja" + id).html(podaci.mjestoRodjenja);
	$("#mjestoKrstenja" + id).html(podaci.mjestoKrstenja);
	$("#mjestoPricesti" + id).html(podaci.mjestoPricesti);
	$("#mjestoPotvrde" + id).html(podaci.mjestoPotvrde);
	$("#mjestoVjencanja" + id).html(podaci.mjestoVjencanja);
	$("#mjestoSmrti" + id).html(podaci.mjestoSmrti);
}

function dodajUTablicu(podaci) {
	var id = podaci.id;
	if (podaci.uloga_id == 3) {
		var tablica = $("#tablicaDjece");
	} else {
		var tablica = $("#tablicaUkucana");
	}

	var noviPodaci = '<tr id="tr1Clan' + id + '">' + '<td id="ime' + id + '" rowspan="2" style="border-bottom: black 1px solid;">' + podaci.ime + '</td>' + '<td><b>kada</b></td>' + '<td id="datumRodjenja' + id + '">' + datum(podaci.datumRodjenja) + '</td>' + '<td id="datumKrstenja' + id + '">' + datum(podaci.datumKrstenja) + '</td>' + '<td id="datumPricesti' + id + '">' + datum(podaci.datumPricesti) + '</td>' + '<td id="datumPotvrde' + id + '">' + datum(podaci.datumPotvrde) + '</td>' + '<td id="datumVjencanja' + id + '">' + datum(podaci.datumVjencanja) + '</td>' + '<td id="datumSmrti' + id + '">' + datum(podaci.datumSmrti) + '</td>' + '<td rowspan="2" class="center" style="border-bottom: black 1px solid;">' + '<a href="#" data-reveal-id="noviClan" class="bezDonjeCrte promijeni" id="' + id + '">' + '<img src="../img/admin/pen.png" class="pr10">' + '</a>' + '<a href="#" class="obrisi" id="' + id + '">' + '<img src="../img/admin/bin.png">' + '</a>' + '</td>' + '</tr>' + '<tr id="tr2Clan' + id + '" style="border-bottom: black 1px solid;">' + '<td><b>gdje</b></td>' + '<td id="mjestoRodjenja' + id + '">' + podaci.mjestoRodjenja + '</td>' + '<td id="mjestoKrstenja' + id + '">' + podaci.mjestoKrstenja + '</td>' + '<td id="mjestoPricesti' + id + '">' + podaci.mjestoPricesti + '</td>' + '<td id="mjestoPotvrde' + id + '">' + podaci.mjestoPotvrde + '</td>' + '<td id="mjestoVjencanja' + id + '">' + podaci.mjestoVjencanja + '</td>' + '<td id="mjestoSmrti' + id + '">' + podaci.mjestoSmrti + '</td>' + '</tr>';

	tablica.append(noviPodaci);

	definirajPromjenuIBrisanje();
}

function uvrstiUModal(podaci) {
	$("#ime").val(podaci.ime);
	$("#datumRodjenja").val(podaci.datumRodjenja);
	$("#mjestoRodjenja").val(podaci.mjestoRodjenja);
	$("#datumKrstenja").val(podaci.datumKrstenja);
	$("#mjestoKrstenja").val(podaci.mjestoKrstenja);
	$("#datumPriceti").val(podaci.datumPriceti);
	$("#mjestoPricesti").val(podaci.mjestoPricesti);
	$("#datumPotvrde").val(podaci.datumPotvrde);
	$("#mjestoPotvrde").val(podaci.mjestoPotvrde);
	$("#datumVjencanja").val(podaci.datumVjencanja);
	$("#mjestoVjencanja").val(podaci.mjestoVjencanja);
	$("#datumSmrti").val(podaci.datumSmrti);
	$("#mjestoSmrti").val(podaci.mjestoSmrti);
	$("#modalClanId").val(podaci.id);
}

function resetirajPoljaModala() {
	$("#noviClan > div").find("input").val('');
}

function datum(datum) {
	if (datum.length > 0) {
		var dijeloviDatuma = datum.split("-");
		return dijeloviDatuma[2] + "." + dijeloviDatuma[1] + "." + dijeloviDatuma[0] + ".";
	} else {
		return '';
	}
}

function odrediste(num) {
	var dodatak = "";
	switch(num) {
	case 1:
		dodatak = "muz";
		break;

	case 2:
		dodatak = "zena";
		break;
	}
	$("#odrediste").val(dodatak);
}
