<?php

// # Aspen SW Globals ==============================================================
$aspen_sw_opts_cache = false;	// internal cache for all settings


// ===============================  options =============================

function aspen_sw_getopt($opt) {
    global $aspen_sw_opts_cache;
    if (!$aspen_sw_opts_cache)
        $aspen_sw_opts_cache = get_option('aspen_sw_settings' ,array());

    if (!isset($aspen_sw_opts_cache[$opt]))	// handles changes to data structure
      {
	return false;
      }
    return $aspen_sw_opts_cache[$opt];
}

function aspen_sw_setopt($opt, $val, $save = true) {
    global $aspen_sw_opts_cache;
    if (!$aspen_sw_opts_cache)
        $aspen_sw_opts_cache = get_option('aspen_sw_settings' ,array());

    $aspen_sw_opts_cache[$opt] = $val;
    if ($save)
	aspen_sw_wpupdate_option('aspen_sw_settings',$aspen_sw_opts_cache);
}

function aspen_sw_save_all_options() {
    global $aspen_sw_opts_cache;
    aspen_sw_wpupdate_option('aspen_sw_settings',$aspen_sw_opts_cache);
}

function aspen_sw_delete_all_options() {
    global $aspen_sw_opts_cache;
    $aspen_sw_opts_cache = false;
    if (current_user_can( 'manage_options' ))
	delete_option( 'aspen_sw_settings' );
}

function aspen_sw_wpupdate_option($name,$opts) {
    if (current_user_can( 'manage_options' )) {
	update_option($name, $opts);
    }
}

// =============================== transient options =============================

if (!function_exists('atw_globals')) {
    function atw_globals($glb) {
    return isset($GLOBALS[$glb]) ? $GLOBALS[$glb] : '';
}
}

if (!function_exists('atw_t_set')) {
    function atw_t_set($opt, $val) {
    $GLOBALS['aspen_temp_opts'][$opt] = $val;
}
}

if (!function_exists('atw_t_get')) {
    function atw_t_get($opt) {
    return isset($GLOBALS['aspen_temp_opts'][$opt]) ? $GLOBALS['aspen_temp_opts'][$opt] : '';
}
}

if (!function_exists('atw_t_clear')) {
    function atw_t_clear($opt) {
    unset($GLOBALS['aspen_temp_opts'][$opt]);
}
}

if (!function_exists('atw_t_clear_all')) {
    function atw_t_clear_all() {
    unset($GLOBALS['aspen_temp_opts']);
}
}

?>
