

$("#password_conf").focusout( function(){

	if( $("#password").val() != $("#password_conf").val() )
	{
		$("#password_status").html("Password yang anda masukan tidak sama");
		$("#submit").attr("disabled","");
	}
	else
	{
		$("#submit").removeAttr("disabled");
	}
} );

$("#password_conf").focusin( function(){
	$("#password_status").html("");
} );
