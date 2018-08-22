<?php

	require_once "amoconn.php";
	require_once "config.php";

	// echo "<pre>";
	// print_r(getLeadsByPartner(182605));
	// echo "</pre>";



	################################# GET-функции #########################################

	function getCFValue($lead, $cfName) {
		$result = '';
		foreach ($lead['custom_fields'] as $cf) {
			if ($cf['name'] == $cfName) {
				foreach ($cf['values'] as $value) {
					$result .= $value['value'].'<br>';
				}
			}
		}
		return $result;
	};
	
	function getLeadsByPartner($partnerId) {
		set_time_limit(0);
		$result = array();
		$leads = getAllLeads();
		$i = 1;
		foreach ($leads as &$lead) {
			if (isset($lead['custom_fields'])) {
				foreach ($lead['custom_fields'] as $cf) {
					if ($cf['id'] == AMO_CFID_PARTNER) {
						if ($cf['values'][0]['enum'] == $partnerId) {
							$result[] = $lead;
						}
					}
				}
			}
		}

		return $result;
	};

	function getAllLeads() {
		$leads = array();
		$offset = 0;
		do {
			$moreLeads = getLeads(null, $offset);
			if ($moreLeads) {
				$leads = array_merge($leads, $moreLeads);
			}
			$offset  += 500;
			usleep(250000);
		} while ($moreLeads);
		return $leads;
	};

	function getLeads($timestamp, $offset=0) {
		$link='https://'.AMO_SUBDOMAIN.'.amocrm.ru/api/v2/leads?limit_rows=500&limit_offset='.$offset; 
		if ($timestamp){
			return processCURL($link,null,$timestamp)['_embedded']['items'];	
		}
		return processCURL($link)['_embedded']['items'];		
	};

	function getLeadById($id) {
		$data = array('id' => $id);
		$query = http_build_query($data);		

		$link='https://'.AMO_SUBDOMAIN.'.amocrm.ru/api/v2/leads?'.$query;
		$Response = processCURL($link);
		return $Response['_embedded']['items'];	
	};

?>