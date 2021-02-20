tinymce.init({
	selector:'#zabiljeske',
    theme: "modern",
    height : 87,
    width: 742,
    toolbar: "styleselect | bullist numlist",
    style_formats: [
    	{ title: '6px', inline: 'span', styles: { 'font-size': '6px'} },
        { title: '7px', inline: 'span', styles: { 'font-size': '7px'} },
        { title: '8px', inline: 'span', styles: { 'font-size': '8px'} },
        { title: '10px', inline: 'span', styles: { 'font-size': '10px'} },
        { title: '12px', inline: 'span', styles: { 'font-size': '12px'} },
        { title: '14px', inline: 'span', styles: { 'font-size': '14px'} },
	]
});

$(function(){		
	$("#printP").children().click(function(){
	   $("#smrtniList").attr('action', '../../printanje/sprovod/smrtniList2.php?vrstaDokumenta=18');
	   $('#smrtniList').submit();
	});		
	
	$("#previewP").children().click(function(){
	   $('#smrtniList').attr('action', '../../printanje/sprovod/smrtniList2.php?preview=true&vrstaDokumenta=18');
	   $('#smrtniList').submit();
	});			
	
	$("#saveP").children().click(function(){
		if($("#ime").val().length==0||$("#prezime").val().length==0){
			swal('Greška!', 'Obavezno unijeti ime i prezime prije spremanja', 'error');
		}else{
			 $('form').attr('action', window.location.pathname);
			 $('form').removeAttr('target');
			 $('form').submit();
		}		
	});	
	
	$("#zapis").autocomplete({
			    source: '../../ajax/matice/maticaUmrlih/nadjiZapis.php',
			    minLength: 2,
			    autoFocus: true,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			    	  var dp = ui.item.datumPokopa.split("-");
					  var datumPokopa = dp[2] + "." + dp[1] + "." + dp[0] + ".";
					  var dr = ui.item.datumRodjenja.split("-");
					  var datumRodjenja = dr[2] + "." + dr[1] + "." + dr[0] + ".";
			    	  $("#zapis").val(null);
			    	  $("#zapis").attr('placeholder',ui.item.ime + " " + ui.item.prezime + ", datum rođenja: " + datumRodjenja);
			          $('input [type=button]').removeAttr('checked');
			          $('#zupa' + ui.item.zupa_id).prop('checked',true);
			          $('#hfZupaId').val(ui.item.zupa_id);
			          $('#matica').val(ui.item.nazivZupe);
			          $('#svezak').val(ui.item.svezak);
			          $('#zaGodinu').val(ui.item.zaGodinu);
			          $('#stranica').val(ui.item.stranica);
			          $('#broj').val(ui.item.broj);
			          $('#datumSmrti').val(ui.item.datumSmrti);
			          $('#mjestoSmrti').val(ui.item.mjestoSmrti);
			          $('#mjestoIDatumPokopa').val(ui.item.mjestoPokopa + ', ' + datumPokopa);
			          $('#prezime').val(ui.item.prezime);
			          $('#ime').val(ui.item.ime);
			          $('#spol').val(ui.item.spol);
			          $('#datumRodjenja').val(ui.item.datumRodjenja);
			          $('#mjestoRodjenja').val(ui.item.mjestoRodjenja);
			          $('#jmbg').val(ui.item.jmbg);
			          $('#supruznik').val(ui.item.supruznik);
			          $('#otac').val(ui.item.otac);
			          $('#majka').val(ui.item.majka);
			          $('#ulica').val(ui.item.ulica);
			          $('#kucniBroj').val(ui.item.kucniBroj);
			          $('#sakramenti').val(ui.item.potvrdjenSakramentima);
			          $('#sluzbenik').val(ui.item.sluzbenik);
			    	  tinyMCE.activeEditor.setContent(ui.item.zabiljeske);
			        event.preventDefault();				
			    }
				}).data( "ui-autocomplete" )._renderItem = function( ul, item ) {
				  var dr = item.datumRodjenja.split("-");
				  var datumRodjenja = dr[2] + "." + dr[1] + "." + dr[0] + ".";
			      return $( "<li>" )
			        .append( "<a>matica župe: " + item.nazivZupe + ", " + item.ime + " " + item.prezime + ", datum rođenja: " + datumRodjenja + "</a>" )
			        .appendTo( ul );
			    };		
});
 