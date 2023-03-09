

<?php $this->load->view('frontent/template/header');?>
<!-- @include('frontent/template.header') -->

<?php 

$master_data = $this->model->hdm_get('tbl_master');

   $customer_care_no = $master_data[0]->care_no;
   $care_eml = $master_data[0]->care_eml;
   $care_add = $master_data[0]->address;
   $company_name = $master_data[0]->name;


   $logo = base_url().$master_data[0]->logo;
   $seal = base_url().$master_data[0]->seal;

?>

<body>

<input type="hidden" value="<?php echo $this->session->userdata('customer_sess')['is_agreement'];?>"   id="is_agreement">
<input type="hidden" value="<?php echo base_url();?>"   id="base_url">


    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-bar"></div>
    </div>
    <!-- [ Pre-loader ] end -->
    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">
            <!-- [ Header ] start -->
            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">
                    <div class="navbar-logo">
                        <a href="index.html">
                            <img class="img-fluid" src="<?=  $logo;?>"   width="50px"  alt="Theme-Logo">
                            
                        </a>
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="feather icon-menu icon-toggle-right"></i>
                        </a>
                        <a class="mobile-options waves-effect waves-light">
                            <i class="feather icon-more-horizontal"></i>
                        </a>
                    </div>
                    <div class="navbar-container container-fluid">
                       
                        <ul class="nav-right">

                                    <li class="dropdown">
                                        <a href="<?=base_url('customer_sess');?>#" data-toggle="dropdown"

                                        class="nav-link dropdown-toggle nav-link-lg nav-link-user">

                                        <img class="img-radius" src="<?=  $logo;?>" alt=""  style="width:50px"  > 
                                        <span class="d-sm-none d-lg-inline-block"><?php echo $this->session->userdata('customer_sess')['name'];?></span>
                                    </a>

                                       <div class="dropdown-menu dropdown-menu-right pullDown">

                                            <!-- <div class="dropdown-title">Hello <?php echo $this->session->userdata('customer_sess')['name'];?></div> -->

                                            <div class="dropdown-divider"></div>

                                                        <a href="<?=base_url('customer-logout');?>" class="dropdown-item has-icon text-danger"> <i class="fas fa-sign-out-alt"></i>

                                                        Logout

                                                        </a>

                                                        </div>

                                    </li>

                                    </ul>
                      
                    </div>
                </div>
            </nav>
          

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <!-- [ navigation menu ] start -->
                  <!-- @include('frontent.template.sidebar') -->
                  
<?php $this->load->view('frontent/template/sidebar');?>
                    <!-- [ navigation menu ] end -->
                    <div class="pcoded-content">
                      <!-- @include('frontent.'.$middle_content) -->
                      
<?php $this->load->view($middle_content);?>


                    </div>
                    <!-- [ style Customizer ] start -->
                    <div id="styleSelector">
                    </div>
                    <!-- [ style Customizer ] end -->
                </div>
            </div>
        </div>
    </div>


    

 
<?php $this->load->view('frontent/template/footer');?>
     
<script>
$(document).ready(function() {
    // $('#signatureArea').signaturePad({ bgColour : '#000',drawOnly:true, drawBezierCurves:true, lineTop:90});
    $('#signatureArea').signaturePad({ bgColour : 'transparent',drawOnly:true, drawBezierCurves:true, lineTop:90});
    
    // $('#signatureArea').signaturePad({drawOnly:true, drawBezierCurves:true, lineTop:90});
});



$('#btnclear').on('click', function(){

    $('#signatureArea').signaturePad().clearCanvas();

    // var canvas = document.getElementById("signaturePad");
    // var signaturePad = new SignaturePad(canvas);


    //     signaturePad.clear();
    });

//$.ajaxSetup({ error: logAjaxError });


$("#btnSaveSignature").click(function(e){

    var base_url = $("#base_url").val();

    html2canvas([document.getElementById('signaturePad')], {
        onrendered: function (canvas) {
            var canvas_img_data = canvas.toDataURL('image/png');
            var img_data = canvas_img_data.replace(/^data:image\/(png|jpg);base64,/, "");
            //console.log(img_data);
            document.getElementById("canvasImage").src="data:image/gif;base64,"+img_data;
            $.ajax({
                url:base_url+'/save_signature',
                method: 'post',
                data: {img_data:img_data},
                dataType: 'json',
                success: function(response){
                        console.log(response);
                        var msg='we will contact to you soon';
                        logoutuses(msg);

                }
            });



        }
    });

  

});


function logoutuses(msg){

    var base_url = $("#base_url").val();
    $.ajax({
                url:base_url+'/logoutusers',
                method: 'post',
                dataType: 'json',
                success: function(response){
                        console.log(response);
                        if(response.status='1'){
                            alert(msg);
                             window.location = base_url+'customer-login';

                        }
                }
            });

}




$(document).ready( function () {
    $('#simpletable').DataTable();
    $('#simpletable2').DataTable();
} );


function check_pendingrequestexit(value){
     
    var base_url = $("#base_url").val();
    var query_id = $("#query_id").val();
        $.ajax({
                url:base_url+'/check_pendingrequestexit',
                method: 'post',
                dataType: 'json',
                data:{id:value,query_id:query_id},
                success: function(response){
                        console.log(response);
                        if(response.status =='1'  || response.status=='2' ){
                            console.log('1');
                            alert(response.msg);
                             $(':input[type="submit"]').prop('disabled', true);
                          }
                          
                           else {
                            console.log('2');
                            $(':input[type="submit"]').prop('disabled', false);
                          }
                          
                }
            });
    }





$("#resume_form").validate({
    rules: {
        mis: {required:true},
        first_name: {required:true},
        last_name: {required:true},
        contact_no: {required:true},
        alternate_no: {required:true},
        email: {required:true},
        company_name: {required:true},
        website_url: {required:true},
        address: {required:true},
        city: {required:true},
        state: {required:true},
        zip: {required:true},
        sic_desc: {required:true},
        sic_code: {required:true},
        entity_type: {required:true},
        company_sale: {required:true},
        revenue: {required:true},
        country: {required:true},
        medical_ins: {required:true}
  },
  submitHandler: function(form) {
    //save_resume();
    
    if($("#type").val() =='1'){
        save_resume();
    } else if($("#type").val() =='2'){
        save_for_query(); 
    }
    else if($("#type").val() =='4'){
        update_resume();
    } else {
       // update_resume();
    }
  },
});
  
  

function save_resume1(){
    $("#type").val(1);
    
}  

function save_for_query2(){
    $("#type").val(2);
    
}

function save_resume3(){
    $("#type").val(4);
    
}




$(document).ready(function(){
   $('.form-control').on("cut copy paste",function(e) {
      e.preventDefault();
   });
});


</script> 



</body>

</html>
