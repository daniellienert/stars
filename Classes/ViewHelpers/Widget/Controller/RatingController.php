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
	 * @var integer
	 */
	protected $ratingStoragePid;


	public function initializeAction() {
		$this->ratingStoragePid = (int) $this->widgetConfiguration['storagePid'];
	}


	/**
	 * @return void
	 */
	public function indexAction() {

		$ratingObject = $this->widgetConfiguration['ratingObject'];

		if($ratingObject !== NULL && is_object($ratingObject)) {

			if(method_exists($ratingObject, 'getUid')) {
				$this->view->assign('ratingObjectUid', $ratingObject->getUid());
				$this->view->assign('ratingObjectClass', get_class($ratingObject));
			} else {
				$this->flashMessageContainer->add('The given object has no getUid Method.');
			}

		} else {
			$this->flashMessageContainer->add('No RatingObject given.');
		}


		$this->view->assign('starCount', $this->widgetConfiguration['starCount']);

	}



	/**
	 * @param \TYPO3\Stars\Domain\Model\Rating $rating
	 * @dontverifyrequesthash
	 */
	public function ratingAction(\TYPO3\Stars\Domain\Model\Rating $rating) {

		$rating->setVote($this->request->getArgument('rate'));
		$rating->setPid($this->ratingStoragePid);
		$this->ratingRepository->add($rating);
	}
}

?>