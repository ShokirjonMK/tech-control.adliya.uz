<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Monitoring;

/**
 * MonitoringSearch represents the model behind the search form of `common\models\Monitoring`.
 */
class MonitoringSearch extends Monitoring
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'group_id', 'faculty_id', 'direction_id', 'status', 'time_table_id', 'uni_id'], 'integer'],
            [['date'], 'safe'],
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
        $query = Monitoring::find();

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
            'student_id' => $this->student_id,
            'group_id' => $this->group_id,
            'faculty_id' => $this->faculty_id,
            'direction_id' => $this->direction_id,
            'status' => $this->status,
            'time_table_id' => $this->time_table_id,
            'date' => $this->date,
            'uni_id' => $this->uni_id,
        ]);

        return $dataProvider;
    }
}
