<?php
if ( !defined('ABSPATH')) exit; // Exit if accessed directly
// The Aspen Themeworks file access plugin for use in plugins

if (!function_exists('aspentw_f_file_access')) {

function aspentw_f_file_access() {
	return true;
}

function aspentw_f_open($fn, $how) {
	return fopen($fn, $how);
}

function aspentw_f_write($fn,$data) {
	return fwrite($fn,$data);
}

function aspentw_f_close($fn) {
	return fclose($fn);
}

function aspentw_f_delete($fn) {
	return @unlink($fn);
}

function aspentw_f_is_writable($fn) {
	return @is_writable($fn);
}

function aspentw_f_touch($fn) {
	return @touch($fn, time(), time());
}

function aspentw_f_mkdir($fn) {
	return wp_mkdir_p($fn);
}

// functions for reading files

function aspentw_f_exists($fn) {
	// this one must use native PHP version since it is used at theme runtime as well as admin
	return @file_exists($fn);
}

function aspentw_f_get_contents($fn) {
	return file_get_contents($fn);
}

// =========================== helper functions ===========================
function aspentw_f_content_dir() {
	// delivers appropraite path for using aspentw_f_ functions. WP_CONTENT_DIR
	return trailingslashit(WP_CONTENT_DIR);
}

function aspentw_f_plugins_dir() {
	// delivers appropraite path for using aspentw_f_ functions. WP_PLUGIN_DIR
	return trailingslashit(WP_PLUGIN_DIR);
}

function aspentw_f_themes_dir() {
	// delivers appropraite path for using aspentw_f_ functions.
	return aspentw_f_content_dir() . 'themes/';
}

function aspentw_f_wp_lang_dir() {
	return trailingslashit(WP_LANG_DIR);
}

function aspentw_f_uploads_base_dir() {
	// delivers appropraite path for using aspentw_f_ functions.
	$upload_dir = wp_upload_dir();
	return trailingslashit($upload_dir['basedir']);

}

function aspentw_f_uploads_base_url() {
	$wpdir = wp_upload_dir();           // get the upload directory
	return trailingslashit(trim($wpdir['baseurl']));
}


function aspentw_f_wp_filesystem_error() {
	return false;
}

function aspentw_pop_msg($msg) {
	echo "<script> alert('" . $msg . "'); </script>";
	// echo "<h1>*** $msg ***</h1>\n";
}

function aspentw_log($msg, $data='') {
	$handle = fopen(aspentw_f_uploads_base_dir() . 'aspentw_log.txt', 'a');
	fwrite($handle,$msg . ':' . $data . "\n");
	fclose($handle);
}

function aspentw_f_fail($msg) {
	aspentw_pop_msg($msg);
	return false;
}
}
?>
