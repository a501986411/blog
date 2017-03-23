<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['title', 'description', 'tags','author_id','update_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();
        $query->joinWith(['pStatus','author']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>[
                'pageSize'=>2
            ],
            'sort'=>[
                'defaultOrder'=>[
                    'update_time'=>SORT_DESC
                ]
            ]
        ]);
        $this->load($params);

        if (!$this->validate()) {
            // 没有符合条件的数据是 可原样返回 或者返回空数据
            // $query->where('0=1'); //返回空数据
            return $dataProvider; //原样返回
        }

        // 搜索过滤 精确查找
        $query->andFilterWhere([
            'id' => $this->id,
            'post.status' => $this->status,
            'update_time' => $this->update_time,
        ]);

        //模糊匹配
        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'tags', $this->tags])
            ->andFilterWhere(['like','user.username',$this->author_id]);
        return $dataProvider;
    }
}
