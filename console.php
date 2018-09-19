<?php
	require_once("./includes/common.php");
	require_once("./includes/db_init.php");

	# VAR #######################################################################################

	$count = $argv[1];				// количество людей, кому начислить
	$value = $argv[2];				// сумма начисления

	if (!$count) $count = 10;
	if (!$value) $value = 1000;

	# MAIN #######################################################################################

	system("clear");

	$start_time = microtime(true);

	$result = db_query("SELECT * FROM users LIMIT ".$count);
	if (db_num_rows($result) > 0) {
		while ($row = db_fetch_array($result)) {
			logAction(0, $value, $row['id']);

			echo "User name: ".$row['login'].PHP_EOL;
			echo "User id: ".$row['id'].PHP_EOL;
			echo "User amount: ".$value." USD".PHP_EOL;
			echo "================================";
		}
	}

	$elapsed_time = round(microtime(true) - $start_time, 3);

	echo "File processed in ".$elapsed_time."s".PHP_EOL;
?>
