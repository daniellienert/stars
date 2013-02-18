<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::configurePlugin(
	'TYPO3.' . $_EXTKEY,
	'Stars',
	array(
		'Stars' => 'index',
		
	),
	// non-cacheable actions
	array(
	)
);

?>