<?php
namespace TYPO3\Stars\Tests\ViewHelpers\Widget\Controller;
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
 * Test case for class Tx_Stars_Controller_RatingController.
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
class RatingControllerTest extends \TYPO3\CMS\Extbase\Tests\Unit\BaseTestCase {

	/**
	 * @var \TYPO3\Stars\ViewHelpers\Widget\Controller\RatingController
	 */
	protected $controllerFixture;



	public function setUp() {
		$accessibleClassName = $this->buildAccessibleProxy('TYPO3\Stars\ViewHelpers\Widget\Controller\RatingController');
		$this->controllerFixture = new $accessibleClassName();
	}

	public function tearDown() {
		unset($this->controllerFixture);
	}


	public function getRepositoryNameByModelNameDataProvider() {
		return array(
			'v4' => array(
				'modelName' => 'Tx_Yag_Domain_Model_Gallery',
				'expectedRepositoryName' => 'Tx_Yag_Domain_Repository_GalleryRepository'
			),
			'v6' => array(
				'modelName' => 'TYPO3\Stars\Domain\Model\Rating',
				'expectedRepositoryName' => 'TYPO3\Stars\Domain\Repository\RatingRepository'
			)
		);
	}


	/**
	 * @test
	 * @dataProvider getRepositoryNameByModelNameDataProvider
	 */
	public function getRepositoryNameByModelName($modelName, $expectedRepositoryName) {
		$actualRepositoryName = $this->controllerFixture->_call('getRepositoryNameByModelName', $modelName);
		$this->assertEquals($expectedRepositoryName, $actualRepositoryName);
	}

}
?>