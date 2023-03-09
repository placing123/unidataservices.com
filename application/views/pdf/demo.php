

<?php 
$where = array('id'=>$plan_id);
$plan_data =  $this->model->hdm_get_where('tbl_plan',$where);
$forms = $plan_data[0]->forms;
$days = $plan_data[0]->days;
$per_form =  $plan_data[0]->per_form;
$accu = $forms * 90 /100;


$master_data = $this->model->hdm_get('tbl_master');
$customer_care_no = $master_data[0]->care_no;
$care_eml = $master_data[0]->care_eml;
$care_add = $master_data[0]->address;
$company_name = $master_data[0]->name;


$logo = $master_data[0]->logo;
$seal = $master_data[0]->seal;
$company_sign = $master_data[0]->company_sign;
$agreement_img = $master_data[0]->agreement_img;

?>


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



<div style="line-height: 1.2; font-size:25px; font-weight: bold;">
    
    <?= '<div align="center"><img src="'.base_url().$agreement_img.'" style="width:700px;" /></div>' ?>

</div>
<br><br><br><br>
<table align="center" width="100%" style="line-height: 1.9; font-size:20px;">

     
<tr> <td  align="center"  >    <strong>FREELANCER CONTRACT  </strong>  </td> </tr>  
<tr> <td>    This FREELANCER CONTRACT, herein referred to as the “Agreement,” is made and entered into on the <?php echo  date('d-m-Y');?>, by and between</td> </tr>  
<tr> <td>    <?php  echo $name;?>(Second Party)</td> </tr>  
<tr> <td>   1. <a href="<?php echo base_url().'customer-login'?>">Company</a>  a DATA MANAGEMENT company engaged in the business of IT ENABLED SERVICES & SOLUTIONS   with legal business address at Maya Mansion, Near BTC, New Palasia, Indore, 
</td> </tr>  

<tr> <td>   <?php echo $name;?>(“Freelancer”),  an independent contractor engaged in the business of creating designs for any client, and whose legal residential address is at <?php echo $address;?></td></tr>
 
<tr><td> <?php echo  date('d-m-Y');?></td> </tr>  
<tr><td> BACKGROUND</td> </tr>


<tr> <td>  1. Company is in need of a freelancer for DATA ENTRY and has expressed interest in commissioning Freelancer for the performance of certain duties in line with the aforementioned purposes.
</td> </tr>

<tr> <td>2. Freelancer acknowledges and agrees to perform such duties for Company under the terms and conditions of this Contract.

</td>
</tr>  
<tr> <td> CONTRACT
</td> </tr>

<tr> <td> 1. PURPOSE</td> </tr>
<tr> <td>  This Contract is made by and between Company and Freelancer for the following purposes:

</td> </tr>
<tr> <td>1.1. The Party of the First Part is engaged mainly in Outsourcing of IT enabled Services and To deliver Data Entry and Transcription and allied Activities and Other Ancillary Activities Associated there with an Organization engaged in providing data to you end clients and data entry related line of work. And executing such work Outsourced, through Delivery Partners.
</td> </tr>
<tr> <td>1.2. The Party of the First Part is bound by time schedule set by the
     Delivery Partners and that its reputation is built upon speedy and accurate transcription and 
     requires the said party to deliver accomplished work within shortest span and with desired accuracy the First Party has entered with a firm launching its new BANKING PORTAL and has represented itself that it has an expertise in the area of providing MARKETING (Banking)/ Presently it is in a position to procure the business for form filling more meaningfully described in the column Scope of Work, through their principals. AND WHEREAS the Business Associate is engaged inter alias, in the business of providing a wide Spectrum of software solutions & services. The Business Associate has acquired the necessary expertise and developed the requisite skill base and 
    Infrastructure for successful execution of Form Filling Projects.</td> </tr>
