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

td{
     text-align: justify;
}
</style>

</head>
<body>


<?php 




	$where = array('id'=>$plan_id);
    $plan_data =  $this->model->hdm_get_where('tbl_plan',$where);
   $forms = $plan_data[0]->forms;
   $days = $plan_data[0]->days;
   $per_form =  $plan_data[0]->per_form;
   $qc_cutoff =  $plan_data[0]->cutoff;
   $cancel_charge =  $plan_data[0]->cancel_charge;
   $cancel_charge1 = $plan_data[0]->cancel_charge1;
   $mul_login_chrg = $plan_data[0]->mul_login_chrg;
   $first_part = $plan_data[0]->first_part;
   $not_submit_chrg = $plan_data[0]->not_submit_chrg;
   
   $accu = (($forms * $qc_cutoff) /100);
    $accu1 = ($forms - $accu) ;


$master_data = $this->model->hdm_get('tbl_master');
$customer_care_no = $master_data[0]->care_no;
$customer_care_no2 = $master_data[0]->care_no2;
   $care_eml = $master_data[0]->care_eml;
   $care_add = $master_data[0]->address;
   $company_name = $master_data[0]->name;
    $state= $master_data[0]->state;

   $logo = $master_data[0]->logo;
   $seal = $master_data[0]->seal;
   $company_sign = $master_data[0]->company_sign;
   $agreement_img = $master_data[0]->agreement_img;

?>


<table align="center" width="100%" style="line-height: 1.9; font-size:20px;">

<tr>

<td>  
    <?= '<div align="center"><img src="'.base_url().$agreement_img.'" style="width:700px; height:950px " ></div>' ?>
</td>
</tr>
    
<tr> <td    style="color:blue;text-align:center;text-decoration: underline;"    >    <strong> FREELANCE AGREEMENT  </strong>  </td> </tr>  
<tr> <td    style="color:blue;text-align:center;text-decoration: underline;"   >    <strong> BETWEEN   </strong>  </td> </tr>  
<tr> <td   style="color:blue ;text-align:center;text-decoration: underline; "   >    <strong> <?php echo $company_name;?>  </strong>  </td> </tr>  
<tr> <td   style="color:blue ;text-align:center;text-decoration: underline; "  >    <strong> AND </strong>  </td> </tr>  
<tr> <td   style="color:blue;text-align:center;text-decoration: underline;"  >    <strong> APPLICANT/FREELANCER.  </strong>  </td> </tr>  
<tr> <td    style="color:blue ;text-align:center;text-decoration: underline;"  >    <strong> DURATION:  </strong>  </td> </tr>  

<tr> <td  >  That the Employment period shall be for ONE MONTH after which this contract
is subject to renewal or as the Company may otherwise determine.
</td>  </tr>

