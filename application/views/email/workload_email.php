<?php 



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

  <title> <?php echo $company_name; ?></title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

</head>

<body>

<div>

  <div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">
 
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Dear Freelancer, </p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hi, </p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Congratulations for Joining <?php echo $company_name; ?>.</p>
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">As you know your agreement has been signed and now you are our registered freelancer. Your client Id & Password
     has been shared in the previous mail along with the website link. 
    You can now login and start your work. <strong>BEST OF LUCK!.</strong></p>
   
    <p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Click here to login
    <?php echo base_url().'customer-login';?> </p>
  
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> Your ID : <?php echo $ID;?>   </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> Your Password : <?php echo $password;?>   </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Customer Support (10:30 AM to 6:30 PM): <?php echo $customer_care_no; ?>,<?php echo $customer_care_no2; ?>.</p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">According to the Information technology Act 2000 (The Act) which came into force on 17-10- 2000. The Act applies to the whole 
of India and even to persons who commit offence outside India. The Act validates “DIGITAL SIGNATURE” and provides for enabling 
a person to use it just like the traditional signature. The basic purpose of digital signature is not different from our
 conventional signature. The purpose therefore is to authenticate the document, to identify the person and to make the
  contents of the document binding on person putting digital signature. Let us see what digital signature is in technical terms. 
  Digital signature raise the same liability as
 the regular one for the causes of criminal and civil matters. </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">So The Hon Supreme saying digital signature or digital signature scheme is a 
mathematical scheme for demonstrating the authenticity of a digital message or document. A valid digital signature gives a 
recipient reason to believe that the message was created by a known sender, and that it was not altered in transit. So this digital transition has them authentication 
as the regular one in the eye of law and you are abiding with the same.</p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Best Regards,, </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"><?php echo $company_name;?> </p>
<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">  <strong>Disclaimer:  </strong>  This email and any files transmitted with it are confidential and 
intended solely for the use of the individual or entity to which they are addressed. This message contains confidential information and is intended only for the individual named. 
If you are not the named addressee you should not disseminate, distribute or copy this e-mail. Please notify the sender immediately by e-mail if you have received this e-mail by mistake and delete this e-mail from your system. If you are not the intended recipient you are notified that disclosing, copying, distributing or
 taking any action in reliance on the contents of this information is strictly prohibited. </p>

</div>

</body>

</html>