<tr> <td> Whereas, the Second Party is an individual and a Freelancer who is willing to provide its services to the Job Portal Company, via medium of First Party in relation with IT &all data related work which is to be provided by the First Party This Agreement represents the business Agreement and operational understandings between the parties and shall remain in effect for a period of 30 DAYS from the date of execution hereof or from the date of providing the first data whichever is later & can be extended for the period as mutually agreed upon, for the purpose

</td> </tr>
<tr> <td> 2. WORK MATTERS:  </td> </tr>
<tr> <td> The First Party shall provide details of the FORMS through the login credentials shared through SMS Or Email
</td> </tr>

    <tr>
      <td>
      The Second Party further Represents to the First Party, the time for the Completion of the said data entry related services as
       mentioned in this Agreement, shall Commence Immediately upon logging on the portal OR if the Commencement
        Date is mentioned in the said Communication, from such date, and it shall Continue to Access its said Portal/E-Mail as
         provided in the Records of the First Party, as frequently as necessary for the said Purpose.. That the Second Party agrees to pay Rs. 5500+18% GST as charges for membership, Portal charges, GST and other applicable charges in case of failure to submit complete workload or to provide workload on time with desired accuracy. This membership will include Jobs Vacancy information in Pan India through our Social Media platform.

      </td>
    </tr>

    <tr>
      <td>
      That consideration of the above Fees/charges, the first party will provide agreement which will be valid for 1 month '
      but project duration will be 6 days as mentioned. It also pertinent to mention here that one project will contain 500
       forms in one project.

      </td>
    </tr>

    <tr>
      <td>
      Payment to be made maximum within 6 days of each calendar month, from the QC report, which will be given usually within 5 days of submission of the work
      </td>
    </tr>
    <tr>
         <td>
         Technical clause: 

          </td>
    </tr>

    <tr>
         <td>Helpline department will support you in only 10% queries from the whole project. 

          </td>
    </tr>
    <tr>
         <td>For example: if you have taken the 500 pages/forms plan, then helpline dept. is liable to give reply only 55 pages/forms queries of 10% of whole project. 

          </td>
    </tr>
    <tr>
         <td> Work will automatically get Submit in 48 hours. 

          </td>
    </tr>
    <tr>
         <td>No use of any shortcut keys while typing in terminal else you will be responsible for the same

          </td>
    </tr>
    <tr>
         <td>
         2.1. Freelancer shall create and accomplish project materials and all other instructed work by Company, as per the purposes of this Contract.

          </td>
    </tr>
     <tr>
         <td>
         2.2. Freelancer shall be given deadlines for each instructed item. Such deadlines must be met strictly by Freelancer. Late submissions or incomplete 
          </td>
    </tr>

    <tr>
         <td>
         2.3. Freelancer will participate with Company in editing and moreover reviewing the work prior to its launch.
        </td>
    </tr>
    <tr>
         <td>
         2.4. Once the work is confirmed, Freelancer accepts responsibility for any other modes of procedure required to accomplish in which this work is used. Company is not liable for mistakes that may happen in the work or projects which are related to this work upon accepting the work by the Freelancer.

        </td>
    </tr>
    <tr>
         <td>
         2.3. Freelancer will participate with Company in editing and moreover reviewing the work prior to its launch.
        </td>
    </tr>

    <tr>
         <td>3. TERM AND TERMINATION

        </td>
    </tr>

    <tr>
         <td>
         3.1. This Contract shall commence on registration date and shall terminate automatically upon Freelancer’s completion of all designated workloads as per this Contract.    </td>
    </tr>
    <tr>
         <td>
         3.2. Either the Company or the Freelancer may terminate this Contract at any time if, for any reason. In case of such premature termination, the party wishing to terminate shall furnish a signed copy of its notification to terminate 1-2 days prior to its preferred termination date.
    </td>
    </tr>
    <tr>
         <td>
         3.3. All outstanding reasonable dues payable to the Freelancer by the Company shall be paid 1-2 days thereafter the termination of this Contract. 
  </td>
    </tr>
    <tr>
         <td>
         3.4. In case of cancellation, Freelancer have to bare the loss* of all projects allotted by company total 3 project each project cost 5500+18% tax total amount will 19470 rs.
  </td>
    </tr>

    <tr>
         <td>
         3.5. Second party will get 500 forms for 6 days. Per form rate will be Rs. 40/-.
           </td>
    </tr>
    <tr>
         <td>
         (a). No initial payment is required to be given by second party.
           </td>
    </tr>
    <tr>
         <td>
         b). After getting the accuracy report of having 75% above accuracy  of total provided work 100% accuracy required
          in each page, your payment will be processed within 6 international working days in to your respective bank account. 
         <strong  style="background:yellow";  > An accurate form is that which doesn't have any error such as spelling/punctuation/extra space/extra text/missing text.</strong>
           </td>
    </tr>

    <tr>
         <td>
         <strong>PROCEDURE FOR GENERATION OF ACCURACY REPORT: The Determining Centre personnel shall check all the data processing of FORMS. After an error is found in a particular FORM the Centre personnel shall list that as inaccurate and start checking the next FORM. All the errors in the whole FORM will not be shown in the Accuracy Report. Once all data processing of FORM are checked, the final Accuracy Report shall be generated.
