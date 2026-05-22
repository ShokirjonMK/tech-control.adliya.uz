<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Darsjadval;

/**
 * DarsjadvalSearch represents the model behind the search form of `common\models\Darsjadval`.
 */
class DarsjadvalSearch extends Darsjadval
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'time_table_id', 'para_id', 'fan_id', 'xona_id', 'teacher_id'], 'integer'],
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
        $query = Darsjadval::find();

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
            'time_table_id' => $this->time_table_id,
            'para_id' => $this->para_id,
            'fan_id' => $this->fan_id,
            'xona_id' => $this->xona_id,
            'teacher_id' => $this->teacher_id,
        ]);

        return $dataProvider;
    }
}
