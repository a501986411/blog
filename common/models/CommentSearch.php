<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Comment;

/**
 * CommentSearch represents the model behind the search form about `common\models\Comment`.
 */
class CommentSearch extends Comment
{
    public function attributes()
    {
        return array_merge(parent::attributes(),['user.username','post.title']); //改搜索类添加关联字段属性用户搜索
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', ], 'integer'],
            [['content', 'email', 'url','post.title','user.username'], 'safe'],
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
        $query = Comment::find();
        $query->joinWith('user');
        $query->joinWith('post');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
             'pagination'=>[
                 'pageSize'=>2
             ],
            'sort'=>[
                'defaultOrder'=>[
                    'status'=>SORT_ASC,
                    'id'    =>SORT_DESC
                    ]
             ]
        ]);

        $dataProvider->sort->attributes['user.username'] = [
            'asc'=>['user.username'=>SORT_ASC],
            'desc'=>['user.username'=>SORT_DESC],
        ];
        $dataProvider->sort->attributes['post.title'] = [
            'asc'=>['post.title'=>SORT_ASC],
            'desc'=>['post.title'=>SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'comment.status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like','post.title',$this->getAttribute('post.title')])
            ->andFilterWhere(['like','user.username',$this->getAttribute('user.username')]);
        return $dataProvider;
    }
}
