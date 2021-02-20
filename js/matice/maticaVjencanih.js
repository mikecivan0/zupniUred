tinymce.init({
    selector:'#zabiljeske',
	theme: 'modern',
    height : 134,
    width: 550,
    toolbar: 'styleselect | bullist numlist',
    style_formats: [
        { title: '6px', inline: 'span', styles: { 'font-size': '6px'} },
        { title: '7px', inline: 'span', styles: { 'font-size': '7px'} },
        { title: '8px', inline: 'span', styles: { 'font-size': '8px'} },
        { title: '10px', inline: 'span', styles: { 'font-size': '10px'} },
        { title: '12px', inline: 'span', styles: { 'font-size': '12px'} },
        { title: '14px', inline: 'span', styles: { 'font-size': '14px'} },
    ]
});

$("#obrisi").click(function(event) {
	event.preventDefault();
	swal({
		title : 'Potvrda brisanja',
		text : 'Želite li doista obrisati ovaj zapis?',
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
				url : "../../ajax/matice/maticaVjencanih/brisanje.php",
				data : "mvId=" + $("#hfMvId").val(),
				success : function(vratioServer) {
					if (vratioServer == "Unos obrisan") {
						var prviDioPutanje = window.location.href.split("?")[0];
						window.location = prviDioPutanje + "?poruka";
					} else {
						swal('Greška!', vratioServer, 'error');
					}
				}
			});
		}
	});
});

$(function() {
    $("#osoba").autocomplete({
	    source: '../../ajax/matice/maticaVjencanih/nadjiZapis.php',
	    minLength: 2,
	    autoFocus: true,
	    focus: function( event, ui ) {
	    	event.preventDefault();
	    	},
	    select: function(event, ui) {
	          $('input [type=button]').removeAttr('checked');
	          $('#zupa' + ui.item.zupa_id).prop('checked',true);
	          $('#brisanjeArea').show();
	          $('#porukaSpremanja').hide();
	          $('#hfMvId').val(ui.item.id);
	          $('#hfMkIdOn').val(ui.item.mkIdOn);
	          $('#hfMkIdOna').val(ui.item.mkIdOna);
	          $('#osoba').val(null);
	          $('#osoba').attr('placeholder', ui.item.prezimeOn + " " + ui.item.imeOn + " i " + ui.item.prezimeOna + " " + ui.item.imeOna);
	          $('#svezak').val(ui.item.svezak);
	          $('#zaGodinu').val(ui.item.zaGodinu);
	          $('#stranica').val(ui.item.stranica);
	          $('#broj').val(ui.item.broj);
	          $('#datumVjencanja').val(ui.item.datumVjencanja);
	          $('#imeOn').val(ui.item.imeOn);
	          $('#imeOna').val(ui.item.imeOna);
	          $('#prezimeOn').val(ui.item.prezimeOn);
	          $('#prezimeOna').val(ui.item.prezimeOna);
	          $('#mjestoRodjenjaOn').val(ui.item.mjestoRodjenjaOn);
	          $('#mjestoRodjenjaOna').val(ui.item.mjestoRodjenjaOna);
	          $('#datumRodjenjaOn').val(ui.item.datumRodjenjaOn);
	          $('#datumRodjenjaOna').val(ui.item.datumRodjenjaOna);
	          $('#jmbgOn').val(ui.item.jmbgOn);
	          $('#jmbgOna').val(ui.item.jmbgOna);
	          $('#vjeraOn').val(ui.item.vjeraOn);
	          $('#vjeraOna').val(ui.item.vjeraOna);
	          $('#datumKrstenjaOn').val(ui.item.datumKrstenjaOn);
	          $('#datumKrstenjaOna').val(ui.item.datumKrstenjaOna);
	          $('#zupaKrstenjaOn').val(ui.item.zupaKrstenjaOn);
	          $('#zupaKrstenjaOna').val(ui.item.zupaKrstenjaOna);
	          $('#otacOn').val(ui.item.otacOn);
	          $('#otacOna').val(ui.item.otacOna);
	          $('#majkaOn').val(ui.item.majkaOn);
	          $('#majkaOna').val(ui.item.majkaOna);
	          $('#svjedokOn').val(ui.item.svjedokOn);
	          $('#svjedokOna').val(ui.item.svjedokOna);
	          $('#vjencatelj').val(ui.item.vjencatelj);
	    	  tinyMCE.activeEditor.setContent(ui.item.zabiljeske);
	        event.preventDefault();				
		}
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			var dv = item.datumVjencanja.split("-");
			var datumVjencanja = dv[2] + "." + dv[1] + "." + dv[0] + ".";
	    	return $( "<li>" )
			.append( "<a>matica župe: " + item.nazivZupe + ", " + item.prezimeOn + " " + item.imeOn + " i " + item.prezimeOna + " " + item.imeOna + ", datum vjenčanja:  " + datumVjencanja + "</a>" )
			.appendTo( ul );
	};
			    
	$("#osobaMk").autocomplete({
	    source: '../../ajax/matice/maticaKrstenih/nadjiZapis.php',
	    minLength: 2,
	    autoFocus: true,
	    appendTo: "#osobaModal",
	    focus: function( event, ui ) {
	    	event.preventDefault();
	    	},
	    select: function(event, ui) {
	    	var spol = (ui.item.spol==0) ? 'Ona' : 'On'; 
	    	  $("#osobaMk").val(null);
	    	  $("#osobaMk").attr('placeholder',ui.item.ime + " " + ui.item.prezime);
	    	  $("#hfMkId" + spol).val(ui.item.id);
	          $('#ime' + spol).val(ui.item.ime);
	          $('#prezime' + spol).val(ui.item.prezime);
	          $('#mjestoRodjenja' + spol).val(ui.item.mjestoRodjenja);
	          $('#datumRodjenja' + spol).val(ui.item.datumRodjenja);
	          $('#jmbg' + spol).val(ui.item.jmbg);
	          $('#vjera' + spol).val(ui.item.vjera);
	          $('#datumKrstenja' + spol).val(ui.item.datumKrstenja);
	          $('#zupaKrstenja' + spol).val(ui.item.nazivZupe);
	          $('#otac' + spol).val(ui.item.otac);
	          $('#majka' + spol).val(ui.item.majka);
	        event.preventDefault();				
	    }
		}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
			var dr = item.datumRodjenja.split("-");
			var datumRodjenja = dr[2] + "." + dr[1] + "." + dr[0] + ".";
		    return $( "<li>" )
		    .append( "<a>matica župe: " + item.nazivZupe + ", " + item.ime + " " + item.prezime + ", datum rođenja:  " + datumRodjenja + "</a>" )
		    .appendTo( ul );
		};
});             