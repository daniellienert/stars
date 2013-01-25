<?php
namespace TYPO3\Stars\ViewHelpers\Widget\Controller;


class RatingController extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetController {

	/**
	 * ratingRepository
	 *
	 * @var \TYPO3\Stars\Domain\Repository\RatingRepository
	 * @inject
	 */
	protected $ratingRepository;


	/**
	 * @return void
	 */
	public function indexAction() {
		print_r($this->widgetConfiguration);
	}


	public function voteAction() {

	}
}

?>