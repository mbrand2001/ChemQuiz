<?php
	session_start();
	unset($_SESSION['userId']);
	session_destroy();
	echo '<script type="text/javascript">';
	echo '		window.location.href="../index.php";';
	echo '</script>';
?>