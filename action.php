<?php
/**
 * Plugin Goole+1
 * @author Enrico Croce & Simona Burzio (staff@eiroca.net)
 * @copyright Copyright (C) 2013-2013 eIrOcA - Enrico Croce & Simona Burzio
 * @license GPL >=3 (http://www.gnu.org/licenses/)
 * @version 1.0.0
 * @link http://www.eiroca.net
 */
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
if (!defined('DOKU_PLUGIN_GPLUSONE')) define('DOKU_PLUGIN_GPLUSONE',DOKU_PLUGIN.'gplusone/');
require_once(DOKU_PLUGIN . 'action.php');
class action_plugin_gplusone extends DokuWiki_Action_Plugin {
	function register(&$controller) {
		$controller->register_hook('TOOLBAR_DEFINE', 'AFTER', $this, 'toolbar_add_button_gplusone', array ());
		$controller->register_hook( 'TPL_METAHEADER_OUTPUT', 'BEFORE', $this, 'gplus_script' );
	}
	function toolbar_add_button_gplusone(&$event, $param) {
		$event->data[] = array (
			'type' => 'format',
			'title' => $this->getLang('gplusone_editor'),
			'icon' => '../../plugins/gplusone/editor/gplusone.png',
			'open' => '~~GPLUSONE',
			'sample' => @file_get_contents(DOKU_PLUGIN_GPLUSONE.'editor/sample.txt'),
			'close' => '~~',
		);
	}
	function gplus_script(&$event, $param) {
		global $ID;
		global $conf;
		if (plugin_isdisabled('translation') || (!$translation = plugin_load('helper', 'translation'))) {
			$lang = $conf['lang'];
		}
		else {
			$lang=$translation->getLangPart($ID);
		}
		$event->data['script'][] = array (
			'type' => 'text/javascript',
			'_data' => "window.___gcfg = {lang: '$lang'};(function() {var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;po.src = 'https://apis.google.com/js/plusone.js';var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);})();"
		);
	}
}
?>