<tr> <td    >    <strong> GENERAL CONDITIONS:  </strong>  </td> </tr>  
<tr> <td>You (Party of the Second Part) shall be subject to such general conditions of
service and regulations as will be determined by the Management of the firm.
You also agreed by digitally accepting this employment contract , by digitally signing on the agreement on link sent to you on your email id { <?php echo $company_name;?> }, that you will be bound
by and adhere to the Company’s Rules and Regulations Book and code of
conduct (as the same may be renewed by management from time to time.) </td> </tr>
<tr> <td> PROJECT DURATION (<span class="dynamic">  (<?php echo $days; ?> DAYS ) </span></td> </tr>
<tr> <td> Sequel to your successful communication with us, we are pleased to offer you
the job of {FREELANCER DATA ENTRY} with { <?php echo $company_name;?> } with effect from  <?php  $year = date('Y'); ?>
{<?php echo $year;?>-<?php echo $year + 1;?>} under the following terms and conditions</td> </tr>

<!-- <tr> <td>   = '<div align="center"><img src="'.base_url().$logo.'" style="width:200px;" /></div>' ?> </td> </tr> -->
<tr> <td> JOB CONTRACT FOR FREELANCING EMPLOYEMENT </td> </tr>
<tr> <td> This Agreement executed  <span class="dynamic"> <?php echo $reg_date; ?> </span> between  <strong><?php echo $company_name; ?></strong> Having its
Register Office at - <?php echo $care_add; ?> </td> </tr>
<tr><td>  (Herein after referred to as â€˜the Party <span class="dynamic"> <?php  echo $name?>, </span>"<?php  echo $address;?>,
 herein after referred to as â€˜the Party of the Second Part) .  </td></tr>


<tr> <td> <strong> WHEREAS </strong> the Party of the First Part is engaged mainly in Outsourcing of IT enabled Services and
To deliver Data Entry and Transcription and allied Activities and Other Ancillary Activities Associated
there with an Organization engaged in providing data to you end clients and data entry related line of
work. And executing such work Outsourced, through Delivery Partners</td> </tr>
<tr> <td><strong> AND WHEREAS </strong>    the Party of the First Part is bound by time schedule set by the Delivery Partners
and that its reputation is built upon speedy and accurate transcription and requires the said party to
deliver accomplished work within shortest span and with desired accuracy the First Party has
entered with a firm launching its new BANKING PORTAL and has represented itself that it has an
expertise in the area of providing MARKETING (Banking)/ Presently it is in a position to procure the
business for RESUME FILLING more meaningfully described in the column Scope of Work, through
their principals.AND WHEREAS the Business Associate is engaged inter alias, in the business of
providing a wide Spectrum of software solutions & services. The Business Associate has acquired
the necessary expertise and developed the requisite skill base and Infrastructure for successful
execution of RESUME FILLING Projects</td> </tr>
<tr> <td>Whereas, the Second Party is an individual and a Freelancer who is willing to provide its services to
the Job Portal Company, via medium of First Party in relation with IT & all data related work which is
to be provided by the First Party </td> </tr>
<tr> <td>This Agreement represents the business Agreement and operational understandings between the
parties and shall remain in effect for a period of <span class="dynamic">  (<?php echo $days; ?> DAYS ) </span>
 from the date of execution hereof or from the date of providing the first data whichever is later & can be extended for the period as mutually
agreed upon, for the purpose </td> </tr>
   

<!-- <tr> <td>  //'<div align="center"><img src="'.base_url().$logo.'" style="width:200px;" /></div>' ?> </td> </tr> -->

<tr> <td align="center"  > <strong>NOW THIS AGREEMENT WITNESSETH AS FOLLOWS:</strong></td> </tr>
<tr> <td>It is hereby agreed between the Parties as under: </td> </tr>
<tr> <td>1.1 That both the Parties has decided with sweet will and free consent to work together for gains. </td> </tr>
<tr> <td>1.2 The purpose of Parties behind this Agreement is to work for gain in relation to the Freelance
services.
 </td> </tr>
 <tr> <td> 1.3. That the First Party is Ruling out on survey for banking purpose digitally/non digitally /Free
Lancers and is focused to provide its services to the Partners/Associates (M/s <?php echo $company_name;?>.):
</td> </tr>
<tr> <td> <strong> 2. Scope of Work:</strong> The original data will be available on the work environment software provided by
<span class="dynamic"> 
<?php echo $company_name;?> </span> at the time of signup. Business associate are required to feed the provided data in the
provided software as per the guidelines. Data supply and preservation of the output file is done online
on real time basis. the party of the first part is collecting data for banking formalities of our end clients
for that they are ruling out on survey for the data by typing in companyâ€™s portal the employee of
the <span class="dynamic"> 
<?php echo $company_name;?> </span> AND SERVICES are also working on this project those person are qualified in their
work and fulfill the company requirement the company will pay for them according to terms &
condition.
 </td> </tr>
<tr> <td> The data surveying duration will be for one year from <span class="dynamic">   <?php  $year = date('Y'); ?>
{<?php echo $year;?> to <?php echo $year + 1;?>  </span>    </td> </tr>
<tr> <td> 2.1 The First Party shall provide details of the FORMS through the login credentials shared through
SMS Or Email.
</td> </tr>

<tr><td> 2.2 The Second Party further Represents to the First Party, the time for the Completion of the said
data entry related services as mentioned in this Agreement, shall Commence Immediately upon
logging on the portal OR if the Commencement Date is mentioned in the said Communication, from
such date, and it shall Continue to Access its said Portal/E-Mail as provided in the Records of the
First Party, as frequently as necessary for the said Purpose..</td> </tr>

<tr> <td>  <strong> the Second Party agrees to pay Rs.  <span class="dynamic"><?php echo $cancel_charge; ?></span> as charges for membership, Portal charges,
and other applicable charges in case of failure to submit complete workload or to provide
workload on time with desired accuracy. This membership will include Jobs Vacancy
information in Pan India through our Social Media platform </strong> </td> </tr>



<tr>
            <td>2.4 That the First Party will give <span class="dynamic"><?php echo $forms; ?> forms in PDF or any other image format on the Companyâ€™s
                Portal. On the Portal itself, the details of the work of data processing are provided, which will clearly
                mention the details, as in what & how is to be processed.
            </td>
        </tr>
<tr><td>a) Payment to be made maximum within <span class="dynamic"><?php echo $days;?>   DAYS </span> days of each calendar month, from the QC report,
which will be given usually within <span class="dynamic"><?php echo $days;?>     DAYS </span> of submission of the work.</td></tr>
<tr><td>b) That the First party gets all these FORMS from  <span class="dynamic">   <?php echo $company_name;?> </span>(END CLIENTS).
</td></tr>


