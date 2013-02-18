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
 * Test case for class \TYPO3\Stars\Domain\Model\Rating.
 *
 * @version $Id$
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @package TYPO3
 * @subpackage Stars
 *
 * @author Daniel Lienert <daniel@lienert.cc>
 */
class RatingTest extends Tx_Extbase_BaseTestCase {
	/**
	 * @var Tx_Stars_Domain_Model_Rating
	 */
	protected $fixture;

	public function setUp() {
		$this->fixture = new Tx_Stars_Domain_Model_Rating();
	}

	public function tearDown() {
		unset($this->fixture);
	}

	/**
	 * @test
	 */
	public function getObjectReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setObjectForStringSetsObject() { 
		$this->fixture->setObjectClassName('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getObjectClassName()
		);
	}
	

	/**
	 * @test
	 */
	public function setObjectIdForIntegerSetsObjectId() { 
		$this->fixture->setObjectId(12);

		$this->assertSame(
			12,
			$this->fixture->getObjectId()
		);
	}
	
	/**
	 * @test
	 */
	public function getIpReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setIpForStringSetsIp() { 
		$this->fixture->setIp('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getIp()
		);
	}
	
	/**
	 * @test
	 */
	public function getVoteReturnsInitialValueForString() { }

	/**
	 * @test
	 */
	public function setVoteForStringSetsVote() { 
		$this->fixture->setVote('Conceived at T3CON10');

		$this->assertSame(
			'Conceived at T3CON10',
			$this->fixture->getVote()
		);
	}
	
}
?>