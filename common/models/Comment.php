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

    /**
     * 获取评论对应的文章
     * @access public
     * @return \yii\db\ActiveQuery
     * @author knight
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(),['id'=>'post_id']);
    }

    /**
     * 获取评论创建用户
     * @access public
     * @return \yii\db\ActiveQuery
     * @author knight
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'userid']);
    }

    /**
     * 截取评论内容
     * @access public
     * @return string
     * @author knight
     */
    public function getBeginning(){
        $content = strip_tags($this->content);//去掉文章中的html标签
        $contentLen = mb_strlen($content);
        return mb_substr($content,0,10,'utf-8').(($contentLen>10)? '...':'');
    }

    /**
     * 评论审核操作
     * @access public
     * @return bool
     * @author knight
     */
    public function approve()
    {
        $this->status = 2;
        return ($this->save() ? true : false);
    }

    /**
     * 获取未审核评论
     * @access public
     * @return void
     * @author knight、
     */
    public static  function getPengdingCommentCount()
    {
        return Comment::find()->where(['status'=>1])->count();
    }
}
