<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2010-2012 Daniel Lienert <daniel@lienert.cc>
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

/**
 * Class implements access to pages table
 *
 * @package Domain
 * @subpackage Model
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class Tx_Stars_Domain_Model_Page extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * @var float
	 */
	protected $rating;


	/**
	 * @param int $uid
	 */
	public function setUid($uid) {
		$this->uid = $uid;
	}


	/**
	 * @param float $rating
	 */
	public function setRating($rating) {
		$this->rating = $rating;
	}


	/**
	 * @return float
	 */
	public function getRating() {
		return $this->rating;
	}
}
?>