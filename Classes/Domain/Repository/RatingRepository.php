<?php
namespace TYPO3\Stars\Domain\Repository;

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
class RatingRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {


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
						WHERE object = '%s'
						AND object_id = %s
						GROUP by object_id", 'tx_stars_domain_model_rating', $objectClass, $objectUid);

		$result = $query->statement($statement)->execute();

		return $result[0]['avgVote'];
	}


	/**
	 * @param \TYPO3\Stars\Domain\Model\Rating $rating
	 * @return bool
	 */
	public function ratingExists(\TYPO3\Stars\Domain\Model\Rating $rating) {
		$query = $this->createQuery();

		$query->getQuerySettings()->setStoragePageIds(array($rating->getPid()));

		$objectCount = $query->matching(
			$query->logicalAnd(
				$query->equals('object', $rating->getObject()),
				$query->equals('objectId', $rating->getObjectId()),
				$query->logicalOr(
					$query->equals('ip', $rating->getIp()),
					$query->equals('cookieId', $rating->getCookieId())
				)
			)

		)->count();

		return $objectCount > 0 ? TRUE : FALSE;
	}

}
?>