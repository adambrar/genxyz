<?php
/**
 * Text input field with validation for correct email format
 * according to RFC 2822.
 * 
 * @package forms
 * @subpackage fields-formattedinput
 */
class EmailField extends TextField {

	public function Type() {
		return 'email text';
	}

	public function getAttributes() {
		return array_merge(
			parent::getAttributes(),
			array(
				'type' => 'email'
			)
		);
	}

	/**
	 * Validates for RFC 2822 compliant email adresses.
	 * 
	 * @see http://www.regular-expressions.info/email.html
	 * @see http://www.ietf.org/rfc/rfc2822.txt
	 * 
	 * @param Validator $validator
	 * @return String
	 */
	public function validate($validator) {
		$this->value = trim($this->value);

		$pcrePattern = '^[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*'
			. '@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$';

		// PHP uses forward slash (/) to delimit start/end of pattern, so it must be escaped
		$pregSafePattern = str_replace('/', '\\/', $pcrePattern);

		if($this->value && !preg_match('/' . $pregSafePattern . '/i', $this->value)){
			$validator->validationError(
				$this->name,
				_t('EmailField.VALIDATION', "Please enter an email address"),
				"validation"
			);
            Session::set('SessionMessage', 'Please enter a valid email address.');
            Session::set('SessionMessageContext', 'danger');
			return false;
		} else{
			return true;
		}
	}

}