<tr><td>c) In case of any dispute second party must contact to the first party and if they are unable to
resolve their problem, they can proceed legally. Second party can communicate through
<?php echo $care_eml;?> or on customer care numbers provided.</td></tr>

<tr><td> <strong> 3. Plan Details: </strong>   Second party will get    <span class="dynamic">   <?php echo $forms;?> </span>     forms for <span class="dynamic">   <?php echo $days;?> </span> DAYS. Agreement duration shall be for 1
month, Within which must complete 3 projects/slots. Per form rate will be Rs. <span class="dynamic">   <?php echo $per_form;?> </span> /-.(a). No initial
payment is required to be given by second party.(b). After getting the accuracy report of having 90%
above accuracy, your payment will be processed within 6 international working days in to your
respective bank account. An accurate form is that which doesn't have any error such as
spelling/punctuation/extra space/extra text/missing text.(c). In the matter of failure, non-submission,
accuracy below 90% then company is entitled to receive amount of Rs.<span class="dynamic">   <?php echo $cancel_charge;?> </span>* by any cost from the
second party. If in case second party uses multiple login then penalty will be Rs. <span class="dynamic">   <?php echo $mul_login_chrg;?>  </span>/-. If second
party passes and achieves the accuracy of 90% or above, then amount will be deducted from his
work payment and remaining shall be paid.(d). The charge of Rs.<span class="dynamic">   <?php echo $cancel_charge;?>  </span> is related to service,
development and maintenance cost of the platform where he is working online.
</td></tr>


<tr><td><strong>Technical clause: </strong> </td></tr>
<tr><td>â€¢ Helpline department will support you in only 10% queries from the whole project.
â€¢ For example: if you have taken the <span class="dynamic">   <?php echo $forms;?> </span> pages/forms plan, then helpline dept. is liable to give
reply only <?php echo  $accu1;?>  pages/forms queries of 10% of whole project. â€¢
â€¢ No use of any shortcut keys while typing in terminal else you will be responsible for the same.</td></tr>
<tr>
    <td><strong>4. TIMEFRAME FOR COMPLETION OF TRANSCRIPTION:  </strong>The Second Party shall complete the
services of the said Data entry work in Six (6) days TAT period, i.e., maximum  <span class="dynamic">   <?php echo $forms;?> </span>    forms can be
completed within a period of <span class="dynamic">   <?php echo $days;?> </span> DAYS. The Second Party alone shall be responsible for the
maintenance of Hardware and Personnel for such timely services and no excuse of whatsoever
Nature shall be entertained for delay in Supply of services, since Time is the Essence of this 
Contract. The party of the <strong>SECOND PART</strong>  may request upon paid extension from the party of the
<strong>FIRST PART</strong>
 @ of Rs. <span class="dynamic">   <?php echo $first_part;?> </span> for every 24 hrs extension. 
