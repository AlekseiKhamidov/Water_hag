<?php

	require_once "amoconn.php";
	require_once "config.php";
	require_once "lead.php";
	require_once "contacts.php";
	require_once "notes.php";
	require_once "mysql.php";

	// echo '<pre>';
	
	$userdata = getUserdata(intval($_COOKIE['id']));

	deleteLeads($userdata['partner_id']);
	// print_r($userdata);
	prepareLeads($userdata['partner_id']);
	// echo '</pre>';


	function prepareLeads($partner_id = 0) {
		set_time_limit(0);

		$pipelines = getPipelines();
		$partners = getLeadCustomFieldEnums(AMO_CFID_PARTNER);
		print_r("hooop\n");
		print_r($partners);
		
		if (!$partner_id) {
			print_r("est partneri\n");
			foreach ($partners as $partnerId => $partnerName) { 
					print_r("!!partnerId".$partnerId."\n");
						print_r("!!partnerName".$partnerName."\n");
				prepareLead($pipelines, $partnerId,$partnerName);
			}
		} else {
			 print_r('PARTNERID: '.$partner_id);
			prepareLead($pipelines, $partner_id);
		}
	};
	
	function prepareLead($pipelines, $partner_id,$partnerName="") {
			print_r("@@partner_id".$partner_id."\n");
				print_r("@@partnerName".$partnerName."\n");
		$leads = getLeadsByPartner($partner_id);
		$i = 1;
		$result = array();
		foreach ($leads as $lead) {
			$data = &$result[];

			$data['id'] = $lead['id'];
			$data['partnerId'] = $partner_id;
			$data['partnerName'] = $partnerName;
			$data['number'] = $i++;
			$data['createdAt'] = $lead['created_at'];
			$pipeline = $pipelines[$lead['pipeline']['id']];

			$data['status'] = $pipeline['name'].'^'.$pipeline['statuses'][$lead['status_id']]['name'].'^'.$pipeline['statuses'][$lead['status_id']]['color'];

			$contact = $lead['contacts'] ? getContactById($lead['contacts']['id'][0]) : null;
			$data['name'] = $contact ? $contact['name'] : $lead['name'];
			$data['phone'] = $contact ? getContactPhones($contact) : 'Телефон не найден';
			
			$data['context'] = getLastLeadNote($lead['id']);
			$data['price'] = $lead['sale'];

			$data['manager'] = getCFValue($lead, 'Менеджер');
			$data['rop'] = getCFValue($lead, 'РОП');
			print_r($data);
		}
		 
		insertLeads($result);	
	};
	

?>
	