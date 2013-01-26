<?php
namespace TYPO3\Stars\Validation\Validator;


class RatingValidator {


	/**
	 * ratingRepository
	 *
	 * @var \TYPO3\Stars\Domain\Repository\RatingRepository
	 * @inject
	 */
	protected $ratingRepository;


	public function isValid(\TYPO3\Stars\Domain\Model\Rating $rating) {

		if($this->ratingRepository->ratingExists($rating) === FALSE) {
			return TRUE;
		} else {
			return FALSE;
		}

	}




}

?>