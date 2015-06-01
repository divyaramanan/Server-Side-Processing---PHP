$(document).ready(function() {
$('#loginstatus').hide();
$("[name='user']").focus();

$('form').on('submit', function(e)
{
var params = "user=" + $("[name='user']").val() +
		    "&pass=" + $("[name='pass']").val() +
			"&rep=" +$("input[name='rep']:checked").val();
			
			
	 $.post('authorize.php', params,handlelogin);
     e.preventDefault();  	 
});

function handlelogin(ans){
var answer = $.trim(ans);
$('#loginstatus').show();
$('#loginstatus').html(answer);


}
});