</strong>
           </td>
    </tr>


    <tr>
         <td>
         (c). In the matter of failure, non-submission, accuracy below 75% then company is entitled to receive amount of Rs. 5500+18% tax* by any cost from the second party. If in case second party uses multiple login then penalty will be Rs. 250/-. If second party passes and achieves the accuracy of 75% or above, then amount will be deducted from his work payment and remaining shall be paid.
</td>
    </tr>
     <tr>
         <td>
         (d). The charge of Rs. 5500+18% tax* is related to service, development and maintenance cost of the platform where he is working online.
</td>
    </tr>
    <tr>
         <td>
         4. CONSIDERATION
 </td>
    </tr>
    <tr>
         <td>In exchange for Freelancer’s services, Company shall pay Freelancer a Per accurate page 40RS,
              payable according to the following schedule: Payment to be made maximum within 6 days of each calendar month, from the QC report, 
														which will be given usually within 5 days of submission of the work.. Freelancer request major 
														changes on any of Freelancer’s works, Freelancer is entitled to a change fee of 10rs
              per form payable prior to company of the change order. 
           </td>
    </tr>
    <tr>
         <td>
      
5. INDEMNIFICATION

           </td>
    </tr>
    <tr>
         <td>
         Each Party indemnifies the other from any and all forms of claims, damages, losses, and liabilities which may arise from
									 its performance or non-performance of its obligations under this Contract.
    </td>
    </tr>


    <tr>
         <td>
      

         6. NO INSURANCE


           </td>
    </tr>
    <tr>
         <td>
         Freelancer shall be responsible for insurance coverage in its performance of duties for Company under this Contract.     </td>
    </tr>


    <tr>
         <td>
      

         7. LIMITATION OF LIABILITY


           </td>
    </tr>
         <tr>
            <td>
            The Second Party shall complete the services of the said Data entry work in Six (6) days TAT period, i.e., 500 forms must be completed within a period of 6 days. 
        </td>
        </tr>

    <tr>
         <td>
         The Second Party alone shall be responsible for the maintenance of Hardware and Personnel for such timely services and no excuse of whatsoever Nature shall be entertained for delay in Supply of services, since Time is the Essence of this Contract.


           </td>
    </tr>
    <tr>
         <td>
         The Present Contract shall be in force for 1 month membership. The said Contract shall come to an End at the Expiry of the said Period and may be renewed by Mutual Consent and on such Revised Terms agreed between the Parties and on Payment of Processing Charges for another Project by the Second Party. ID Allocation: Business Associate will get single id to work on and Business Associate can work 24X7 on this id. TAT (Turnaround Time): Turnaround time for completing the project is mentioned in the schedule. The Business Associate through this agreement guarantees the delivery of work within stipulated timeframe with desired accuracy.
