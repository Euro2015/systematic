<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class MarketingForm extends CFormModel
{
	public $status;
	public $category;
	public $sector;
	public $body;
	public $geolocation;
    public $subject;
    public $country;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('body', 'required'),
            array('subject','required'),
			array('status,country, category, sector, geolocation', 'safe'),
			// email has to be a valid email address
			// array('email', 'email'),
			// verifyCode needs to be entered correctly
			// array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements()),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			// 'verifyCode'=>'Verification Code',
		);
	}
}