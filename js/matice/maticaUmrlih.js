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
				url : "../../ajax/matice/maticaUmrlih/brisanje.php",
				data : "muId=" + $("#hfMuId").val(),
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
    source: '../../ajax/matice/maticaUmrlih/nadjiZapis.php',
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
          $('#hfMuId').val(ui.item.id);
          $('#osoba').val(null);
          $('#osoba').attr('placeholder', ui.item.ime + " " + ui.item.prezime);
          $('#svezak').val(ui.item.svezak);
          $('#zaGodinu').val(ui.item.zaGodinu);
          $('#stranica').val(ui.item.stranica);
          $('#broj').val(ui.item.broj);
          $('#datumSmrti').val(ui.item.datumSmrti);
          $('#mjestoSmrti').val(ui.item.mjestoSmrti);
          $('#datumPokopa').val(ui.item.datumPokopa);
          $('#mjestoPokopa').val(ui.item.mjestoPokopa);
          $('#prezime').val(ui.item.prezime);
          $('#ime').val(ui.item.ime);
          $('#spol').val(ui.item.spol);
          $('#datumRodjenja').val(ui.item.datumRodjenja);
          $('#mjestoRodjenja').val(ui.item.mjestoRodjenja);
          $('#jmbg').val(ui.item.jmbg);
          $('#supruznik').val(ui.item.supruznik);
          $('#otac').val(ui.item.otac);
          $('#majka').val(ui.item.majka);
          $('#mjestoPrebivanja').val(ui.item.mjestoPrebivanja);
          $('#ulica').val(ui.item.ulica);
          $('#kucniBroj').val(ui.item.kucniBroj);
          $('#potvrdjenSakramentima').val(ui.item.potvrdjenSakramentima);
          $('#sluzbenik').val(ui.item.sluzbenik);
    	  tinyMCE.activeEditor.setContent(ui.item.zabiljeske);
          event.preventDefault();				
    }
}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
	var ds = item.datumSmrti.split("-");
	var datumSmrti = ds[2] + "." + ds[1] + "." + ds[0] + ".";
    return $( "<li>" )
    .append( "<a>matica župe: " + item.nazivZupe + ", " + item.ime + " " + item.prezime + ", datum smrti:  " + datumSmrti + "</a>" )
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
          $('input [type=button]').removeAttr('checked');
          $('#zupa' + ui.item.zupa_id).prop('checked',true);
    	  $("#osobaMk").val(null);
    	  $("#osobaMk").attr('placeholder',ui.item.ime + " " + ui.item.prezime + ", JMBG: " + ui.item.jmbg);
    	  $("#hfMkId").val(ui.item.id);
          $('#ime').val(ui.item.ime);
          $('#prezime').val(ui.item.prezime);
          $('#mjestoRodjenja').val(ui.item.mjestoRodjenja);
          $('#datumRodjenja').val(ui.item.datumRodjenja);
          $('#jmbg').val(ui.item.jmbg);
          $('#vjera').val(ui.item.vjera);
          $('#otac').val(ui.item.otac);
          $('#majka').val(ui.item.majka);
          $('#mjestoPrebivanja').val(ui.item.prebivaliste);
          $('#ulica').val(ui.item.ulica);
          $('#kucniBroj').val(ui.item.kucniBroj);
          event.preventDefault();				
    }
	}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
      .append( "<a>matica župe: " + item.nazivZupe + ", " + item.ime + " " + item.prezime + ",jmbg: " + item.jmbg + "</a>" )
      .appendTo( ul );
    };
});             