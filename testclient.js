/* 
            Rajagopal,Divya    Account:jadrn039
            CS545, Fall 2014
            Project #2
      
*/ 

$(document).ready(function(){
  $('#fname').focus();
  $('#parenterror').hide();
  $('#reqspace').hide();
  var pmsg=[""];
  var pcont=0;
  var disp = pmsg[pmsg.length-1];
  var pass,i;
  var diverror=$('#parenterror');
  var j=0,reqdisp;
  var reqerror=[],ids;
  var isvalid=false;
  
  //Array of messages which should be displayed if user has made an error which is checked during blur of the field.
  var errormsg=["Enter 5 digit Zipcode",
                "Enter Valid State Code",
                "Enter 3 digit Area Code for Home Phone",
                 "Enter 3 digit Prefix Code for Home Phone",
                 "Enter 4 digit Phone Number for Home Phone",
                 "Upload image of types: .jpg .jpeg .png .gif",
                  "Enter Valid date",
                  "Enter valid Email id",
                  "Enter a valid city without numbers or special characters",
                  "Enter 3 digit Area Code for Cell Phone",
                 "Enter 3 digit Prefix Code for Cell Phone",
                 "Enter 4 digit Phone Number for Cell Phone",
                  "Enter 3 digit Area Code for Emergency Phone",
                 "Enter 3 digit Prefix Code for Emergency Phone",
                 "Enter 4 digit Phone Number for Emergency Phone",
                 "Age should be between 12 and 18 years"];
      
      //Array of messages which should be displayed if user has not entered the field untill submit
    var reqmsg=[
                "Parent's First Name Required",
                "Selection of a program is required",
                "Parent's Last Name Required",
                 "Relationship to the child is Required",
                 "Address is Required",
                  "City is Required",
                  "State Code is required",
                 "Zipcode is Required",
                  "Area Code in the Home phone number is required",
                  "Prefix code in the Home phone number is required",
                  "Phone number in the Home phone number is required",
                  "Area Code in the Cell phone number is required",
                  "Prefix code in the Cell phone number is required",
                   "Phone number in the Cell phone number is required",
                   "Email id is required",
                   "Child's First Name Required",
                   "Child's Last Name Required",
                   "Name that child goes by is required",
                   "Child's Gender is required",
                   "Child's Photo is required",
                   "Child's Month of Birth is required",
                   "Child's Date of Birth is required",
                   "Child's Year of Birth is required",
                   "Emergency contact name is required",
                   "Area Code in the Emergency phone number is required",
                   "Prefix code in the Emergency phone number is required",
                   "Phone number in the Emergency phone number is required"
               ];
               
               
      //Getting elements by ids. Getting elements by names in the case of radio buttons
  var id=[$('#fname'),$('#psel'),$('#lname'),$("relationship"),$('#add1'),$('#city'),$('#state'),
          $('#zip'),$('#area1'),$('#prefix1'),$('#suffix1'),$('#area2'),$('#prefix2'),
          $('#suffix2'),$('#email'),$('#cfname'),$('#clname'),$('#cname'),
          $("Gender"),$('#img'),$('#mm'),$('#dd'),$('#yy'),$('#ename'),$('#area3'),$('#prefix3'),$('#suffix3')];
  
  //Initializing the reqerror array which checks if required fields are entered
  for(j=0;j<=26;j++)
      reqerror[j]=1;
  
  //Function to remove the required field error if the field is entered
  function req(j){
       $('#reqspace').hide();
     reqerror[j]=0;
     reqdisp="";
     errordisappear(id[j]);
     $('#reqspace').text(reqdisp);
    
  }
  
  //Function to add the required field error if the field is not entered until submit
 function missreq(j)
 {
    
     $('#reqspace').show();
     reqerror[j]=1;
     reqdisp=reqmsg[j];
     errorappear(id[j]);
     $('#reqspace').text(reqdisp);
      id[j].focus();
      $('#reqspace').html('<img src="erroricon.png" alt=""/><br/><span class="errorspan">'+reqdisp+'</span>');
     
 }
 
 //Function to remove the required field error if the user moves to another input field
 function removerrornow(j)
 {
     $('#reqspace').hide();
      reqerror[j]=1;
      errordisappear(id[j]);
      reqdisp="";
     $('#reqspace').text(reqdisp);
 }
 
 //Function to check if all required fields are entered before submission
 function checkonsubmit(){
     for(j=0;j<=26;j++)
     {
           
         if(reqerror[j]===1)
         {
             missreq(j);             
             return false;     
        }   
           
     }
     
     if(isvalid)
        return false;
 
         return true;
       
 }
 
 //Indicates the error by changing the input field to red color
 function errorappear(ids){
  ids.css("border-color","red");
  ids.css("background-color","#FFD6CC"); 
  
  //Changing the relationship radio button appearance
  if(ids===id[3])
  $(".radiob").addClass("radioa");
  
  //Changing the Gender radio button appearance
  if(ids===id[18])
  $(".radioc").addClass("radioa");    
 }
 
 //Changes the red color of the field to defalut.
 function errordisappear(ids){
 ids.css("border-color","black");
 ids.css("background-color","#FFFFFF");
 
 //Changing the relationship radio button appearance
 if(ids===id[3])
  $(".radiob").removeClass("radioa");
  
 //Changing the Gender radio button appearance
  if(ids===id[18])
  $(".radioc").removeClass("radioa");
      }

//Removes Validation errors if the field becomes empty
function removevaliderror(i)
{
    if($.inArray(errormsg[i],pmsg)!== -1){
        remove($(this),i);
        
}}

//Inserting an error in the array
function insert(pass,i){
    
errorappear(pass);
 
   if($.inArray(errormsg[i],pmsg)=== -1)
{ 
    pmsg.push(errormsg[i]);
    pcont++;  
    
}
else
{
   
 pmsg=elementshift(pmsg,i);   
  
}
displayblur();
}

//Shifting the error element to the end of the array for popping 
function elementshift(pmsg,i)
{
   var tempindex = pmsg.indexOf(errormsg[i]);
     
    for(var count=tempindex;count<pcont;count++)
    {    
       pmsg[count]=pmsg[count+1];  
    }   
    pmsg[pcont]=errormsg[i];  
    return pmsg;
}


// Removing the error from array
function remove(pass,i)
{ 
errordisappear(pass);

 if(pmsg[pcont] === errormsg[i])
 {  
  
 pmsg.pop();
 pcont--;
 
 }
 else{
      
     if(pmsg.length>1)
     {
     var tempindex = pmsg.indexOf(errormsg[i]);
     if(tempindex!==-1)
     {
    pmsg=elementshift(pmsg,i);
    remove(pass,i);
     }
    }
 }

 displayblur();
}

//Displays the Validation error inside the fixed positioned containers
function displayblur()
{
   
  disp = pmsg[pcont];
  
  diverror.html('<img src="erroricon.png" alt=""/><br/><span class="errorspan">'+disp+'</span>');
  if(disp!=="")
  {    
     
      isvalid=true;
     diverror.show();
 }
else
{   
    isvalid=false;
  diverror.hide();
  } 
    
}


// Zip Code Validation - Checking if non-empty and has 5 numbers
  $('#zip').on('blur',function(){
  if($.trim($(this).val().length)>0)
  {
      req(7);
    if(($.isNumeric($(this).val())===false)||($(this).val().length!==5)) 
          insert($(this),0);      
      
      else
           remove($(this),0);  
  }
  else
  {
    removerrornow(7);
    removevaliderror(0);
    
  }
});


//Phone Number Validation

//Phone Validation Variables
  var areaarr=[area1,area2,area3];
  var prefarr=[prefix1,prefix2,prefix3];
  var suffarr=[suffix1,suffix2,suffix3];
  

//Area Code Validation Checking if non-empty and has 3 numbers
 $(areaarr).on('blur',function(){
  if($.trim($(this).val().length)>0)
  {
      if(this===area1)
              req(8);
          if(this===area2)
              req(11);
          if(this===area3)
              req(24);
          
      if(($.isNumeric($.trim($(this).val()))===false)||($.trim($(this).val()).length!==3))
      {
          
          if(this===area1)
              insert($(this),2);
          if(this===area2)
              insert($(this),9);
          if(this===area3)
              insert($(this),12);
      }
      else
      {
          
          if(this===area1)
              remove($(this),2);
          if(this===area2)
              remove($(this),9);
          if(this===area3)
              remove($(this),12);
      }
      
  }
  else{
      if(this===area1)
         {
              removerrornow(8);
              removevaliderror(2);
          }    
          if(this===area2)
          {    removerrornow(11);
              removevaliderror(9);
          }
          if(this===area3)
          {
              removerrornow(24);
              removevaliderror(12);
          }
  }
});

//Prefix Code Validation Checking if non-empty and has 3 numbers
 $(prefarr).on('blur',function(){
     
 if($.trim($(this).val().length)>0)
  {
       if(this===prefix1)
              req(9);
          if(this===prefix2)
              req(12);
          if(this===prefix3)
              req(25);
       if(($.isNumeric($.trim($(this).val()))===false)||($.trim($(this).val()).length!==3))
         {
          
          if(this===prefix1)
          insert($(this),3);
          if(this===prefix2)
              insert($(this),10);
          if(this===prefix3)
              insert($(this),13);
      } 
      else
         {
          if(this===prefix1)
              remove($(this),3);
          if(this===prefix2)
              remove($(this),10);
          if(this===prefix3)
              remove($(this),13);
      }
      
  }
  else{
        if(this===prefix1)
        {
             removerrornow(9);
         removevaliderror(3);
         }
          if(this===prefix2)
          {
             removerrornow(12);
         removevaliderror(10);
          }
          if(this===prefix3)
          {
             removerrornow(25);
         removevaliderror(13);
          }
  }
});

//Suffix Code Validation - Checking if non-empty and has 4 numbers
$(suffarr).on('blur',function(){
  if($.trim($(this).val()).length>0)
  {
       if(this===suffix1)
              req(10);
          if(this===suffix2)
              req(13);
          if(this===suffix3)
              req(26);
      if(($.isNumeric($.trim($(this).val()))===false)||($.trim($(this).val()).length!==4))
        {
          
          if(this===suffix1)
          insert($(this),4);
          if(this===suffix2)
              insert($(this),11);
          if(this===suffix3)
              insert($(this),14);
      }      
      else
         {
          if(this===suffix1)
              remove($(this),4);
          if(this===suffix2)
              remove($(this),11);
          if(this===suffix3)
              remove($(this),14);
      }
   }
   else{
     if(this===suffix1)
            {
                removerrornow(10);
               removevaliderror(4);
           }
     if(this===suffix2)
           {
              removerrornow(13);
          removevaliderror(11);
           }
     if(this===suffix3)
        {
              removerrornow(26);
          removevaliderror(14);
        }
  }
});

//Image type Validation - Checking if non-empty and is of type JPG/PNG/JPEG/GIF
$('#img').on('blur',function(){
  if($(this).val().length>0)
  {
      req(19);
var extension = $(img).val().split('.').pop().toUpperCase();
if (extension!=="PNG" && extension!=="JPG" && extension!=="GIF" && extension!=="JPEG")
  insert($(this),5);  

else
    remove($(this),5);

  }
  else{
      removerrornow(19);
      removevaliderror(5);
  }
  
});

 //Month of DOB Validation - Checking if non-empty
     $('#mm').on('blur',function(){
       if($.trim($(this).val()).length>0)
        req(20);
       else
        removerrornow(20);
     });
     
     //Date of DOB Validation - Checking if non-empty
     $('#dd').on('blur',function(){
       if($.trim($(this).val()).length>0)
        req(21);
       else
        removerrornow(21);
     });
     
     //Year of DOB Validation - Checking if non-empty
     $('#yy').on('blur',function(){
       if($.trim($(this).val()).length>0)
        req(22);
       else
        removerrornow(22);
     });
     
//Date Validation - Checking if it is a valid date
var datearr=[dd,mm,yy];
$(datearr).on('blur',function(){
    if(($('#dd').val().length>0)&&($('#mm').val().length>0)&&($('#yy').val().length>0))
    {
    var day = document.getElementById("dd").value; 
    var month = document.getElementById("mm").value;
    var year = document.getElementById("yy").value;
    
    
    var checkDate = new Date(year, month-1, day);    
    var checkDay = checkDate.getDate();
    var checkMonth = checkDate.getMonth()+1;
    var checkYear = checkDate.getFullYear();
    
    if(day == checkDay && month == checkMonth && year == checkYear)
    {
        errordisappear($('#mm'));
        errordisappear($('#dd'));
        errordisappear($('#yy'));
        remove($(this),6);
        
        //Age Validation - Checking if age is between 12 and 18 years
        var refdate = new Date(2014,5,1);
        var age = Math.floor((refdate-checkDate) / (365.25 * 24 * 60 * 60 * 1000));
        if(age>=12&&age<=18)
        {
        errordisappear($('#mm'));
        errordisappear($('#dd'));
        errordisappear($('#yy'));
        remove($(this),15);
        }
        else
        {
          errorappear($('#mm'));
        errorappear($('#dd'));
        errorappear($('#yy'));
          insert($(this),15);  
        }
     }
    else
    {
      
      errorappear($('#mm'));
      errorappear($('#dd'));
      errorappear($('#yy'));
      insert($(this),6);
    }
   }
    if(($('#dd').val().length===0)&&($('#mm').val().length===0)&&($('#yy').val().length===0))
    {   
        removevaliderror(6);
         removevaliderror(15);
     }  
});

 //State Validation - Checking if the entered state code is in this list
 var statearr =  ["AK","AL","AR","AS","CA","CO","DC","DE","FL","GA","GU","HI",
     "IA","ID","IL","IN","KS","KY","LA","MD","ME","MN","MO","MS","MT","NC","ND",
     "NE","NH","NM","NY","OH","OK","OR","PA","PR","RI","SC","SD","TN","TX","UT",
     "VA","VT","WA","WI","WV","WY"];
$('#state').on('blur',function(){
    
  if($.trim($(this).val()).length>0)
  {
     req(6);
     if($.inArray($(this).val().toUpperCase(),statearr)!== -1)
       remove($(this),1);
     else
       insert($(this),1);     
  }
  else
  {
     removerrornow(6);
     removevaliderror(1);
 }
      });
      
      //Email Validation- Starts with a letter.Must contain "@" and a "." after @
      $('#email').on('blur',function(){
         if($.trim($(this).val()).length>0)
         {
             req(14);
          
         if(($(this).val().indexOf("@")!== -1)&&($(this).val().match(/^[a-zA-Z]{1}/)))
           {
              var maillen = $(this).val().length;
              var start = $(this).val().indexOf("@");
              var s = $(this).val().substr(start,maillen);
              if(s.indexOf(".")!== -1)
              {
               remove($(this),7);
              }
              else{
                 insert($(this),7);
              }
           }
           else{
                  insert($(this),7);
              }
          }
          else
          {  
              removerrornow(14);
              removevaliderror(7);
          }
      });
      
      //City Validation - Checking if it contains only letters/spaces between letters
      $('#city').on('blur',function(){
         if($.trim($(this).val()).length>0){
             req(5);
             if ($(this).val().match(/^[a-zA-Z\s]+$/)){
                 remove($(this),8);
             }
             else{
                 insert($(this),8);
             }
         }
         else
         { 
             removerrornow(5);
            removevaliderror(8);
         }
     });
     
     //Checking if Program Selection is done - Checking if its not the default "Select One" option
     $('#psel').on('blur',function(){       
      if($(this).val()==='p0') 
       removerrornow(1); 
      else 
       req(1);
      
     });
     
     
     //Checking if Relationship Selection is done
    $("input:radio[name=relationship]").on('blur',function()
    {
          
      if($("input:radio[name='relationship']").is(":checked"))
      req(3);
  
      else 
     removerrornow(3);           
     });
     
     //Checking if Child's Gender Selection is done
    $("input:radio[name='Gender']").on('blur',function()
    {
          
      if($("input:radio[name='Gender']").is(":checked"))
      req(18);
  
      else 
      removerrornow(18);           
     });
     
     
     //Checking if all the required names are entered - Checking if non-empty
      var names=[fname,lname,cfname,clname,cname,ename];
      $(names).on('blur',function(){
     if($.trim($(this).val()).length>0)
     {
         
       if(this===fname) req(0);
       if(this===lname) req(2);
       if(this===cfname) req(15);
       if(this===clname) req(16);
       if(this===cname) req(17);
       if(this===ename) req(23);
      
     }
     else
     {
      if(this===fname) removerrornow(0);
      if(this===lname)removerrornow(2);
      if(this===cfname)removerrornow(15);
      if(this===clname)removerrornow(16);
      if(this===cname)removerrornow(17);
      if(this===ename) removerrornow(23);
     }
     });
     
     
     //Address Validation - Checking if non-empty
     $('#add1').on('blur',function(){
       if($.trim($(this).val()).length>0)
        req(4);
       else
        removerrornow(4);
     });
     
     
    
     
     //Focussing to the next input field
     
     $(".phone").on('keyup',function() {
    if ($(this).val().length === this.maxLength) {
     $(this).next().focus();
    }
       });
       
    $(".date").on('keyup',function() {
    if ($(this).val().length === this.maxLength) {
     $(this).next().focus();
    }
   });
   
  
  //Reset Button
 $('#reset').on('click',function(){
    location.reload();
 });

  //Submit Button  
$('#enroll').on('submit',function(){
   return checkonsubmit();
   
});



});



 





