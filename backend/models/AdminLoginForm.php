<?php
  namespace backend\models;
	/**
	 *
	 * Created by PhpStorm.
	 * User: knight
	 * Date: 2017/4/1
	 * Time: 15:02
	 */
  	use Yii;
	use yii\base\Model;
	use common\models\Adminuser;
	class AdminLoginForm extends Model
	{
		public $username;
		public $password;
		public $rememberMe = true;

		private $_user;

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				[['username', 'password'], 'required'],
				['rememberMe', 'boolean'],
				['password', 'validatePassword'],
			];
		}

		public function attributeLabels()
		{
			return [
				'username'=>'用户名',
				'password'=>'密码',
				'rememberMe'=>'记住密码'
			];
		}

		public function validatePassword($attribute,$params)
		{
			if(!$this->hasErrors()){
				$user = $this->getUser();
				if(!$user || !$user->validatePassword($this->password)){
					$this->addError($attribute,'用户名或者密码错误');
				}
			}
		}

		/**
		 * 登录操作
		 * @access public
		 * @return bool
		 * @author knight
		 */
		public function login()
		{
			if($this->validate()){ //验证
				return Yii::$app->user->login($this->getUser(),$this->rememberMe ? 3600 * 24* 30 : 0);
			} else {
				return false;
			}
		}

		/**
		 * 根据用户名获取用户信息
		 * @access public
		 * @return mixed
		 * @author knight
		 */
		protected function getUser()
		{
			if($this->_user === null){
				$this->_user = Adminuser::findByUsername($this->username);
			}
			return $this->_user;
		}
	}