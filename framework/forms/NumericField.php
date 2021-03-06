<?php

/**
 * Text input field with validation for numeric values. Supports validating
 * the numeric value as to the {@link i18n::get_locale()} value.
 * 
 * @package forms
 * @subpackage fields-formattedinput
 */
class NumericField extends TextField {

	public function Type() {
		return 'numeric text';
	}

	public function validate($validator) {
		if(!$this->value && !$validator->fieldIsRequired($this->name)) {
			return true;
		}
		
		require_once THIRDPARTY_PATH."/Zend/Locale/Format.php";

		$valid = Zend_Locale_Format::isNumber(
			trim($this->value), 
			array('locale' => i18n::get_locale())
		);

		if(!$valid) {
			$validator->validationError(
				$this->name,
				_t(
					'NumericField.VALIDATION', "'{value}' is not a number, only numbers can be accepted for this field",
					array('value' => $this->value)
				),
				"validation"
			);
            Session::set('SessionMessage', 'You entered an incorrect value. Only numbers are accepted.');
            Session::set('SessionMessageContext', 'danger');
			return false;
		}
		
		return true;
	}
	
	public function dataValue() {
		return (is_numeric($this->value)) ? $this->value : 0;
	}
	
	/**
	 * Returns a readonly version of this field
	 */
	public function performReadonlyTransformation() {
		$field = new NumericField_Readonly($this->name, $this->title, $this->value);
		$field->setForm($this->form);
		return $field;
	}

}

class NumericField_Readonly extends ReadonlyField {

	public function performReadonlyTransformation() {
		return clone $this;
	}

	public function Value() {
		return Convert::raw2xml($this->value ? "$this->value" : "0");
	}

}
