<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2013 Daniel Lienert <daniel@lienert.cc>
*
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

class Tx_Stars_ViewHelpers_RatingViewHelper extends Tx_Fluid_Core_Widget_AbstractWidgetViewHelper {

	/**
	 * @var bool
	 */
	protected $ajaxWidget = TRUE;

	/**
	 * @var Tx_Stars_ViewHelpers_Widget_Controller_RatingController
	 * @inject
	 */
	protected $controller;


	public function initializeArguments() {
		$this->registerArgument('ratingObject', 'object', 'Object to rate.', FALSE);
		$this->registerArgument('ratingObjectClass', 'string', 'Object to rate.', FALSE);
		$this->registerArgument('ratingObjectUid', 'integer', 'Object to rate.', FALSE);

		parent::initializeArguments();
	}


	public function initialize() {
		$this->convertRatingObject();
	}


	/**
	 * @param int $starCount
	 * @param int $storagePid
	 * @param bool $allowMultipleRating
	 * @return Tx_Extbase_MVC_ResponseInterface
	 */
	public function render($starCount=5, $storagePid=0, $allowMultipleRating = FALSE) {
		return $this->initiateSubRequest();
	}


	/**
	 * Sets the values RatingObjectClass / RatingObjectUid from the rating object
	 * We cannot use the object directly as it may contain closures which crashes the
	 * serialization later done by the widget.
	 */
	protected function convertRatingObject() {
		$ratingObject = $this->arguments['ratingObject'];

		if($ratingObject !== NULL
			&& is_object($ratingObject)
			&& method_exists($ratingObject, 'getUid')
			&& $ratingObject->getUid() > 0
		) {
			$this->arguments['ratingObjectUid'] = $ratingObject->getUid();
			$this->arguments['ratingObjectClass'] = get_class($ratingObject);
		}

		unset($this->arguments['ratingObject']);
	}
}

?>