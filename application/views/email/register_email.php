<?php 

  $where = array('customer_id'=>$ID);
	$register_data =  $this->model->hdm_get_where('tbl_register',$where);
  $plan_id     =  $register_data[0]->plan_id;
  $name = $register_data[0]->name;

  $where = array('id'=>$plan_id);
	 $plan_data =  $this->model->hdm_get_where('tbl_plan',$where);

   $forms = $plan_data[0]->forms;
	 $days = $plan_data[0]->days;
    $qc_cutoff =  $plan_data[0]->cutoff;
   $per_form =  $plan_data[0]->per_form;
   $fees =  $plan_data[0]->fees;
   $cancel_charge  = $plan_data[0]->cancel_charge;
    $cancel_charge1 = $plan_data[0]->cancel_charge1;

   $accu = (($forms * $qc_cutoff) /100);
    $accu1 = ($forms - $accu) ;



   $master_data = $this->model->hdm_get('tbl_master');

   $customer_care_no = $master_data[0]->care_no;
   $customer_care_no2 = $master_data[0]->care_no2;
   $care_eml = $master_data[0]->care_eml;
   $care_add = $master_data[0]->address;
   $company_name = $master_data[0]->name;


   $logo = base_url().$master_data[0]->logo;
   $seal = base_url().$master_data[0]->seal;

?>

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8" />

  <title><?php echo $company_name;?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>

<div>

  <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
  <img style="border: 0;-ms-interpolation-mode: bicubic;display: block;Margin-left: auto;Margin-right: auto;max-width: 152px" src="<?php echo $logo; ?>" alt="" width="152" height="108"></div>

    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Dear Freelancer, </p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">WELCOME TO <?php echo $name; ?>!!!! </p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">As per the discussion with our executive, you wish to join our platform of freelancing where you can make an extra earning by managing the resumes on our digital platform.
</p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">TASK DETAILS* 
    
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Weekly Entries -<?php echo $forms;?></p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Payout (INR) - Minimum 2- Maximum 40/- (Depending upon the accuracy)</p>

   <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> Project Duration - <?php echo $days; ?> Days  </p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">WEEKLY PAYMENT - <?php echo $fees; ?>-</p>


    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?php echo $qc_cutoff; ?>% accuracy is required for INR <?php echo $qc_cutoff; ?>- Payout per Resume. i.e <?php echo  $accu; ?> out of <?php echo $forms; ?> must have to typed accurately (without any mistake) 
     In case if you will not complete the work within given time frame, then you have to pay <?php echo $cancel_charge;?>/- (Portal Charges).
      As you know your first day is free and doesn't count in your project duration of <?php echo $days?> days, 
   If you require extension to complete the project do let us know as we will provide you extension on reasonable charge.

In order to start the work confirm your registration by digitally signing your e-agreement as
 Under the provisions of the Information Technology Act, 2000 particularly
  Section 10-A, an electronic contract is valid and enforceable. The only essential requirement in 
  India is e digital sign as your registration process will be completed.</p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">In order 
to start the work you must sign a contract in which all the terms and conditions are available regarding to the project. 
We hope our executive stated all the terms and cleared all your doubts. For you reference kindly go
     through the contract and sign it digitally through ID and Password credentials given below. </p>

     <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">We wish you best of luck for the project. 
Thanks</p>   
  
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> Your ID : <?php echo $ID;?>   </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> Your Password : <?php echo $password;?>   </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> You can login to your account with this link : <a href="<?php echo base_url().'customer-login';  ?>">  <?php echo base_url().'customer-login';  ?></a>   </p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Customer care no: <?php echo $customer_care_no;?>,<?php echo $customer_care_no2;?> </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Regards, </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?php echo $company_name;?> </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">CORPORATE OFFICE ADDRESS : <?php echo $care_add;?></p>

</div>

</body>

</html>