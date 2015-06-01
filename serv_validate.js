$(document).ready(function() {
$('#status').hide();
$('#rlogin').on('click',function(){
$(location).attr('href','login.html');
});
$('#enroll').on('submit', function(e) {        

        var params = "fname=" + $("[name='fname']").val() +
		    "&mname=" + $("[name='mname']").val() +
			"&lname=" + $("[name='lname']").val() +
			"&relationship=" + $("[name='relationship']").val() +
            "&add1=" + $("[name='add1']").val() +
			"&add2=" + $("[name='add2']").val() +
            "&city=" + $("[name='city']").val() +
            "&state=" + $("[name='state']").val() +
            "&zip=" + $("[name='zip']").val()+
            "&areacode=" + $("[name='areacode']").val() +
			"&phoneprefix=" + $("[name='phoneprefix']").val() +
			"&phonesuffix=" + $("[name='phonesuffix']").val() +
			"&careacode=" + $("[name='careacode']").val() +
			"&cphoneprefix=" + $("[name='cphoneprefix']").val() +
			"&cphonesuffix=" + $("[name='cphonesuffix']").val() +
			"&email=" + $("[name='email']").val()+
			"&cfname=" + $("[name='cfname']").val() +
		    "&cmname=" + $("[name='cmname']").val() +
			"&clname=" + $("[name='clname']").val() +
  			"&name=" + $("[name='cname']").val() +
			"&img=" + $("[name='img']").val() +
			"&Gender=" + $("[name='Gender']").val() +
			"&mm=" + $("[name='mm']").val() +
			"&dd=" + $("[name='dd']").val() +
			"&yy=" + $("[name='yy']").val() +
			"&med=" + $("[name='med']").val() +
            "&diet=" + $("[name='diet']").val() +
            "&ename=" + $("[name='ename']").val() +
            "&eareacode=" + $("[name='eareacode']").val() +
			"&ephoneprefix=" + $("[name='ephoneprefix']").val() +
			"&ephonesuffix=" + $("[name='ephonesuffix']").val()+
            "&psel="+$("select[name='psel'] option:selected").val();		
			
        params = encodeURI(params);  
            
        var req = new HttpRequest('checkdupe.php?'+params,
        handleAnswer);
        req.send();
        e.preventDefault();        
        });
		
      function send_file() {    
        var form_data = new FormData($('#enroll')[0]);       
        form_data.append("image", document.getElementById("img").files[0]);
        $.ajax( {
            url: "fileupload.php",
            type: "post",
            data: form_data,
            processData: false,
            contentType: false,
            success: function(response) {
			var pname = $("#img").val();
             $('#photo').append("<img src=\"/~jadrn039/proj2-b/clickz/" + pname + "\" width='200px'/>"); 
                },
            error: function(response) {
              $('#photo').css('color','white');
               $('#photo').html("Sorry, an upload error occurred, "+response.statusText);
                }
            });
			}
			
			
    function handleAnswer(answer) {
	$('#status').show();		
	 if ($("#status").is(':visible')) {
    $("html, body").animate({scrollTop: $("#status").offset().top});
      }    
        if($.trim(answer) == "OK")  {
            var params = $('#enroll').serialize();
			params+="&img=" + $("[name='img']").val();
            $.post('processing.php', params,handleAjaxPost);
            }
        else if ($.trim(answer) == "DUP")
			duphandle();	
        else
           { 
		   $('#status').html(answer);
		   $('#status').css("border-color","red");
		   $('#status').css("color","red");
		   
		   }
            		
        }
		
		function duphandle(){
		$('#status').html("Sorry.. "+$('#fname').val()+",&nbsp; Looks like there is a duplication error <div id='errorshow'>"+$('#cfname').val()+"&nbsp; is already enrolled with us.</div>");			
			$('#status').css("border-color","red");
			$('#status').css("color","red");
		
		}
		
		function validityhandle(str){
		
		$('#status').html("Sorry.. "+$('#fname').val()+",&nbsp; Looks like there is a Validation error <div id='errorshow'>"+str+"</div>");			
			$('#status').css("border-color","red");
			$('#status').css("color","red");
		}
		function dberrorhandle(str){
		
		$('#status').html("Sorry.. "+$('#fname').val()+",&nbsp; Looks like there is a Database error <div id='errorshow'>"+str+"</div>");			
			$('#status').css("border-color","red");
			$('#status').css("color","red");
			
		}
        
    function handleAjaxPost(answer) {
	        var nvdbcheck=$.trim(answer.substring(0,2));
	        var nvdbmessage=$.trim(answer.substring(2));
            if ($.trim(answer) == "DUP")
			duphandle();
			else if (nvdbcheck == "NV")
		    validityhandle(nvdbmessage);
			else if (nvdbcheck == "DB")
		    dberrorhandle(nvdbmessage);
			else{
			$('#status').html("Congratulations,&nbsp;"+$('#fname').val()+" <div id='confirm'>"+$('#cfname').val()+"&nbsp; is successfully enrolled in our Summer Abroad Program</div>");
			$('#status').append(answer);
			$('#status').css("border-color","green");
			$('#status').css("color","green");
		
			send_file();
            }
        }        


	
	
	});