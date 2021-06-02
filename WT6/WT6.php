<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>PHP</title>
	<link rel="stylesheet" href="./css/styles.css">
</head>

<body>
	<form name="test" action="lab_6.php" method="post">
		<div class="otvet" style="text-align: center;">
			<?php
			$visit_count = 1;
			$mysql = new mysqli("localhost:3307", "root", "", "datashow");
			$mysql->query("SET NAMES 'utf8'");

			if (isset($_COOKIE["visit_count"])) {
				$visit_count = $_COOKIE["visit_count"] + 1;
			}
			setcookie("visit_count", $visit_count,  strtotime("+30 days"));
			print('<h2 style="margin: 0 0 20px 0; padding: 0px;">Количество посещений:' . $visit_count . "</h2>");
			$mysql->query("INSERT INTO `data` (`data`, `number`) VALUES (CURRENT_DATE(), '$visit_count')");
			$res = mysqli_query($mysql, "SELECT * FROM `data`");
			$tabl = '<table>';
			while ($row = mysqli_fetch_array($res)) {
				$tabl .= '<tr>
			     <td>' . $row['data'] . '</td>
			     <td>#' . $row['number'] . '</td>		     
			 </tr>';
			}
			$tabl .= '</table>';
			echo $tabl;
			?>
		</div>
	</form>
</body>

</html>