</td>
</tr>   
<tr><td><strong>5. DURATION OF THE CONTRACT:  </strong>  The Present Contract shall be in force for 1 month
membership. (Within which must complete 3 projects/slots). The said Contract shall come to an
End at the Expiry of the said Period and may be renewed by Mutual Consent and on such
Revised Terms agreed between the Parties and on Payment of Processing Charges for another
Project by the Second Party.
</td></tr>
<tr><td> <strong>ID Allocation:  </strong>:Business Associate will get single id to work on and Business Associate can work
24X7 on this id. </td></tr>
<tr><td><strong>TAT (Turn Around Time):</strong> Turn around time for completing the project is mentioned in the
schedule. The Business Associate through this agreement guarantees the delivery of work within
stipulated timeframe with desired accuracy.
</td></tr>
<tr><td><strong>   SERVICE CHARGE:  </strong>  If Business Associate fails to fulfill terms and conditions mentioned by Client,
then Business Associate have to compulsory pay penalty amount of Rs.  <?php echo $cancel_charge;?>  * to stop legal
proceedings within 12 hours. In the matter of fact failure, not submitted the Client is entitled to receive
penalty amount of Rs.<span class="dynamic">   <?php echo $not_submit_chrg;?>  . If Business Associate achieves accuracy then Business Associate will
not be liable to pay the penalty amount. If Business Associate fails in achieving accuracy, then
Business Associate has to pay the penalty according to the selected plan as a liability.
</td></tr>


