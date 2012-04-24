<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

$TCA['tx_swflashfilter_flashblocks'] = array (
	'ctrl' => $TCA['tx_swflashfilter_flashblocks']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'flash_width,flash_height,flash_source'
	),
	'feInterface' => $TCA['tx_swflashfilter_flashblocks']['feInterface'],
	'columns' => array (
		'flash_width' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sw_flashfilter/locallang_db.xml:tx_swflashfilter_flashblocks.flash_width',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
		'flash_height' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sw_flashfilter/locallang_db.xml:tx_swflashfilter_flashblocks.flash_height',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
		'flash_source' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:sw_flashfilter/locallang_db.xml:tx_swflashfilter_flashblocks.flash_source',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'flash_width;;;;1-1-1, flash_height, flash_source')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>