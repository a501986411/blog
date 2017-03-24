<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $create_time
 * @property integer $userid
 * @property string $email
 * @property string $url
 * @property integer $post_id
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'status', 'create_time', 'userid', 'email', 'url', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'userid', 'post_id'], 'integer'],
            [['email', 'url'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => '评论内容',
            'status' => '状态',
            'create_time' => '评论时间',
            'userid' => '用户',
            'email' => '邮箱',
            'url' => 'Url',
            'post_id' => '文章',
        ];
    }

    /**
     * 建立评论与评论状态的关联关系
     * @access public
     * @return \yii\db\ActiveQuery
     * @author knight
     */
    public function getCStatus()
    {
        return $this->hasOne(CommentStatus::className(),['id'=>'status']);
    }

    public function getPost()
    {
        return $this->hasOne(Post::className(),['id'=>'post_id']);
    }

    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userid']);
    }
}
