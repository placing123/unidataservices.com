<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
<style>
.button {
  background-color: #f58220;
  color:black;
  border: none;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 35px;
  margin: 4px 2px;
  cursor: pointer;
  width:100%;
  font-weight: bold;
}
footer { 
    position: absolute; 
    bottom: 20px; 
    /*left: 0px; */
    /*right: 0px; */
    /*background-color: lightblue; */
    height: 50px;
    width:100%;
    text-align: center;
}
</style>

</head>
<body>

<?php 



$master_data = $this->model->hdm_get('tbl_master');

  
   $company_name = $master_data[0]->name;

?>
<table align="center" width="100%" style="line-height: 1.9; font-size:20px;">

     
<tr> <td  align="center"  >    <strong>NOC  </strong>  </td> </tr>  

<tr> <td> Dear  <?php echo $name; ?> </td> </tr>
<tr> <td>   This is no objection from <?php echo $company_name; ?> regarding the project provided by company, as per the</td> </tr>  
<tr> <td>   Agreement clauses you were liable to pay the penalty amount
</td> </tr>  
<tr> <td>   The company has received penalty amount of Rs <?php echo $amount; ?>/-and hence your company case has
been closed and no further action from <?php echo $company_name; ?> would be taken against you.
 
</td> </tr>  
<!-- 
<tr> <td>   <img src="'.base_url('admin_assets/img/banner/logo.png').'" style="width:25;" /></td> </tr>  
<tr> <td>   <img src="'.base_url('admin_assets/img/banner/logo.png').'" style="width:25;" /></td> </tr>   -->

<tr> <td>  DATE: <?php  echo date('d-m-Y')?>
</td></tr>
 

<tr> <td>Thanks and Regards,
</td> </tr>



   


</table>



</body>
</html>