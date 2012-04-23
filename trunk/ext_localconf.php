<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_swflashfilter_pi1.php', '_pi1', 'list_type', 0);

session_start();
if (isset($_GET['noflash']) && $_GET['noflash'] == 1){
	$_SESSION['noflash'] = true;
} elseif (isset($_GET['noflash']) && $_GET['noflash'] == 0) {
	$_SESSION['noflash'] = false;
}

$TYPO3_CONF_VARS['SC_OPTIONS']['tslib/class.tslib_fe.php']['contentPostProc-output'][$_EXTKEY] =
	'EXT:sw_flashfilter/pi1/class.tx_swflashfilter_pi1.php:tx_swflashfilter_pi1->clearFlash';

t3lib_extMgm::addTypoScript($_EXTKEY,'setup','
	tt_content.shortcut.20.0.conf.tx_swflashfilter_flashblocks = < plugin.'.t3lib_extMgm::getCN($_EXTKEY).'_pi1
	tt_content.shortcut.20.0.conf.tx_swflashfilter_flashblocks.CMD = singleView
',43);
?>