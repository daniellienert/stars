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


	/**
	 * @var object
	 */
	protected $ratingObject;


	/**
	 * @var integer
	 */
	protected $ratingObjectUid;


	/**
	 * @var \TYPO3\Stars\Validation\Validator\RatingValidator
	 * @inject
	 */
	protected $ratingValidator;


	public function initializeAction() {
		$this->ratingStoragePid = (int) $this->widgetConfiguration['storagePid'];
		$this->ratingObject = $this->widgetConfiguration['ratingObject'];

		if($this->ratingObject !== NULL
			&& is_object($this->ratingObject)
			&& method_exists($this->ratingObject, 'getUid')
			&& $this->ratingObject->getUid() > 0
		) {
			$this->ratingObjectUid = $this->ratingObject->getUid();
		} else {
			Throw new \TYPO3\CMS\Extbase\Configuration\Exception('Given object is not a valid voting object');
		}
	}


	/**
	 * @return void
	 */
	public function indexAction() {

		$this->view->assignMultiple(array(
			'ratingObjectUid' => $this->ratingObject->getUid(),
			'ratingObjectClass' => get_class($this->ratingObject),
			'averageVote' => $this->ratingRepository->getAverageRateByClassAndUid(get_class($this->ratingObject), $this->ratingObjectUid),
			'starCount' => (int) $this->widgetConfiguration['starCount'],
			'widgetId' => $this->controllerContext->getRequest()->getWidgetContext()->getAjaxWidgetIdentifier()
			)
		);
	}


	/**
	 * @return string
	 */
	public function rateAction() {
		$rating = $this->createRating();

		$rating->setVote($this->request->getArgument('rate'));

		if($this->ratingValidator->isValid($rating)) {
			$this->ratingRepository->add($rating);
			$this->saveRateToObject($rating);
		}

		return '';
	}



	/**
	 * @return float
	 */
	public function getRatingInfoAction() {

		$ratingInfo = array(
			'averageRating' => $this->ratingRepository->getAverageRateByClassAndUid(get_class($this->ratingObject), $this->ratingObjectUid),
			'alreadyVoted' => !$this->ratingValidator->isValid($this->createRating())
		);

		return json_encode($ratingInfo);
	}



	/**
	 * @return \TYPO3\Stars\Domain\Model\Rating
	 */
	protected function createRating() {
		$rating = new \TYPO3\Stars\Domain\Model\Rating();
		$rating->setObject(get_class($this->ratingObject));
		$rating->setObjectId($this->ratingObjectUid);
		$rating->setPid($this->ratingStoragePid);

		$rating->setIp(\TYPO3\CMS\Core\Utility\GeneralUtility::getIndpEnv('REMOTE_ADDR'));
		$rating->setCookieId($this->getVotingCookieUid());

		return $rating;
	}


	/**
	 * @param \TYPO3\Stars\Domain\Model\Rating $rating
	 */
	protected function saveRateToObject(\TYPO3\Stars\Domain\Model\Rating $rating) {

	}


	/**
	 * @param $modelName
	 * @return mixed
	 */
	protected function getRepositoryNameByModelName($modelName) {
		$nsSeparator = strpos($modelName, '\\') !== FALSE ? '\\\\' : '_';
		return preg_replace(array('/' . $nsSeparator . 'Model' . $nsSeparator . '(?!.*' . $nsSeparator . 'Model' . $nsSeparator . ')/', '/Model/'), array($nsSeparator . 'Repository' . $nsSeparator, ''), $modelName) . 'Repository';
	}


	/**
	 * @return string
	 */
	protected function getVotingCookieUid() {
		$cookieId = $_COOKIE['typo3StarsVoting'];

		if(!$cookieId) {
			$lifeTime = time() + 60 * 60 * 24 * 365;
			$cookieId = uniqid('', TRUE);
			setcookie('typo3StarsVoting', $cookieId, $lifeTime,'/');
		}

		return $cookieId;
	}


}

?>