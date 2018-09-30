<?php
  require_once "../amoCRMFunctions.php";
  require_once "../mysql.php";
  echo "<pre>";
  $leads = getAllLeads();
//  $a=0;
  foreach ($leads as $lead) {
    $leadFI = getLeadFullInfo($lead["id"]);
  insertLead($leadFI);
  }
  // insertLead(getLeadFullInfo(13448111));
  //    insertLead(getLeadFullInfo(15245835));
 //print_r(getLeadFullInfo(16072041));
// getLeadFullInfo();
   echo "</pre>";
