<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExamAnswer;

/**
 * ExamAnswerSearch represents the model behind the search form of `common\models\ExamAnswer`.
 */
class ExamAnswerSearch extends ExamAnswer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'exam_name_id', 'faculty_id', 'direction_id', 'group_id', 'fan_id', 'student_id'], 'integer'],
            [['answer_pdf', 'created_at', 'update_at', 'original_name'], 'safe'],
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
        $query = ExamAnswer::find();

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
            'exam_name_id' => $this->exam_name_id,
            'faculty_id' => $this->faculty_id,
            'direction_id' => $this->direction_id,
            'group_id' => $this->group_id,
            'fan_id' => $this->fan_id,
            'student_id' => $this->student_id,
            'created_at' => $this->created_at,
            'update_at' => $this->update_at,
            'original_name' => $this->original_name,
            
        ]);

        $query->andFilterWhere(['like', 'answer_pdf', $this->answer_pdf]);

        return $dataProvider;
    }
}
