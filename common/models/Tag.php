<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tag".
 *
 * @property integer $id
 * @property string $name
 * @property integer $frequency
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'frequency'], 'required'],
            [['frequency'], 'integer'],
            [['name'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'frequency' => 'Frequency',
        ];
    }

    /**
     * 字符串标签转数组
     * @access public
     * @param $tag
     * @return array
     * @author knight
     */
    public static function string2array($tag)
    {
        return explode(',',$tag);
    }

    /**
     * 标签数组转字符串
     * @access public
     * @param $tag
     * @return string
     * @author knight
     */
    public static function array2string($tag)
    {
        return implode(',',$tag);
    }

    /**
     * 新增标签
     * @access public
     * @param $tags
     * @return bool
     * @author knight
     */
    public static  function addTags($tags){
        if(empty($tags)) return;
        foreach($tags as $name){
            $aTagCount = Tag::find()->where(['name'=>$name])->count();
            if(!$aTagCount){ //不存在新增
                $tag = new Tag();
                $tag->name = $name;
                $tag->frequency = 1;
                $tag->save();
            } else { // 存在 次数+1
                 $aTag = Tag::find()->where(['name'=>$name])->one();
                 $aTag->frequency += 1;
                 $aTag->save();
            }
        }
    }

    /**
     * 删除Tag操作
     * @access public
     * @param $tags
     * @return bool
     * @author knight
     */
    public static function removeTags($tags){
        if(empty($tags))  return true;
        foreach($tags as $name){
            $aTagCount = Tag::find()->where(['name'=>$name])->count();
            if($aTagCount){
                $aTag = Tag::find()->where(['name'=>$name])->one();
                if($aTag->frequency<=1){
                    $aTag->delete();
                }
                else {
                    $aTag->frequency -= 1;
                    $aTag->save();
                }
            }
        }
     }



    /**
     * 修改标签出现次数
     * @access public
     * @param $oldTag
     * @param $newTag
     * @return void
     * @author knight
     */
    public static function updateFrequency($oldTag,$newTag)
    {
        if(!empty($oldTag) || !empty($newTag)){
            $oldTag = self::string2array($oldTag);
            $newTag = self::string2array($newTag);
            $addTagArray = array_values(array_diff($newTag,$oldTag));
            $removeTagArray = array_values(array_diff($oldTag,$newTag));
            self::addTags($addTagArray);
            self::removeTags($removeTagArray);
        }
    }

}
