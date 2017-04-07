<?php
	namespace common\models;

	use Yii;
	use yii\base\NotSupportedException;
	use yii\behaviors\TimestampBehavior;
	use yii\db\ActiveRecord;
	use yii\web\IdentityInterface;

	/**
	 * User model
	 *
	 * @property integer $id
	 * @property string $username
	 * @property string $password_hash
	 * @property string $password_reset_token
	 * @property string $email
	 * @property string $auth_key
	 * @property integer $status
	 * @property integer $created_at
	 * @property integer $updated_at
	 * @property string $password write-only password
	 */
	class User extends ActiveRecord implements IdentityInterface
	{
		const STATUS_DELETED = 0;
		const STATUS_ACTIVE = 10;


		/**
		 * @inheritdoc
		 */
		public static function tableName()
		{
			return '{{%user}}';
		}


		/**
		 * @inheritdoc
		 */
		public function attributeLabels()
		{
			return [
				'id'         => 'ID',
				'username'   => '用户名',
				'email'      => '邮箱',
				'status'     => '状态',
				'tags'       => '标签',
				'created_at' => '创建地址',
			];
		}

		/**
		 * @inheritdoc
		 */
		public function behaviors()
		{
			return [
				TimestampBehavior::className(),
			];
		}

		/**
		 * @inheritdoc
		 */
		public function rules()
		{
			return [
				['status', 'default', 'value' => self::STATUS_ACTIVE],
				['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
				['username','required']
			];
		}

		/**
		 * 根据指定的用户ID查找 认证模型类的实例，当你需要使用session来维持登录状态的时候会用到这个方法。
		 */
		public static function findIdentity($id)
		{
			return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
		}

		/**
		 * 根据指定的存取令牌查找 认证模型类的实例，
		 * 该方法用于 通过单个加密令牌认证用户的时候（比如无状态的RESTful应用）。
		 */
		public static function findIdentityByAccessToken($token, $type = null)
		{
			throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
		}

		/**
		 * Finds user by username
		 *
		 * @param string $username
		 * @return static|null
		 */
		public static function findByUsername($username)
		{
			return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
		}

		/**
		 * Finds user by password reset token
		 *
		 * @param string $token password reset token
		 * @return static|null
		 */
		public static function findByPasswordResetToken($token)
		{
			if (!static::isPasswordResetTokenValid($token)) {
				return null;
			}

			return static::findOne([
				'password_reset_token' => $token,
				'status'               => self::STATUS_ACTIVE,
			]);
		}

		/**
		 * Finds out if password reset token is valid
		 *
		 * @param string $token password reset token
		 * @return bool
		 */
		public static function isPasswordResetTokenValid($token)
		{
			if (empty($token)) {
				return false;
			}

			$timestamp = (int)substr($token, strrpos($token, '_') + 1);
			$expire    = Yii::$app->params['user.passwordResetTokenExpire'];
			return $timestamp + $expire >= time();
		}

		/**
		 * 获取该认证实例表示的用户的ID。
		 */
		public function getId()
		{
			return $this->getPrimaryKey();
		}

		/**
		 * 获取基于 cookie 登录时使用的认证密钥。
		 * 认证密钥储存在 cookie 里并且将来会与
		 * 服务端的版本进行比较以确保 cookie的有效性。
		 */
		public function getAuthKey()
		{
			return $this->auth_key;
		}

		/**
		 * 是基于 cookie 登录密钥的 验证的逻辑的实现
		 */
		public function validateAuthKey($authKey)
		{
			return $this->getAuthKey() === $authKey;
		}

		/**
		 * 验证密码
		 * @param string $password 用户输入的密码
		 * @return bool true/false
		 */
		public function validatePassword($password)
		{
			return Yii::$app->security->validatePassword($password, $this->password_hash);
		}

		/**
		 * Generates password hash from password and sets it to the model
		 *
		 * @param string $password
		 */
		public function setPassword($password)
		{
			$this->password_hash = Yii::$app->security->generatePasswordHash($password);
		}

		/**
		 * Generates "remember me" authentication key
		 */
		public function generateAuthKey()
		{
			$this->auth_key = Yii::$app->security->generateRandomString();
		}

		/**
		 * Generates new password reset token
		 */
		public function generatePasswordResetToken()
		{
			$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
		}

		/**
		 * Removes password reset token
		 */
		public function removePasswordResetToken()
		{
			$this->password_reset_token = null;
		}

		/**
		 * 获取用户状态数组
		 */
		public function getStatus()
		{
			return [0=>'已删除',10=>'正常'];
		}
	}
