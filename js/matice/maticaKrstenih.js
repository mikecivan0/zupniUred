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
		text : 'Ovim postupkom obrisat ćete i podatke te osobe. Želite li doista obrisati ovaj zapis?',
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
				url : "../../ajax/matice/maticaKrstenih/brisanje.php",
				data : "mkId=" + $("#hfMkId").val(),
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
	    source: '../../ajax/matice/maticaKrstenih/nadjiZapis.php',
	    minLength: 2,
	    autoFocus: true,
	    focus: function( event, ui ) {
	    	event.preventDefault();
	    	},
	    select: function(event, ui) {
	          $('#hfOsobaId').val(ui.item.osoba_id);
	          $('input [type=button]').removeAttr('checked');
	          $('#zupa' + ui.item.zupa_id).prop('checked',true);
	          $('#brisanjeArea').show();
	          $('#porukaSpremanja').hide();
	          $('#hfMkId').val(ui.item.id);
	          $('#osoba').val(null);
	          $('#osoba').attr('placeholder', ui.item.ime + " " + ui.item.prezime);
	          $('#svezak').val(ui.item.svezak);
	          $('#zaGodinu').val(ui.item.zaGodinu);
	          $('#stranica').val(ui.item.stranica);
	          $('#broj').val(ui.item.broj);
	          $('#datumKrstenja').val(ui.item.datumKrstenja);
	          $('#mjestoKrstenja').val(ui.item.mjestoKrstenja);
	          $('#ime').val(ui.item.ime);
	          $('#prezime').val(ui.item.prezime);
	          $('#spol').val(ui.item.spol);
	          $('#datumRodjenja').val(ui.item.datumRodjenja);
	          $('#mjestoRodjenja').val(ui.item.mjestoRodjenja);
	          $('#jmbg').val(ui.item.jmbg);
	          $('#otac').val(ui.item.otac);
	          $('#majka').val(ui.item.majka);
	          $('#roditeljiVjencani').val(ui.item.roditeljiVjencani);
	          $('#mjestoPrebivanja').val(ui.item.prebivaliste);
	          $('#ulica').val(ui.item.ulica);
	          $('#kucniBroj').val(ui.item.kucniBroj);
	          $('#kum').val(ui.item.kum);
	          $('#krstitelj').val(ui.item.krstitelj);
	          $('#datumPricesti').val(ui.item.datumPricesti);
	          $('#mjestoPricesti').val(ui.item.mjestoPricesti);
	          $('#datumKrizme').val(ui.item.datumKrizme);
	          $('#mjestoKrizme').val(ui.item.mjestoKrizme);
	    	  tinyMCE.activeEditor.setContent(ui.item.zabiljeske);
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