</td>
    </tr>

    <tr>
         <td>
      
         8. CONFIDENTIALITY

           </td>
    </tr>
    <tr>
         <td>
         8.1. In its course of providing freelance services to Company, Freelancer shall be privy to proprietary information regarding and relating to Company, which includes but is not limited to INFORMATION OF THE COMPANY E.G. PRODUCTS, SERVICES, MARKETING STRATEGIES, PENDING PROJECTS OR PROPOSALS, and OTHERS]. Thus, Freelancer agrees to ensure and secure the confidentiality of such proprietary information. 
     </td>
    </tr>


    <tr>
         <td>
      
         8.2. Freelancer, at any time including thereafter the conclusion of this Contract shall have no right to divulge, distribute or use such information in any manner whatsoever. 
           </td>
    </tr>
    <tr>
         <td>
         8.3. Freelancer shall maintain the right to exhibit and present materials and final work created for Company on Freelancer’s website  <a href="<?php echo base_url().'customer-login';?>"><?php echo base_url().'customer-login';?></a>, except when strict confidentiality is requested by the Company prior to the creation of this contract and for purposes that shall contradict the terms of this Contract.
</td>
    </tr>

    <tr>
         <td>
      
         9. Severability

           </td>
    </tr>

    <tr>
         <td>
      
         : If any provision of this Agreement is held to be invalid, illegal or unenforceable in whole or in part, the remaining provisions shall not be affected and shall continue to be valid, legal and enforceable as though the invalid, illegal or unenforceable parts had not been included in this Agreement. 

           </td>
    </tr>
    <tr>
         <td>
      
         IN WITNESS WHEREOF, this Agreement has been executed and delivered as of the date first written above.

           </td>
    </tr>
    

    <tr>
         <td>
      
         10. RELATIONSHIP OF PARTIES

           </td>
    </tr>
    
    <tr>
         <td>
      
         The Freelancer is an independent contractor. This Contract does not generate any employment, agency, joint venture, 
         joint employment or partnership between  <a href="<?php echo base_url().'customer-login'?>"> CLICKS TO WORK  </a> and <?php echo $name;?>  Neither party will have the right, power, or authority to act for the other in any manner whatsoever. 

           </td>
    </tr>
    
    <tr>
         <td>
         11. TAXES 
        </td>
    </tr>

    <tr>
         <td>
         Freelancer is liable for any and all income and other tax liabilities arising from any payments as stipulated herein.
        </td>
    </tr>
    
    <tr>
         <td>
        
