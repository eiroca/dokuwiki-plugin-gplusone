<?php
$meta['href'] = array('string');
$meta['size'] = array('multichoice', '_choices' => array('', 'small', 'medium', 'standard', 'tall'));;
$meta['annotation'] = array('multichoice', '_choices' => array('', 'none', 'bubble', 'inline'));
$meta['width'] = array('string', '_pattern' => '/[0-9]/');
$meta['align'] = array('multichoice', '_choices' => array('', 'left', 'right'));
$meta['expandTo'] = array('string');
$meta['callback'] = array('string');
$meta['onstartinteraction'] = array('string');
$meta['onendinteraction'] = array('string');
$meta['recommendations'] = array('multichoice', '_choices' => array('', 'true', 'false'));
?>
