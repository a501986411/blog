<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "adminuser".
 *
 * @property integer $id
 * @property string $username
 * @property string $nickname
 * @property string $password
 * @property string $email
 * @property string $profile
 */
class Adminuser extends \yii\db\ActiveRecord
{
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
            [['profile'], 'string'],
            [['username', 'nickname', 'password', 'email'], 'string', 'max' => 128],
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
}
