<?php

 require_once "config.php";

	// echo "<pre>";
	// print_r(getUserdata(1));
	// echo "</pre>";


	function deleteLeads($partnerId = 0) {
		if ($partnerId) {
			$sql = 'DELETE from `leads` where `partnerId` ='. $partnerId;
		} else {
			$sql = 'DELETE from `leads`';
		}
		processQuery($sql);
	};

	function getUserdata($userId) {
		$sql = "SELECT * FROM users WHERE user_id = $userId LIMIT 1";
		$result = getNamedResult($sql);

		return $result ? $result[0] : null;
	};

	function selectLeads($partnerId = 0) {
		$sql = $partnerId ? "SELECT * FROM `leads` where `partnerId` = $partnerId order by `number` desc"
							: "SELECT * FROM `leads` order by `createdAt` desc";
		$result = getNamedResult($sql);
		return $result ? $result : null;
	};

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
		$link=mysqli_connect(
      MYSQL["host"],
      MYSQL["login"],
      MYSQL["password"],
      MYSQL["dbname"]
    );

		$link->set_charset("utf8");
		return $link;
	}

	function closeConnection($link) {
		return mysqli_close($link);
	}

	################################################################################################
?>
