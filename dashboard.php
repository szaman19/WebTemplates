<?php
	session_start();
	print_r($_SESSION);
	echo session_save_path();
	
?>