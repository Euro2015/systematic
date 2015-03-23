<?php

class TransactionController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','RequestPayment','paypalreturn','paypalcancel','RequestWithdraw'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new UserFinancialTransaction;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserFinancialTransaction']))
		{
			$model->attributes=$_POST['UserFinancialTransaction'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['UserFinancialTransaction']))
		{
			$model->attributes=$_POST['UserFinancialTransaction'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		/*$dataProvider=new CActiveDataProvider('UserFinancialTransaction');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));*/
		
		$user = new User;
		$userData =User::model()->findByPk(Yii::app()->user->getId());

		$account_balance = new AccountBalance();
		$accountData = Yii::app()->db->createCommand()
							->select("*")
							->from('drg_account_balance')
							->where('user_id='.Yii::app()->user->getId().'')
							->queryAll();
		
		
		$list = Yii::app()->db->createCommand()
							->select("*")
							->from('drg_user_financial_transaction')
							->order('date DESC')
							->where('user_id='.Yii::app()->user->getId().'')
							->queryAll();


		$this->render('index',array(
			'dataProvider'=>$list,
			'model'=>$userData,
			'accountBalance'=>$accountData
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new UserFinancialTransaction('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['UserFinancialTransaction']))
			$model->attributes=$_GET['UserFinancialTransaction'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return UserFinancialTransaction the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=UserFinancialTransaction::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param UserFinancialTransaction $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-financial-transaction-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionRequestPayment()
      {

          $e=new ExpressCheckout;
		  
		  $user = new User;
		  $userData =User::model()->findByPk(Yii::app()->user->getId());

          $currencymodel = new Currency();
          $currenyCode=Currency::model()->getCurrencyCode($userData['drg_currency']);


		  $add_fund = Yii::app()->request->getParam('addFunds');

          $products=array(
 
                '0'=>array(
                      'NAME'=>'Financial Add Fund Transactions',
                      'AMOUNT'=>$add_fund,
                      'QTY'=>'1'
                      ),
                );
                         /*Optional */
                   $shipping_address=array(
 
            'FIRST_NAME'=>$userData['drg_name'],
            'LAST_NAME'=>$userData['drg_surname'],
            'EMAIL'=>$userData['drg_email'],
            'MOB'=>$userData['drg_phone'],
            'ADDRESS'=>$userData['drg_addr1'], 
            /*'SHIPTOSTREET'=>'mannarkkad',*/
           /* 'SHIPTOCITY'=>'palakkad',*/
            'SHIPTOSTATE'=>$userData['drg_town'],
            'SHIPTOCOUNTRYCODE'=>$userData['drg_country'],
            'SHIPTOZIP'=>$userData['drg_zip']
                                          ); 
 
            $e->setShippingInfo($shipping_address); // set Shipping info Optional
            $x = new ECurrencyConverter();
            $x->currencyConverter();

			
            $e->setCurrencyCode($currenyCode);//set Currency (USD,HKD,GBP,EUR,JPY,CAD,AUD)
 
            $e->setProducts($products); /* Set array of products*/
 
           // $e->setShippingCost(5.5);/* Set Shipping cost(Optional) */
 
 
            $e->returnURL=Yii::app()->createAbsoluteUrl("managefinancials/transaction/paypalreturn");
 
            $e->cancelURL=Yii::app()->createAbsoluteUrl("managefinancials/transaction/paypalcancel");
 
            $result=$e->requestPayment(); 
            
            /*  The response format from paypal for a payment request
            Array
			(
				[TOKEN] => EC-9G810112EL503081W
				[TIMESTAMP] => 2013-12-12T10:29:35Z
				[CORRELATIONID] => 67da94aea08c3
				[ACK] => Success
				[VERSION] => 65.1
				[BUILD] => 8725992
			)
                */

        if(strtoupper($result["ACK"])=="SUCCESS")
          {
              /*redirect to the paypal gateway with the given token */
            header("location:".$e->PAYPAL_URL.$result["TOKEN"]);
          } 
         }          
 
        public function actionPaypalReturn()
        {
         $e=new ExpressCheckout;
         $paymentDetails=$e->getPaymentDetails($_REQUEST['token']);
            $x = new ECurrencyConverter();
            $x->currencyConverter();
            $user = new User;
            $userData =User::model()->findByPk(Yii::app()->user->getId());
            $currencymodel = new Currency();
            $currenyCode=Currency::model()->getCurrencyCode($userData['drg_currency']);
		  if($paymentDetails['ACK']=="Success")
            {
            $ack=$e->doPayment($paymentDetails);  //2.Do payment
             //   $lastTransaction = (UserFinancialTransaction::model()->lastTransactionCode()!="") ? UserFinancialTransaction::model()->lastTransactionCode(): $currenyCode;
				/*echo "<pre>";
				print_r($ack);
				echo "</pre>"; */
				$transaction_id = $ack['TRANSACTIONID'];
				$type = 'cr';
				$description = 'Paypal';
				$pay_in = $ack['AMT'];
				$transaction_code = $ack['CURRENCYCODE'];
				$account_balance = new AccountBalance();
				$accountData = Yii::app()->db->createCommand()
							->select("*")
							->from('drg_account_balance')
							->where('user_id='.Yii::app()->user->getId().'')
							->queryAll();
							
				$accountBalance =$x->convert($accountData[0]['account_balance'],$accountData[0]['currency_code'],$currenyCode);
							
				if(count($accountData) ==0){
				
				$balance = $accountBalance + $pay_in;
					$useraccountbalance = Yii::app()->db->createCommand()
					->insert('drg_account_balance', array(
						'user_id'=>Yii::app()->user->getId(),
						'account_balance'=>$balance,
                        'currency_code'=>$transaction_code
					));	
				}
				else
				{
					$balance = $accountBalance + $pay_in;
					$update = Yii::app()->db->createCommand()
					->update('drg_account_balance', 
						array(
							'account_balance'=>new CDbExpression($balance),
                            'currency_code'=>$transaction_code
						),
						'user_id=:user_id',
						array(':user_id'=>Yii::app()->user->getId())
					);
				
				}

                $usertransaction = Yii::app()->db->createCommand()
                    ->insert('drg_user_financial_transaction', array(
                        'user_id'=>Yii::app()->user->getId(),
                        'type'=>$type,
                        'date' =>date('Y-m-d %H:%i:%s'),
                        'transactionId'=>$transaction_id,
                        'description' => $description,
                        'paid_out' => '',
                        'paid_in' => $pay_in,
                        'balance'=>$balance,
                        'withdraw_status' =>0,
						'trans_currency_code' => $transaction_code
                    ));
            }

            $template =  MailTemplate::getTemplate('Add_Fund_Notice_Transaction');

            $string = array(
                '{{#USERNAME#}}' =>$userData['drg_username'],
                '{{#FULLNAME#}}' =>$userData['drg_name'].''.$userData['drg_surname'],
                '{{#USEREMAIL#}}' => $userData['drg_email'],
                '{{#TYPEOFTRANSACTION#}}' => 'Credit to user financial account',
                '{{#TRANSACTIONREF#}}' => $ack['TRANSACTIONID'],
                '{{#BANK#}}' => 'Paypal',
                '{{#AMOUNTRECEIVED#}}'=>Yii::app()->numberFormatter->formatCurrency($ack['AMT'], $ack['CURRENCYCODE'])
              );

            $body = SharedFunctions::app()->mailStringReplace($template->template_body,$string);

            $result =  SharedFunctions::app()->sendmail(Yii::app()->params['company_account_email'],$template->template_subject,$body);
			$this->redirect("index");
        }
        public function actionPaypalCancel()
        {  
           /*The user flow  wil come here when a user cancels the payment */
           /*Do what you want*/  
			$this->redirect("index");
        }
		
		public function actionRequestWithdraw()
		{
			$user = new User;
		    $userData =User::model()->findByPk(Yii::app()->user->getId());
            $b = new ECurrencyConverter();
            $b->currencyConverter();
            $currencymodel = new Currency();
            $currenyCode=Currency::model()->getCurrencyCode($userData['drg_currency']);
			
			$withDrawAmount =   $_POST['withdrawAmount'];
            $template =  MailTemplate::getTemplate('Withdraw_Admin_Notice_Transaction');
		//	$template =  MailTemplate::model()->findByAttributes(array('template_id'=>114));

			//$activelink = '<a href="'.Yii::app()->createAbsoluteUrl('/admin/banner/banner/view',array('bannerid'=>$model->banner_id)).'" target="_blank" >here </a>';
		   
			$string = array(
				/*'{{#HERE#}}'=>$activelink,*/
				'{{#USERNAME#}}' =>$userData['drg_name'].''.$userData['drg_surname'],
				'{{#WITHDRAWAMOUNT#}}' => $currenyCode . ' ' .$withDrawAmount
			);  
			
			$body = SharedFunctions::app()->mailStringReplace($template->template_body,$string); 
				   
			//$result =  SharedFunctions::app()->sendmail(Yii::app()->params['company_account_email'],$template->template_subject,Yii::app()->params['company_cc_mail'],$body);
            $result = SharedFunctions::app()->sendmail(Yii::app()->params['company_account_email'],$template->template_subject,$body,false,Yii::app()->params['company_cc_mail'],$userData['drg_email']);
			$date = date('Y-m-d');
			$type = 'db';
			$description = 'Account withdrawal (Pending authorization)';
			$paid_out = $withDrawAmount;
			$paid_in = '';
            $transaction_code =$currenyCode ;
			
			
			/*$log=new UserFinancialTransaction;
			$log->user_id = Yii::app()->user->getId();
			$log->date = date('Y-m-d');
			$log->type = $type;
			$log->description = $description;
			$log->paid_out = $paid_out;
			$log->paid_in = '';
			$log->withdraw_status =1;
			$log->save();*/
         //   $lastTransaction = (UserFinancialTransaction::model()->lastTransactionCode()!="") ? UserFinancialTransaction::model()->lastTransactionCode(): $currenyCode;
			$account_balance = new AccountBalance();
				$accountData = Yii::app()->db->createCommand()
							->select("*")
							->from('drg_account_balance')
							->where('user_id='.Yii::app()->user->getId().'')
							->queryAll();
							
				$accountBalance = $b->convert($accountData[0]['account_balance'],$accountData[0]['currency_code'],$currenyCode);
							
				if(count($accountData) ==0){
				
				$balance = $accountBalance - $paid_out;
					$useraccountbalance = Yii::app()->db->createCommand()
					->insert('drg_account_balance', array(
						'user_id'=>Yii::app()->user->getId(),
						'account_balance'=>new CDbExpression($balance),
                        'currency_code'=>$transaction_code
					));	
				}
				else
				{
					$balance = $accountBalance - $paid_out;
					$update = Yii::app()->db->createCommand()
					->update('drg_account_balance', 
						array(
							'account_balance'=>new CDbExpression($balance),
                            'currency_code'=>$transaction_code
						),
						'user_id=:user_id',
						array(':user_id'=>Yii::app()->user->getId())
					);
				
				}
				

				$usertransaction = Yii::app()->db->createCommand()
				 ->insert('drg_user_financial_transaction', array(
					'user_id'=>Yii::app()->user->getId(),
					'type'=>$type,
					'date' =>date('Y-m-d %H:%i:%s'),
					'description' => $description,
					'paid_out' => $paid_out,
					'paid_in' => '',
					'withdraw_status' =>1,
					'balance'=>$balance,
					'trans_currency_code' => $transaction_code
				));

			/*$update = Yii::app()->db->createCommand()
				->update('drg_user_financial_transaction', 
					array(
						'user_id' => Yii::app()->user->getId(),
						'date'=>new CDbExpression($date),
						'type'=>new CDbExpression('type=:type', array(':type'=>$type)),
						'description'=>new CDbExpression($description),
						'paid_out'=>new CDbExpression($paid_out),
						'paid_in'=>new CDbExpression($paid_in),
						
					),
					'id=:id',
					array(':id'=>Yii::app()->user->getId())
				);*/
			
			if($result):
				echo $status = 1;
			endif;
		}
}
