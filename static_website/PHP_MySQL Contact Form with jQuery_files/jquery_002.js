$(document).ready(function() {
	contact.initEventHandlers();
});
var contact = {
	initEventHandlers	: function() {
		/* clicking the submit form */
		$('#send').bind('click',function(event){
			$('#loader').show();
			setTimeout('contact.ContactFormSubmit()',500);
		});
		/* remove messages when user wants to correct (focus on the input) */
		$('.inplaceError',$('#ContactForm')).bind('focus',function(){
			var $this 		= $(this);
			var $error_elem = $this.next();
			if($error_elem.length)
				$error_elem.fadeOut(function(){$(this).empty()});
			$('#success_message').empty();	
		});
		/* user presses enter - submits form */
		$('#ContactForm input,#ContactForm textarea').keypress(function (e) {
			if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) {  
				$("#send").click();
				return false;  
			} 
			else  
				return true;  
		});
	},
	ContactFormSubmit	: function() {
		$.ajax({
			   type		: 'POST',
			   url		: 'php/contact.php?ts='+new Date().getTime(),
			   dataType	: 'json',
			   data		: $('#ContactForm').serialize(),
			   success	: function(data,textStatus){
							  //hide the ajax loader
							  $('#loader').hide();
							  if(data.result == '1'){
							      //show success message
								  $('#success_message').empty().html('Message sent');
								  //reset all form fields
								  $('#ContactForm')[0].reset();	
								  //envelope animation
								  $('#envelope').stop().show().animate({'marginTop':'-175px','marginLeft':'-246px','width':'492px','height':'350px','opacity':'0'},function(){
								      $(this).css({'width':'246px','height':'175px','margin-left':'-123px','margin-top':'-88px','opacity':'1','display':'none'});
								  });
							  }
							  else if(data.result == '-1'){
								  for(var i=0; i < data.errors.length; ++i ){
								      if(data.errors[i].value!='')
								          $("#"+data.errors[i].name).next().html('<span>'+data.errors[i].value+'</span>').fadeIn();
								  }
							  }						  
						  },
			   error	: function(data,textStatus){}
		});
	}  
};