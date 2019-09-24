<?php

define('IN_MYBB', 1); 
require "../../global.php";

require_once MYBB_ROOT . 'inc/plugins/MySweetAlert2/class.functions.php';

$functions = new Functions($mybb, $lang);
$functions->getFiles();