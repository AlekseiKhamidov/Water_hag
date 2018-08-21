<?php
	// Скрипт проверки
	// Соединямся с БД
	include_once "check.php";
	if (checkLogin() == -1) {
		header("Location: login.php"); exit();
	};
?>

<html>
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="/css/bootstrap.min.css">
        <script src="/js/jquery-3.2.1.min.js"></script>
        <script src="/js/popper.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>

		<style>
			* {
				font-family: 'Helvetica';
			}
			.chip {
			    display: inline-block;
			    padding: 0 25px;
			    height: 50px;
			    font-size: 16px;
			    line-height: 50px;
			    border-radius: 25px;
			    text-overflow: ellipsis;
			    overflow: hidden;
			}

			th {
			    text-align: center;
			}

			caption {
			    text-align: center;
			    caption-side: top;
			}
			.table td, .table th {
				min-width: 130; 
			}

		</style>
	</head>
	<body>	
		<?php
			$link=mysqli_connect("localhost", "root", "", "u0424882_default");
			$query = mysqli_query($link, "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1");
            $userdata = mysqli_fetch_assoc($query);
            include_once 'amoconn.php';
			$partner = $userdata['partner_name'];

			$data = makeLeadsTable($partner);
			echo "<table class=\"table table-hover\" width=98% align='center' border=1 style=\"font-family:'Ubuntu';\">";
				echo "<caption><h1>{$partner}</h1></caption>";
				echo "<caption><h2>Сделки</h2></caption>";
				echo "<thead>";
				echo "<tr>";
					echo "<th>Наименование сделки</th>";
					echo "<th>Дата создания</th>";
					echo "<th>Последнее изменение</th>";
					echo "<th>Сумма</th>";
					echo "<th>Воронка</th>";
					echo "<th>Этап воронки</th>";
	   			echo "</tr>";
   				echo "</thead>";
   				echo "<tbody>";
			foreach ($data as $value) {
				echo "<tr>";
					echo "<td>&nbsp;{$value['name']}</td>";
					echo "<td align='center'>{$value['date_create']}</td>";
					echo "<td align='center'>{$value['last_modified']}</td>";
					echo "<td align='center'>{$value['price']} руб.</td>";
					echo "<td align='center'>{$value['pipeline']}</td>";
					echo "<td align='center'><div class='chip' style=\"background-color: {$value['status-color']}\">{$value['status']}</div></td>";
				echo "</tr>";
			}
			echo "</tbody>";
			echo "</table>";	
		?>
	</body>
</html>