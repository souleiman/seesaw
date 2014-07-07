<?php 
	$link = mysql_connect('localhost', 'root', 'mountain');
	if (!$link) {
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db('imagine');
?>

<?php session_start();
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$query="INSERT INTO `imagine`.`dummy` (`id`, `username`, `description`, `comment_count`, `tags`, `time_created`) VALUES (NULL, 
			'".htmlentities($_POST['username'])."', '".htmlentities($_POST['description'])."', 
			'0', '".htmlentities($_POST['tags'])."', CURRENT_TIMESTAMP
			)";
		mysql_query($query) or die('Error inserting into the database');
	}
?>


<script>
	var delayReload = window.setInterval(function(){
		clearInterval(delayReload);
		document.location.href = "http://localhost/seesaw/demo/index.php";
	}, 1000);
</script>