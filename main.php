<?php
	define("IN_SYSTEM", 1);
	
	require_once("./includes/common.php");
	require_once("./includes/db_init.php");
	require_once("./includes/auth.php");
	require_once(FASTTEMPLATES_PATH . "template.php");

	$tpl = new FastTemplate(TEMPLATES_PATH);

	$tpl->define(array(
			"page"          => "page.tpl",
			"main_content"  => "main_content.tpl",
		));

	# MAIN #######################################################################################
	
	$tpl->parse("PAGE_CONTENT", "main_content");
	$tpl->parse("FINAL", "page");
	$tpl->FastPrint();
?>
