<?php

 require_once "config.php";


	// function deleteLeads($partnerId = 0) {
	// //		 print_r($partnerId);
	// 	if ($partnerId) {
	// //		 print_r(" hop\n");
	// 		$sql = 'DELETE from `leads` where `partnerId` ='. $partnerId;
	// 	} else {
	// 		$sql = 'DELETE from `leads`';
	// 	}
	// 	processQuery($sql);
	// };

	function getUserdata($userId) {
		$sql = "SELECT * FROM users WHERE user_id = $userId LIMIT 1";
		$result = getNamedResult($sql);
		return $result ? $result[0] : null;
	};

	function selectLeads($partnerId = 0, $startDate = 0, $endDate = 1893456000, $leasing = FALSE, $json = TRUE) {
		$sql = "SELECT * FROM `leads_info` WHERE ".
            ($partnerId ? "`source` LIKE '%$partnerId' AND " : "").
            ($leasing ? "`status` LIKE 'Лизинг%' AND " : "`status` LIKE 'Потреб%' AND ").
            "`created_at` >= $startDate AND `created_at` <= $endDate ORDER BY `created_at` DESC";
	  // print_r($sql);

		$result = getNamedResult($sql);
		return $json ? json_encode($result) : $result;
	};

  function insertLead($lead) {
    $sql = "INSERT INTO `leads_info` (
                        `id`,
                        `name`,
                        `source`,
                        `chief`,
                        `manager`,
                        `created_at`,
                        `price`,
                        `status`,
                        `contact_name`,
                        `contact_phone`,
                        `contact_city`,
                        `note_text`,
                        `note_created_at`) VALUES ";

      $sql .= "('"
            . $lead['id']."',
          '". $lead['Наименование']	."',
          '". $lead['Источник сделки']	."',
          '". $lead['РОП']		."',
          '". $lead['Менеджер']	."',
          '". $lead['Дата создания']		."',
          '". $lead['Бюджет']		."',
          '". $lead['Статус']		."',
          '". $lead['Имя контакта']		."',
          '". $lead['Телефон']		."',
          '". $lead['Город']		."',
          '". $lead['Текст']		."',
          '". $lead['Дата изменения']		."')";

    $sql .= " ON DUPLICATE KEY UPDATE ".
    		"`name` = '" .$lead['Наименование']."', ".
        "`source` = '" .$lead['Источник сделки']."', ".
        "`chief` = '" .$lead['РОП']."', ".
        "`manager` = '" .$lead['Менеджер']."', ".
        "`price` = '" .$lead['Бюджет']."', ".
        "`status` = '" .$lead['Статус']."', ".
        "`contact_name` = '" .$lead['Имя контакта']."', ".
        "`contact_phone` = '" .$lead['Телефон']."', ".
        "`contact_city` = '" .$lead['Город']."', ".
        "`note_text` = '" .$lead['Текст']."', ".
        "`note_created_at` = '" .$lead['Дата изменения']."'";
        print_r($sql."\n ***********************************************************************************************\n");

    return processQuery($sql);
  }

  function deleteLead($id) {
    $sql = "DELETE FROM `leads_info` WHERE `id` = $id";
    return processQuery($sql);
  }

	function insertLeads($leads) {
		$sql = "INSERT INTO `leads` (`id`,
									`partnerId`,
									`partnerName`,
									`number`,
									`createdAt`,
									`status`,
									`name`,
									`phone`,
									`context`,
									`price`,
									`manager`,
									`rop`) VALUES ";

		foreach ($leads as $lead) {
			$sql .= "('".$lead['id']."',
					'".$lead['partnerId']	."',
					'".$lead['partnerName']	."',
					'".$lead['number']		."',
					'".$lead['createdAt']	."',
					'".$lead['status']		."',
					'".$lead['name']		."',
					'".$lead['phone']		."',
					'".$lead['context']		."',
					'".$lead['price']		."',
					'".$lead['manager']		."',
					'".$lead['rop']		."'), \n";
		}

		$sql = mb_substr($sql, 0, -3);

		// $sql .= ' ON DUPLICATE KEY UPDATE '.
		// 		'`status` = '	.$lead['status'].', '.
		// 		'`context` = '	.$lead['context'];

		// print_r($sql."\n ***********************************************************************************************\n");
		return processQuery($sql);
	}

	####################################################################################################################

	function processQuery($query) {
		$link = connect();
		$queryResult = mysqli_query($link, $query);
//    print_r($queryResult);

		closeConnection($link);
		return $queryResult;
	}

	function getNamedResult($query) {
		$link = connect();
		// print_r($query.'<br>');

		$queryResult = mysqli_query($link, $query);

		if (!$queryResult) {
 	   		printf("Error: %s\n", mysqli_error($link));
    		exit();
		}

		$columns = mysqli_fetch_fields($queryResult);
		$data = mysqli_fetch_all($queryResult);
		$result = array();

		if ($data) {
			$j = 0;
			foreach ($data as $row) {
				for ($i = 0; $i < count($row); $i++) {
					$result[$j][$columns[$i]->name] = $row[$i];
				}
				$j++;
			}
		}
		closeConnection($link);
		return $result;
	};


	############################### Connection link ################################################

	function connect() {
		$link=mysqli_connect(MYSQL["host"], MYSQL["login"], MYSQL["password"], MYSQL["dbname"]);
		$link->set_charset("utf8");
		return $link;
	}

	function closeConnection($link) {
		return mysqli_close($link);
	}

	################################################################################################
?>
