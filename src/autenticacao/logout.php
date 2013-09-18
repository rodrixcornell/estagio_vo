<?php
    include "../../php/define.php";
	
    session_start();
    session_destroy();
    session_unset();

    header("Location: ".$url);
?>