12. ASSIGNMENT

        </td>
    </tr>
    
    <tr>
         <td>
         Second party will get 500 forms for 6 days. Per form rate will be Rs. 40/-.(a). No initial payment is required to be given by second party.(b). After getting 
									the accuracy report of having 75% above accuracy, your payment will be processed within 6 international working days in to your respective bank account. An accurate form is that which doesn't have any error such as spelling/punctuation/extra space/extra text/missing text.

        </td>
    </tr>
    
    <tr>
         <td>
         13. NOTICES
        </td>
    </tr>

    <tr>
         <td>
         Any notices in compliance to this Contract shall be sent by  <a href="<?php echo base_url();?>"> <?php echo base_url();?> </a> to the address as mentioned above,
          or to such other addresses as either of the party may designate and require to the other and most importantly,
           be done in writing. Delivery of any notice will be considered to be effective 1 day after mailing, or on the 
           date of personal delivery, if required.

        </td>
    </tr>
    <tr>
         <td>
         14. CHANGES
        </td>
    </tr>
    <tr>
         <td>
         Any changes either verbal or written made by the Company to the area of the work following its commencement by the Freelancer are subject to additional charges. The Freelancer accepts the responsibility for payment of the completed work and all services related to it, as additional to charges for the change itself should such changes invalidate any part of the work already completed at the time of the change. 

        </td>
    </tr>

    <tr>
         <td>
         15. INTEGRATION
        </td>
    </tr>

    <tr>
         <td>
         This Contract together with [SPECIFY THE ATTACHED EXHIBITS AND/OR OTHER ATTACHMENTS, AS APPLICABLE] supersedes any and all other past Contracts, either oral or written, and contains the entire Contract of the parties.
        </td>
    </tr>
    <tr>
         <td>
         16. SETTLEMENT OF DISPUTES, GOVERNING LAW & ARBITRATION

        </td>
    </tr>
    <tr>
         <td>
         Any dispute and/or difference arising out of, or relating to this agreement including interpretation of its terms will be resolved through joint discussion by the authorized representatives of both the parties. Moreover, if the disputes are not resolved by discussion then the matter will be referred for adjudication to the Arbitration of a Sole arbitrator.

        </td>
    </tr>
    <tr>
         <td>
         This Agreement shall be governed by the laws of India.  The Courts in Madhya Pradesh Indore 
         shall have exclusive jurisdiction over the subject matter of this Agreement.
        </td>
    </tr>

    <tr>
         <td>
         In the event of any dispute or differences arising out of or in connection with this agreement,
          the parties hereto, agree to resolve their dispute by a sole arbitrator chosen by the parties in fast track procedure under the provision of Sec29B of Arbitration and Conciliation act of 1996. The award under this section shall be made within a period of 
         6 months from the date of commencement of the arbitral tribunal proceedings.
        </td>
    </tr>

    <tr>
         <td>
         The arbitration proceedings shall be conducted in English. The place of Arbitration shall be in Madhya Pradesh Indore. The award passed in the arbitration proceedings shall be final and binding on both the parties.

        </td>
    </tr>
    <tr>
         <td>
         The cost of arbitration proceedings shall be equally borne by both the parties.

        </td>
    </tr>
    <tr>
         <td>
         Each party shall individually bear the fees of their respective Advocate/Counsel for the proceedings.
        </td>
    </tr>
    <tr>
         <td>
         17. ACCEPTANCE OF TERMS
        </td>
    </tr>
    <tr>
         <td>
         The Company hereby promises to pay for the services executed and provided by Freelancer for the work accomplished as agreed by the contracting parties. 

        </td>
    </tr>
    <tr>
         <td>
         Business Associate have to compulsory pay penalty amount of 6150* to stop legal proceedings within 12 hours. In the matter of fact failure, not submitted the Client is entitled to receive penalty amount by any cost. If Business Associate achieves accuracy then Business Associate will not be liable to pay the penalty amount. If Business Associate fails in achieving accuracy, then Business Associate has to pay the penalty according to the selected plan as a liability. WHY SERVICE CHARGES? - We offer 24*7 helpline options on website. - We offer day time customer care call support. - Email support - Job consultation charges. - Stamp paper and agreement preparation charges. - Charges will be deducted from the payment once accuracy is achieved

        </td>
    </tr>
    <tr>
         <td>
           I, <?php echo $name;?>, declare that I am a person employed by       <a herf="<?php echo base_url().'customer-login';?>">       &ldquo;  CLICKS TO WORK   &rdquo; , and that I have the rights and authority to promise and fulfill payment for the services executed and performed by the Freelancer for the abovementioned work. I hereby acknowledge that I have read, understood and agree to the covenants and conditions of this Contract.
        </td>
    </tr>
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
        
         <?php echo $customer_care_no;?>
        </td>
    </tr>

    <tr>
         <td>
         <?php echo $company_name;?>
        </td>
    </tr>

    <tr>
         <td>
         <?= '<div align="center"><img src="'.base_url().$seal.'" style="width:200px;float:left"     /></div>' ?>

        </td>
        <td>
         <?= '<div align="center"><img src="'.base_url().$company_sign.'" style="width:200px;float:right" /></div>' ?>

        </td>
    </tr>

   


    
    


    







   


</table>

<footer>
    <div align="center" style="font-size:20px;"><b>Download & Share Copy From</b></div>
   
</footer>


</body>
</html>