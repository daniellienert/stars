<?php
namespace TYPO3\Stars\ViewHelpers;


class RatingViewHelper extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetViewHelper {

	/**
	 * @var bool
	 */
	protected $ajaxWidget = TRUE;

	/**
	 * @var \TYPO3\Stars\ViewHelpers\Widget\Controller\RatingController
	 * @inject
	 */
	protected $controller;


	/**
	 * @param object $ratingObject
	 * @param int $starCount
	 * @param int $storagePid
	 * @return \TYPO3\CMS\Extbase\Mvc\ResponseInterface
	 */
	public function render($ratingObject, $starCount=5, $storagePid=0) {
		return $this->initiateSubRequest();
	}
}

?>