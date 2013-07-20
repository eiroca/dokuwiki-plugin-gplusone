<?php
/**
 * Plugin Goole+1
 * @author Enrico Croce & Simona Burzio (staff@eiroca.net)
 * @copyright Copyright (C) 2013-2013 eIrOcA - Enrico Croce & Simona Burzio
 * @license GPL >=3 (http://www.gnu.org/licenses/)
 * @version 1.0.0
 * @link http://www.eiroca.net/doku_gplusone
 */
if (!defined('DOKU_INC')) die();
if (!defined('DOKU_PLUGIN')) define('DOKU_PLUGIN',DOKU_INC.'lib/plugins/');
if (!defined('DOKU_PLUGIN_BARCODE')) define('DOKU_PLUGIN_BARCODE',DOKU_PLUGIN.'barcode/');
require_once (DOKU_PLUGIN.'syntax.php');
require_once (DOKU_PLUGIN_BARCODE.'api/barcode.inc');
class syntax_plugin_gplusone extends DokuWiki_Syntax_Plugin {
	function getType() {
		return 'substition';
	}
	function getPType() {
		return 'normal';
	}
	function getSort() {
		return 999;
	}
	function connectTo($mode) {
		$this->Lexer->addSpecialPattern('~~GPLUSONE.*?~~', $mode, 'plugin_gplusone');
	}
	function getConf($param) {
		$val = $this->localConf[$param];
		if ($val=='') {
			$val = parent::getConf($param);
		}
		return $val;
	}
	function handle($match, $state, $pos, &$handler) {
		global $conf;
		global $ID;
		$paramsArr = explode('~', $match);
		$this->localConf = array();
		for ($i = 3; $i < count($paramsArr); $i++) {
			$param = explode('=', $paramsArr[$i]);
			$this->localConf[$param[0]] = $param[1];
		}
		$out = '<div class="g-plusone"';
		if (!$this->configloaded){
			$this->loadConfig();
		}
		foreach ($this->conf as $param => $val) {
			$val = $this->getConf($param);
			if ($val!='') {
				$out .= ' data-'.$param.'="'.$val.'"';
			}
		}
		$out .= '></div>';
		return $out;
	}
	function render($mode, &$renderer, $data) {
		global $conf;
		if ($mode == 'xhtml') {
			$renderer->doc .= $data;
			return true;
		}
		return false;
	}
}
?>