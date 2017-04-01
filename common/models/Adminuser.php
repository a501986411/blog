<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "adminuser".
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $email
 * @property string $profile
 * @property string $create_time
 */
class Adminuser extends ActiveRecord implements IdentityInterface
{
    private $_tmppassword;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'adminuser';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'nickname', 'password', 'email', 'profile'], 'required'],
            ['email', 'email'],
            ['email','unique'],
            [['profile'], 'string'],
            [['username', 'nickname', 'password'], 'string', 'max' => 128],
            ['username','unique'],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => '用户名',
            'nickname' => '昵称',
            'password' => '密码',
            'email' => '电子邮箱',
            'profile' => '描述信息',
        ];
    }

    /**
     * 保存或者修改前操作
     * @access public
     * @param bool $insert
     * @return bool
     * @author knight
     */
    public  function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($insert){
                $this->create_time = 0;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * 根据用户名获取用户
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
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
        return Yii::$app->security->validatePassword($password, $this->password);
    }


    /**
     * 加密密码
     * @access public
     * @return string
     * @author knight
     */
    public function setPassword()
    {
        $this->password =  Yii::$app->security->generatePasswordHash($this->password);
    }
    /**
     * 创建管理员
     * @access public
     * @return bool|null
     * @author knight
     */
    public function register()
    {
        if(!$this->validate()){
            return null;
        }
        $this->_tmppassword = $this->password;
        $this->setPassword();
        if($this->save()){
            return true;
        }
        $this->password = $this->_tmppassword;
        return false;
    }
}
