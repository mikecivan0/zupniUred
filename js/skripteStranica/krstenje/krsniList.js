tinymce.init({
	selector:'#zabiljeske',
    theme: 'modern',
    height : 134,
    width: 742,
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
             

$(function(){	
	$("#printP").children().click(function(){
	  $("#krsniList").attr('action', '../../printanje/krstenje/krsniList.php?vrstaDokumenta=1');
	  $('#krsniList').submit();
	});		
	
	$("#previewP").children().click(function(){
	  $('#krsniList').attr('action', '../../printanje/krstenje/krsniList.php?preview=true&vrstaDokumenta=1');
	  $('#krsniList').submit();
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
			    source: '../../ajax/matice/maticaKrstenih/nadjiZapis.php',
			    minLength: 2,
			    autoFocus: true,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
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
			          $('#datumKrstenja').val(ui.item.datumKrstenja);
			          $('#ime').val(ui.item.ime);
			          $('#prezime').val(ui.item.prezime);
			          $('#spol').val(ui.item.spol);
			          $('#datumRodjenja').val(ui.item.datumRodjenja);
			          $('#mjestoRodjenja').val(ui.item.mjestoRodjenja);
			          $('#jmbg').val(ui.item.jmbg);
			          $('#otac').val(ui.item.otac);
			          $('#majka').val(ui.item.majka);
			          $('#roditeljiVjencani').val(ui.item.roditeljiVjencani);
			          $('#prebivaliste').val(ui.item.ulica + " " + ui.item.kucniBroj + ", " + ui.item.prebivaliste);
			          $('#kum').val(ui.item.kum);
			          $('#krstitelj').val(ui.item.krstitelj);
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