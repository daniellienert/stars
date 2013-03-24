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
class Tx_Stars_Domain_Model_Rating extends Tx_Extbase_DomainObject_AbstractEntity {

	/**
	 * object
	 *
	 * @var \string
	 */
	protected $objectClass;

	/**
	 * objectId
	 *
	 * @var \integer
	 */
	protected $objectId;

	/**
	 * ip
	 *
	 * @var \string
	 */
	protected $ip;


	/**
	 * @var \string
	 */
	protected $remoteHost;


	/**
	 * vote
	 *
	 * @var \string
	 */
	protected $vote;

	/**
	 * @var string
	 */
	protected $cookieId;



	/**
	 * @param string $objectClass
	 */
	public function setObjectClass($objectClass) {
		$this->objectClass = $objectClass;
	}

	/**
	 * @return string
	 */
	public function getObjectClass() {
		return $this->objectClass;
	}


	/**
	 * Returns the objectId
	 *
	 * @return \integer $objectId
	 */
	public function getObjectId() {
		return $this->objectId;
	}

	/**
	 * Sets the objectId
	 *
	 * @param \integer $objectId
	 * @return void
	 */
	public function setObjectId($objectId) {
		$this->objectId = $objectId;
	}

	/**
	 * Returns the ip
	 *
	 * @return \string $ip
	 */
	public function getIp() {
		return $this->ip;
	}

	/**
	 * Sets the ip
	 *
	 * @param \string $ip
	 * @return void
	 */
	public function setIp($ip) {
		$this->ip = $ip;
	}

	/**
	 * Returns the vote
	 *
	 * @return \string $vote
	 */
	public function getVote() {
		return $this->vote;
	}

	/**
	 * Sets the vote
	 *
	 * @param \string $vote
	 * @return void
	 */
	public function setVote($vote) {
		$this->vote = $vote;
	}

	/**
	 * @param string $cookieId
	 */
	public function setCookieId($cookieId) {
		$this->cookieId = $cookieId;
	}

	/**
	 * @return string
	 */
	public function getCookieId() {
		return $this->cookieId;
	}

	/**
	 * @param string $remoteHost
	 */
	public function setRemoteHost($remoteHost) {
		$this->remoteHost = $remoteHost;
	}

	/**
	 * @return string
	 */
	public function getRemoteHost() {
		return $this->remoteHost;
	}
}
?>