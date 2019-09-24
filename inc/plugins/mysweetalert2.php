<?php

/**
	* MySweetAlert2 Plugin
	* Author: Skryptec
	* Website: https://skryptec.net/
	* Copyright: © 2014 - 2019 Skryptec
	*
	* Replaces JQuery's jGrowl with SweetAlert2.
*/

if(!defined("IN_MYBB")) {
	die("Direct initialization of this file is not allowed.");
}

function mysweetalert2_info() {
	return [
		'name' 			=> 'MySweetAlert2',
		'description' 	=> 'Replaces JQuery\'s jGrowl with SweetAlert2.',
		'website' 		=> 'https://skryptec.net/',
		'author' 		=> 'Skryptec',
		'authorsite' 	=> 'https://skryptec.net/',
		'version' 		=> '1.0',
		'compatibility' => '18*',
		'codename'      => 'skryptec_mysweetalert2',
	];
}

function mysweetalert2_install() {
	require_once MYBB_ROOT . 'inc/plugins/MySweetAlert2/class.functions.php';
	$mySwalFunctions = new MySweetAlert2_Functions();

	if($mySwalFunctions->getFiles('')) {
		$mySwalFunctions->createBackupForRevert();
	}
}

function mysweetalert2_uninstall() {
	require_once MYBB_ROOT . 'inc/plugins/MySweetAlert2/class.functions.php';
	$mySwalFunctions = new MySweetAlert2_Functions();

	$mySwalFunctions->revertSwal();
}

function mysweetalert2_activate() {

}

function mysweetalert2_deactivate() {
	
}

function mysweetalert2_is_installed() {
	return file_exists('../jscripts/mysweetalert2_backup');
}