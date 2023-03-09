<?php 

  $where = array('customer_id'=>$cid);
	$register_data =  $this->model->hdm_get_where('tbl_register',$where);
  $plan_id     =  $register_data[0]->plan_id;

  $where = array('id'=>$plan_id);
	 $plan_data =  $this->model->hdm_get_where('tbl_plan',$where);

   $forms = $plan_data[0]->forms;
	 $days = $plan_data[0]->days;

   $per_form =  $plan_data[0]->per_form;

   $cancel_charge = $plan_data[0]->cancel_charge;


   $accu = $forms * 90 /100;
   


   $master_data = $this->model->hdm_get('tbl_master');

   $customer_care_no = $master_data[0]->care_no;
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

  <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: unset"  id="emb-email-header">
  
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Dear Sir/Ma'am, </p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  
 This is notice under Clause (SCOPE OF WORK 2.2, 2.3), (SERVICE CHARGE) of the General Conditions of Contract that your company, as</p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">
 Contractor under the above Contract, has committed a substantial breach of the Contract by:
Under instruction and on behalf of our client (<?php echo $company_name;?>),<?php echo $care_add;?>.</p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  We do hereby serve upon you with the following notice under section 72, 73, 74 INDIAN CONTRACT ACT 1872. </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> 
<?php echo $customer_endate;?> </p>


<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> 
<?php echo $name;?>   </p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> 
<?php echo $cid;?>   </p>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> 
<?php echo $address;?>   </p>


<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  We are advising you to pay the charges of the portal which you have used intentionally and failed to deliver the output which was required in the contract and was duly comitted by you, upon which only the work was allocated to you on the basis of trust. </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  Therefore we can proceed legally as per the sec 72 under Indian contract act 1872, Kindly clear the dues towards our clients by contacting the company and resolve this concern at the earliest to avoid the file of a law suit against you. Now, as per the terms and conditions mentioned in the legal agreement you are supposed to pay the charges of Rs <?php echo $cancel_charge;?> applicable as soon as possible. </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> This will be a final call to resolve the issue without the expense of court proceedings. If you fail to clear the matter then the company may take legal actions against you.  </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> We shall be serving you the legal notice to your postal address against which you have to revert legally by hiring a suitable lawyer. And we do have your Aadhar card & Pan Card details with us so,  your CIBIL ratings may get deteriorated as well in course of non-submission of your penalty amount.  </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  You can find lots of issues with your banking procedures also then. </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  Regards, </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> Legal Department
 </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  <?php echo $company_name; ?>   </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  +91 <?php echo $mobile_no; ?>   </p>

</div>

</body>

</html>