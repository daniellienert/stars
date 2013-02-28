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

/**
 *
 *
 * @package stars
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 */
class Tx_Stars_Domain_Repository_RatingRepository extends Tx_Yag_Domain_Repository_AbstractRepository {


	/**
	 * @param string $objectClass
	 * @param string $objectUid
	 * @return float
	 */
	public function getAverageRateByClassAndUid($objectClass, $objectUid) {

		$objectClass = str_replace('\\', '\\\\', $objectClass);

		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setReturnRawQueryResult(TRUE);

		$statement = sprintf("SELECT AVG(vote) as avgVote
						FROM %s
						WHERE object_class = '%s'
						AND object_id = %s
						GROUP by object_id", 'tx_stars_domain_model_rating', $objectClass, $objectUid);

		$result = $query->statement($statement)->execute();

		return $result[0]['avgVote'];
	}



	/**
	 * @param $objectClass
	 * @param $objectUid
	 * @return int
	 */
	public function getRatingSumByClassAndUid($objectClass, $objectUid) {
		$objectClass = str_replace('\\', '\\\\', $objectClass);

		$query = $this->createQuery();
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$query->getQuerySettings()->setReturnRawQueryResult(TRUE);

		$statement = sprintf("SELECT SUM(vote) as sumVote
						FROM %s
						WHERE object_class = '%s'
						AND object_id = %s
						GROUP by object_id", 'tx_stars_domain_model_rating', $objectClass, $objectUid);

		$result = $query->statement($statement)->execute();

		return (int) $result[0]['sumVote'];
	}



	/**
	 * @param Tx_Stars_Domain_Model_Rating $rating
	 * @return int
	 */
	public function getRatingCountForObjectAndUser(Tx_Stars_Domain_Model_Rating $rating) {
		$query = $this->createQuery();

		$query->getQuerySettings()->setStoragePageIds(array($rating->getPid()));

		$objectCount = $query->matching(
			$query->logicalAnd(
				$query->equals('objectClass', $rating->getObjectClass()),
				$query->equals('objectId', $rating->getObjectId()),
				$query->logicalOr(
					$query->equals('ip', $rating->getIp()),
					$query->equals('cookieId', $rating->getCookieId())
				)
			)

		)->execute()->count();

		return $objectCount;
	}



	/**
	 * @param Tx_Stars_Domain_Model_Rating $rating
	 * @return int
	 */
	public function getRatingCountForUser(Tx_Stars_Domain_Model_Rating $rating) {
		$query = $this->createQuery();

		$query->getQuerySettings()->setStoragePageIds(array($rating->getPid()));

		$objectCount = $query->matching(
			$query->logicalOr(
				$query->equals('ip', $rating->getIp()),
				$query->equals('cookieId', $rating->getCookieId())
			)
		)->execute()->count();

		return $objectCount;
	}
}
?>