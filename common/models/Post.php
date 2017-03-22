<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property string $title
 * @property string $description
 * @property string $content
 * @property string $tags
 * @property integer $status
 * @property integer $create_time
 * @property integer $update_time
 * @property integer $author_id
 */
class Post extends \yii\db\ActiveRecord
{
    private $_oldTag;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags', 'status','author_id'], 'required'],
            [['description'], 'string', 'max' => 255],
            [['content', 'tags'], 'string'],
            [['status','author_id'], 'integer'],
            [['title'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'title'       => '标题',
            'description' => '文章描述',
            'content'     => '文章内容',
            'tags'        => '标签',
            'status'      => '状态',
            'create_time' => '创建时间',
            'update_time' => '修改时间',
            'author_id'   => '作者',
            'pStatus.name'=>'状态',
            'author.username'=>'作者'

        ];
    }

    /**
     * 获取文章状态
     * @access public
     * @return \yii\db\ActiveQuery
     * @author knight
     */
    public function getPStatus()
    {
        // 文章和状态通过 poststatus.id -> status关联建立一对一关系
        return $this->hasOne(Poststatus::className(), ['id' => 'status']);
    }

    /**
     * 建立文章与作者之间的关系（一对一）
     * @access public
     * @return \yii\db\ActiveQuery
     * @author knight
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @access public
     * @return void
     * @author knight
     */
    public function afterFind()
    {
        parent::afterFind();
        $this->_oldTag = $this->tags;
    }


    /**
     * 保存后置方法
     * @access public
     * @return void
     * @author knight
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        Tag::updateFrequency($this->_oldTag, $this->tags);
    }

    /**
     * 保存前操作
     * @access public
     * @param bool $insert
     * @return void
     * @author knight
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) { //插入数据
                $this->create_time = time();
            }
            $this->update_time = time();
            return true;
        } else {
            return false;
        }
    }

    /**
     * 删除后置方法
     * @access public
     * @return void
     * @author knight
     */
    public function afterDelete()
    {
        parent::afterDelete();
        Tag::updateFrequency($this->_oldTag, '');
    }

    /**
     * get方法设置新增文章状态
     * @access public
     * @return void
     * @author knight
     */
    public function getAllStatus()
    {
        $list = (new \yii\db\Query())
            ->select(['name', 'id'])
            ->from('poststatus')
            ->indexBy('id')
            ->column();
        return $list;
    }

    public function getAllAuthor()
    {
        return (new \yii\db\Query())
                ->select(['username','id'])
                ->from('user')
                ->indexBy('id')
                ->column();
    }
}
