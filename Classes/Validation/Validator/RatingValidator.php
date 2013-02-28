<?php
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2013 Daniel Lienert <daniel@lienert.cc>, Daniel Lienert
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
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

class Tx_Stars_Validation_Validator_RatingValidator {


	/**
	 * ratingRepository
	 *
	 * @var Tx_Stars_Domain_Repository_RatingRepository
	 * @inject
	 */
	protected $ratingRepository;


	/**
	 * @var int
	 */
	protected $maxUserRatings = 0;


	/**
	 * @var int
	 */
	protected $maxUserRatingsOnObject = 1;


	/**
	 * @param Tx_Stars_Domain_Model_Rating $rating
	 * @return bool
	 */
	public function isValid(Tx_Stars_Domain_Model_Rating $rating) {
		return $this->isValidByMaxUserRatingsOnObject($rating) && $this->isValidByMaxUserRatings($rating);
	}


	/**
	 * @param Tx_Stars_Domain_Model_Rating $rating
	 * @return bool
	 */
	public function isValidByMaxUserRatingsOnObject(Tx_Stars_Domain_Model_Rating $rating) {
		return $this->ratingRepository->getRatingCountForObjectAndUser($rating) < $this->maxUserRatingsOnObject ? TRUE : FALSE;
	}



	/**
	 * @param Tx_Stars_Domain_Model_Rating $rating
	 * @return bool
	 */
	public function isValidByMaxUserRatings(Tx_Stars_Domain_Model_Rating $rating) {
		return $this->ratingRepository->getRatingCountForUser($rating) < $this->maxUserRatings ? TRUE : FALSE;
	}



	/**
	 * @param int $maxUserRatings
	 */
	public function setMaxUserRatings($maxUserRatings) {
		$this->maxUserRatings = $maxUserRatings;
	}



	/**
	 * @param int $maxUserRatingsOnObject
	 */
	public function setMaxUserRatingsOnObject($maxUserRatingsOnObject) {
		$this->maxUserRatingsOnObject = $maxUserRatingsOnObject;
	}
}

?>