<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="UTF-8">
		<title>Chimax Prototypes</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
	</head>
	<body class="bg-light">
		<?php require_once('header.php') ?>
		
		<?php

		if (isset($_GET['page']) && $_GET['page'] == 'detail')
			require_once('detail.php');
		else if (isset($_GET['page']) && $_GET['page'] == 'catalogue')
			require_once('catalogue.php');
		else
			require_once('mon_compte.php');

		?>

		<?php require_once('footer.php') ?>
	</body>
</html>