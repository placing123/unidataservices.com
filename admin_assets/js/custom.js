

function delete_records(table_name,id,pid){
  
var base_url = $("#base_url").val(); 
  swal({
    title: "Are you sure?",
    text: "You want to Delete record!",
    icon: "warning",
    buttons: true,
    dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      $.ajax({
          url:base_url+'/delete_records',
          method: 'post',
          data: {table_name:table_name,id:id,pid:pid},
          dataType: 'json',
          beforeSend: function(){
            $(".loader").show();
          },
          complete: function(){
            $(".loader").hide();
          },
          success: function(response){
            if(response.status =='1'){
              swal("Records delete  Successfully", {
              icon: "success",
             });

             location.reload();
             
            } else {
                swal("Can't delete ! Don't have permission", {
                    icon: "warning",
                   });

            }
         
        }
  });
     } else {
      swal("Your have cancel process");
    }
  });
}




function remider_mail_send(){
var base_url = $("#base_url").val(); 
  var ids = [];
    $.each($('#customer_id').val().split(/\n/), function(i, id){
        if(id){
            ids.push(id);
        } else {
           // lines.push("");
        }
    });
    console.log(ids);
    $.ajax({
        url:base_url+'/remider_mail_send',
        method: 'post',
        data: {ids:ids},
        dataType: 'json',
        success: function(response){
          if(response.status ==1){
            swal("Mail Send  Successfully", {
            icon: "success",
           });
           location.reload();
          } 
      }
    
  });

}




function resend_mail_send() {

  var base_url = $("#base_url").val(); 
  var ids = [];
    $.each($('#customer_id').val().split(/\n/), function(i, id){
        if(id){
            ids.push(id);
        } else {
           // lines.push("");
        }
    });
    console.log(ids);
    $.ajax({
        url:base_url+'/resend_mail_send',
        method: 'post',
        data: {ids:ids},
        dataType: 'json',
        success: function(response){
          if(response.status ==1){
            swal("Mail Send  Successfully", {
            icon: "success",
           });
           location.reload();
          } 
      }
    
  });
 
}



function warning_mail_send(){
  var base_url = $("#base_url").val(); 
  var phone = $("#mobile_no").val(); 

  
    var ids = [];
      $.each($('#customer_id').val().split(/\n/), function(i, id){
          if(id){
              ids.push(id);
          } else {
             // lines.push("");
          }
      });
      console.log(ids);
  
      $.ajax({
          url:base_url+'/warning_mail_send',
          method: 'post',
          data: {ids:ids,phone:phone},
          dataType: 'json',
          success: function(response){
              if(response.status ==1){
                swal("Mail Send  Successfully", {
                icon: "success",
              });

              location.reload();
              } 
        }
      
    });
  
  }
  


  function check_permission(){
    
    var base_url = $("#base_url").val(); 
    var role_id = $("#role_id").val();
    $.ajax({
      url:base_url+'/check_permission_records',
      method: 'post',
      data: {role_id:role_id},
      dataType: 'json',
      success: function(response){
        console.log(response);
        if(response.status==1){
					
				
					$.each(response.data, function(key, value) {

						$("#add").prop('checked', true);
						$("#edit").prop('checked', true);
						$("#remove").prop('checked', true);
						$("#view").prop('checked', true);
				   
					
						$("input[name=add_"+value.permission_id+"][value=" + value.add_per + "]").attr('checked', 'checked');
						$("input[name=edit_"+value.permission_id+"][value=" + value.edit_per + "]").attr('checked', 'checked');
						$("input[name=remove_"+value.permission_id+"][value=" + value.remove_per + "]").attr('checked', 'checked');
						$("input[name=view_"+value.permission_id+"][value=" + value.view_per + "]").attr('checked', 'checked');
					});

				} else {
				  	$("#add").prop('checked', false);
						$("#edit").prop('checked', false);
						$("#remove").prop('checked', false);
						$("#view").prop('checked', false);
				}
				
      } 
   
  });


  }