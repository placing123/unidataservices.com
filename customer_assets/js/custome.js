$("#editnow").hide();
$("#updateresume").hide();
function get_forms(){

  var form_id = $("#resume_id").val();
  var base_url = $("#base_url").val();

  $("#resume_section").show();
  //  http://sparesengineer.com/perfectjob/customer_assets/resumepdf/demo.pdf
     var imgurl = base_url+'uploads/resumes/';
   
  $.ajax({
     url:base_url+'/get_forms',
     method: 'post',
     data: {form_id:form_id},
     dataType: 'json',
     success: function(response){

      var pdfurl = imgurl+response.data.resume_id+'.pdf';
       console.log(pdfurl);
       $("#resumepdf").attr("src", pdfurl);



      $('.form-control').attr('readonly', false);
       console.log(response.data);
       $("#mis").val(response.data.mis);
       $("#first_name").val(response.data.first_name);
       $("#last_name").val(response.data.last_name);
       $("#contact_no").val(response.data.contact_no);
       $("#alternate_no").val(response.data.alternate_no);
       $("#email").val(response.data.email);
       $("#company_name").val(response.data.company_name);
       $("#website_url").val(response.data.website_url);
       $("#address").val(response.data.address);
       $("#city").val(response.data.city);
       $("#state").val(response.data.state);
       $("#zip").val(response.data.zip);
       $("#sic_desc").val(response.data.sic_desc);
       $("#sic_code").val(response.data.sic_code);
       $("#entity_type").val(response.data.entity_type);
       $("#company_sale").val(response.data.company_sale);
       $("#revenue").val(response.data.revenue);
       $("#country").val(response.data.country);
       $("#medical_ins").val(response.data.medical_ins);
       if(response.data.status=='0'){
        //console.log('notsubmited');
        $('.form-control').attr('readonly', false);
        $("#editnow").hide();
        //$("#save_for_query").hide();
        $("#save_for_query").prop('disabled', true);

       } else if(response.data.status=='1'  || response.data.status=='2' ){
        console.log('submitedmakereadonly');
        $('.form-control').attr('readonly', true);
        $("#editnow").show();
        $("#save_for_query").prop('disabled', false);

        } else {

        console.log('update form');
       }
       
    
     }
  });


}


function edit_resumeform(){
  $('.form-control').prop('readonly', false);
  $("#updateresume").show();
  $('#submitbtn').hide();
  $('#editnow').hide();
  
 // $('#submitbtn').prop('disabled', true);

}

function saveforquery(){
  var base_url = $("#base_url").val();
  var form_id = $("#resume_id").val();
  $.ajax({
     url:base_url+'/saveforquery',
     method: 'post',
     data: {form_id:form_id},
     dataType: 'json',
     success: function(response){
      // 
      if(response.status=='1'){
        alert(response.msg);
        location.reload();

      }
      
     }
  });
}




function save_resume(){
  var base_url = $("#base_url").val();
  var resume_id = $("#resume_id").val();
  var formData = $('#resume_form').serialize();
  $.ajax({
     url:base_url+'/store_form',
     method: 'post',
     data: formData,
     dataType: 'json',
     success: function(response){
      
        if(response.status=='1'){
            alert(response.msg);
            location.reload();    
    
          }
     }
  });

}


function save_for_query(){

  var base_url = $("#base_url").val();
  var resume_id = $("#resume_id").val();
  var formData = $('#resume_form').serialize();

$.ajax({
   url:base_url+'/save_for_query',
   method:'post',
   data:formData,
   dataType:'json',
   success: function(response){
    if(response.status=='1'){
        alert(response.msg);
         location.reload();

      }
   }
});

}
function update_resume(){
    var base_url = $("#base_url").val();
    var resume_id = $("#resume_id").val();
    var formData = $('#resume_form').serialize();
  
    $.ajax({
       url:base_url+'/update_resume',
       method: 'post',
       data: formData,
       dataType: 'json',
       success: function(response){
          if(response.status=='1'){
              alert(response.msg);
              location.reload();
            }
       }
    });
  
  }




  function submit_task(){
   
   var base_url = $("#base_url").val();
   swal({
      title: "Are you sure?",
      text: "Once submit, you will not be able to fill the form!",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
     

               $.ajax({
                  url:base_url+'/submit_task',
                  method: 'post',
                  dataType: 'json',
                  success: function(response){
                     if(response.status=='1'){
                           swal("THE ULTIMATE TEAM WILL CONTACT TO YOU SOON", {
                            icon: "success",
                          });
                        location.reload();
                     }
                  }
               });
      } else {
        swal("You  have cancel process");
      }
    });
 
 }





 // A $( document ).ready() block.
$( document ).ready(function() {
   
   var approve_base_url = $("#base_url").val() + 'approval_waiting';

   var currentUrl= window.location.href;
   if(approve_base_url ==currentUrl){
      console.log('match');
      // timer();


   }
   //check approve page url 
});




// let timerOn = true;

// function timer(remaining) {
//   var m = Math.floor(remaining / 60);
//   var s = remaining % 60;
  
//   m = m < 10 ? '0' + m : m;
//   s = s < 10 ? '0' + s : s;
//   document.getElementById('timer').innerHTML = m + ':' + s;
//   console.log(m + ':' + s);
//   remaining -= 1;
  
//   if(remaining >= 0 && timerOn) {
//     setTimeout(function() {
//         timer(remaining);
//     }, 1000);
//     return;
//   }

//   if(!timerOn) {
//     // Do validate stuff here
//     return;
//   }

//   if(s ==0){
//    var msg='we will contact to you soon.wait for approval'
//    logoutuses(msg);
//   }
//   // Do timeout stuff here
// //   
// }

// timer(10);