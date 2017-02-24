<?php
include_once 'resources/sessions.php';
include_once 'resources/utilities.php';


session_destroy();

redirectTo('index');

?>
