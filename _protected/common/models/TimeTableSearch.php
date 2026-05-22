<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TimeTable;

/**
 * TimeTableSearch represents the model behind the search form of `common\models\TimeTable`.
 */
class TimeTableSearch extends TimeTable
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        [['id', 'group_id'/*, 'para_id', 'fan_id', 'xona_id', 'teacher_id'*/], 'integer'],
            [['week_day'], 'safe'],
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
    public function search($params)
    {
        $query = TimeTable::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'group_id' => $this->group_id,
          /*  'para_id' => $this->para_id,
            'fan_id' => $this->fan_id,
            'xona_id' => $this->xona_id,
            'teacher_id' => $this->teacher_id,*/
        ]);

        $query->andFilterWhere(['like', 'week_day', $this->week_day]);

        return $dataProvider;
    }
}
