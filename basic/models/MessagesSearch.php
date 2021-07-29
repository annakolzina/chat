<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Messages;
use Yii;

/**
 * MessagesSearch represents the model behind the search form of `app\models\Messages`.
 */
class MessagesSearch extends Messages
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_people'], 'integer'],
            [['time_begin', 'text'], 'safe'],
            [['block'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $tab)
    {
        $people = People::find()->where(['id' => Yii::$app->user->identity->id])->one();
        if($tab==1)
            $query = Messages::find()->where(['block' => true]);
        else if($tab==null && $people->role==1)
            $query = Messages::find();
        else
            $query = Messages::find()->where(['block' => false]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC]
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'id_people' => $this->id_people,
            'time_begin' => $this->time_begin,
            'block' => $this->block,
        ]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
}
