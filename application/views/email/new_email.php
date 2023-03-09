<?php 



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

  <title> <?php echo $company_name; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>

<div>

  <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
  </div>

<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hey Dear, </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> PFA No objection certificate. </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  Regards, </p>

</div>

</body>

</html>