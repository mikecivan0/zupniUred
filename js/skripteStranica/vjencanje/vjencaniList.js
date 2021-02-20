tinymce.init({
	selector:'#zabiljeske',
    theme: "modern",
    height : 115,
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


$('#vjencateljOn').keyup(function () {
   $('#vjencateljOna').val($('#vjencateljOn').val());
});

$(function(){		
	$("#printP").children().click(function(){
	   $("#vjencaniList").attr('action', '../../printanje/vjencanje/vjencaniList.php?vrstaDokumenta=3');
	   $('#vjencaniList').submit();
	});		
	
	$("#previewP").children().click(function(){
	   $('#vjencaniList').attr('action', '../../printanje/vjencanje/vjencaniList.php?preview=true&vrstaDokumenta=3');
	   $('#vjencaniList').submit();
	});		
	
	$("#saveP").children().click(function(){
		if($("#imeOn").val().length==0||$("#prezimeOn").val().length==0||$("#imeOna").val().length==0||$("#prezimeOna").val().length==0){
			swal('Greška!', 'Obavezno unijeti imena i prezimena zaručnika prije spremanja', 'error');
		}else{
			 $('form').attr('action', window.location.pathname);
			 $('form').removeAttr('target');
			 $('form').submit();
		}		
	});	
	
	
	 $("#zapis").autocomplete({
			    source: '../../ajax/matice/maticaVjencanih/nadjiZapis.php',
			    minLength: 2,
			    autoFocus: true,
			    focus: function( event, ui ) {
			    	event.preventDefault();
			    	},
			    select: function(event, ui) {
			          $('input [type=button]').removeAttr('checked');
			          $('#zupa' + ui.item.zupa_id).prop('checked',true);
			          $('#hfZupaId').val(ui.item.zupa_id);
			          $('#matica').val(ui.item.nazivZupe);
			          $('#zapis').val(null);
			          $('#zapis').attr('placeholder', ui.item.prezimeOn + " " + ui.item.imeOn + " i " + ui.item.prezimeOna + " " + ui.item.imeOna);
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
			          $('#vjencateljOn,#vjencateljOna').val(ui.item.vjencatelj);
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
});
 