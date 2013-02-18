<?php
if (!defined('TYPO3_MODE')) {
	die ('Access denied.');
}

Tx_Extbase_Utility_Extension::registerPlugin(
	$_EXTKEY,
	'Stars',
	'Stars'
);

t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Stars');

t3lib_extMgm::addLLrefForTCAdescr('tx_stars_domain_model_rating', 'EXT:stars/Resources/Private/Language/locallang_csh_tx_stars_domain_model_rating.xlf');
t3lib_extMgm::allowTableOnStandardPages('tx_stars_domain_model_rating');
$TCA['tx_stars_domain_model_rating'] = array(
	'ctrl' => array(
		'title'	=> 'LLL:EXT:stars/Resources/Private/Language/locallang_db.xlf:tx_stars_domain_model_rating',
		'label' => 'object',
		'tstamp' => 'tstamp',
		'crdate' => 'crdate',
		'cruser_id' => 'cruser_id',
		'dividers2tabs' => TRUE,

		'versioningWS' => 2,
		'versioning_followPages' => TRUE,
		'origUid' => 't3_origuid',
		'languageField' => 'sys_language_uid',
		'transOrigPointerField' => 'l10n_parent',
		'transOrigDiffSourceField' => 'l10n_diffsource',
		'delete' => 'deleted',
		'enablecolumns' => array(
			'disabled' => 'hidden',
			'starttime' => 'starttime',
			'endtime' => 'endtime',
		),
		'searchFields' => 'object,object_id,ip,vote,',
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY) . 'Configuration/TCA/Rating.php',
		'iconfile' => t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_stars_domain_model_rating.png'
	),
);


t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages', array(
		'rating' => array(
			'exclude' => 0,
			'label' => 'LLL:EXT:stars/Resources/Private/Language/locallang_db.xlf:tx_stars_domain_model_rating.vote',
			'config' => array(
				'type' => 'input',
				'size' => 30,
				'eval' => 'trim'
			),
		),
	)
);

?>