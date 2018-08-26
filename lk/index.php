<?php
  require_once "../amoCRMFunctions.php";
  require_once "../mysql.php";
  echo "<pre>";
  $leads = getAllLeads();
  foreach ($leads as $lead) {
//    $leadFI = getLeadFullInfo($lead["id"]);
  //  insertLead($leadFI);
  }
//   insertLead(getLeadFullInfo(15233141));
   echo "</pre>";