<tr><td><strong>  WHY SERVICE CHARGES?  </strong> </td></tr>
<tr><td>- We offer 24*7 helpline options on website.</td></tr>
<tr><td>- We offer day time customer care call support.</td></tr>
<tr><td>- Email support</td></tr>
<tr><td>-Job consultation charges.</td></tr>
<tr><td><strong>- Charges will be deducted from the payment once accuracy is achieved.
</strong></td></tr>
<tr><td> <strong> 7. PROCEDURE FOR GENERATION OF ACCURACY REPORT : </strong> The Determining Centre
personnel shall check all the data processing of FORMS. After an error is found in a particular
FORM the Centre personnel shall list that as inaccurate and start checking the next FORM. All the
errors in the whole FORM will not be shown in the Accuracy Report. Once all data processing of
FORM are checked, the final Accuracy Report shall be generated  </td></tr>
<tr><td>  <strong>Entire Agreement:</strong>  This Agreement constitutes the entire agreement between the Parties hereto
with respect the subject matter hereof, and supersedes all prior negotiations, understandings and
agreements of the Parties: In case of any party wants to terminate the agreement before the
completion of the said tenure, in that case, the party who suggests the same has to pay the other party a 
said cancellation charge of Rs.<span class="dynamic"> <?php echo $cancel_charge1;?> </span>. within the duration of 24hrs of request upon
cancellation. </td></tr>
<tr><td> <strong> Independent Contractor Representation and Warranties:  </strong> Independent Contractor represents
and warrants that it has all the necessary licenses, permits and registrations, if any, required to
perform the Services under this Agreement in accordance with applicable federal, state and local
laws, rules and regulations and that it will perform the Services according to the Clientâ€™s
guidelines and specifications and with the standard of care prevailing in the industry.
</td></tr>
<tr><td> <strong>9.Governing Law:</strong> Law: The terms of this Agreement and the rights of the Parties hereto shall be
governed exclusively by the laws of the State of <?php echo $state;?> without regarding its conflicts of law
provisions.
</td></tr>
<tr><td> <strong>9.1. Disputes:</strong> Any dispute arising from this Agreement shall be resolved through:</td></tr>
<tr><td>Court litigation: The dispute shall be resolved in the courts of the State of <?php echo $state;?> Attorneysâ€™ If
either Party brings legal action to enforce its rights under this Agreement, the prevailing party will be
entitled to recover from the other Party its expenses (including reasonable attorneys' cancel_charge and costs)
incurred in connection with the action and any appeal.</td></tr>
<tr><td>Arbitration. The dispute shall be resolved through binding arbitration conducted in accordance with
the rules of the <?php echo $state;?> Arbitration Association.</td></tr>
<tr><td>The dispute shall be resolved through mediation.</td></tr>
<tr><td>The dispute shall be resolved through mediation. If the dispute cannot be resolved through mediation,
then the dispute will be resolved through binding arbitration conducted in accordance with the rules of
the <?php echo $state;?> Arbitration Association.
</td></tr>

<tr><td> <strong>10. Amendments </strong> :No supplement, modification or amendment of this Agreement will be binding
unless executed in writing by both of the Parties.  </td></tr>
<tr><td> <strong>10.1. Notices </strong>  :Any notice or other communication given or made to either Party under this
Agreement shall be in writing and delivered by hand, sent by overnight courier service or sent by
certified or registered mail, return receipt requested, to the address stated above or to another address as that Party may subsequently designate by notice, and shall be deemed given on the date
of delivery. </td></tr>
<tr><td> <strong>11. Waiver: </strong> : Neither Party shall be deemed to have waived any provision of this Agreement nor the
exercise of any rights held under this Agreement unless such waiver is made expressly and in
writing. Waiver by either Party of a breach or violation of any provision of this Agreement shall not
constitute a waiver of any subsequent or other breach or violation.  </td></tr>
<tr><td> <strong>10. Amendments </strong> 12.Further Assurances: At the request of one Party, the other Party shall execute and deliver such
other documents and take such other actions as may be reasonably necessary to effect the terms of
this Agreement.  </td></tr>
<tr><td> <strong>10. Amendments </strong> 13. Severability: If any provision of this Agreement is held to be invalid, illegal or unenforceable in
whole or in part, the remaining provisions shall not be affected and shall continue to be valid, legal
and enforceable as though the invalid, illegal or unenforceable parts had not been included in this
Agreement. IN WITNESS WHEREOF, this Agreement has been executed and delivered as of the
date first written above.  </td></tr>
<tr><td> IN WITNESS WHEREOF, this Agreement has been executed and delivered as of the date first
written above. <strong> I fully agree and accept that it is my personal responsibility to adhere to the
Company's I.T. Policy and any amendment / modification thereof and to comply with all of the
provisions stated therein in true letter and spirit. I understand and accountable for any
consequence or any misuse of system. I further undertake to abide by the I.T. Policy
guidelines as a condition of my employment and my continuing employment in the Company.  </strong>   </td></tr>
<tr><td> <strong>I ACCEPT ALL TERMS AND CONDITION </strong>   </td></tr>

<tr><td> <strong> <?php  echo $reg_date; ?>  </strong>   </td></tr>

<tr>
        <td>
         <?php  // '<div align="center"><img src="'.base_url().$customer_sign.'" style="width:200px;float:right" /></div>' ?>
        </td>
    </tr>

<tr><td> <strong>CUSTOMER SIGN </strong>   </td></tr>  
<br></br><br></br><br></br><br></br>
<tr><td> <strong> <?php  $name?></strong>   </td></tr>

   
   
    <tr>
         <td>
         <?php echo $name;?>
        </td>
    </tr>
    <tr>
         <td>
         DATA ENTRY OPERATOR
        </td>
    </tr>
    <tr>
         <td>
         <?php echo $care_add;?>
        </td>
    </tr>

    <tr>
    <td>
        <span>Care Number :  </span>
        
         <?php echo $customer_care_no;?>,
          <?php echo $customer_care_no2;?>
        </td>
    </tr>

    <tr>
         <td>
         <?php echo $company_name;?>
        </td>
    </tr>

    <tr>
        <td> AAdhar Card:   </td>
      
       
    </tr>
    <tr>
    <td>
         <?= '<div align="center"><img src="'.base_url().$aadharcard.'" style="width:200px;"     /></div>' ?>

        </td>
       
    </tr>

    <tr>
    <td> Pan Card:   </td>
             
    </tr>

    
    <tr>
    <td>
         <?= '<div align="center"><img src="'.base_url().$pancard.'" style="width:200px;"     /></div>' ?>
        </td>
       
    </tr>

   

</table>

<footer>
    <!-- <div align="center" style="font-size:20px;"><b>Download & Share Copy From</b></div> -->
   
</footer>


</body>
</html>