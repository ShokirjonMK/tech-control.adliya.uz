<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\FinalWork;

/**
 * FinalWorkSearch represents the model behind the search form of `common\models\FinalWork`.
 */
class FinalWorkSearch extends FinalWork
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'group_id', 'smester', 'fan_id', 'teacher_id', 'student_id', 'status', 'ball'], 'integer'],
            [['name', 'qr_code', 'created_at', 'updated_at', 'created_date', 'updated_date', 'answer_pdf', 'description'], 'safe'],
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
        $query = FinalWork::find();

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
            'smester' => $this->smester,
            'fan_id' => $this->fan_id,
            'teacher_id' => $this->teacher_id,
            'student_id' => $this->student_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_date' => $this->created_date,
            'updated_date' => $this->updated_date,
            'ball' => $this->ball,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'qr_code', $this->qr_code])
            ->andFilterWhere(['like', 'answer_pdf', $this->answer_pdf])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
