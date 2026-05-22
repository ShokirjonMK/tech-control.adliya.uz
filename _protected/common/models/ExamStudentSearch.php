<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExamStudent;

/**
 * ExamStudentSearch represents the model behind the search form of `common\models\ExamStudent`.
 */
class ExamStudentSearch extends ExamStudent
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'student_id', 'exam_id', 'mark', 'group_id', 'uni_id', 'fan_id', 'smester'], 'integer'],
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
        $query = ExamStudent::find();

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
            'exam_id' => $this->exam_id,
            'mark' => $this->mark,
            'group_id' => $this->group_id,
            'uni_id' => $this->uni_id,
            'fan_id' => $this->fan_id,
            'smester' => $this->smester,
        ]);

        return $dataProvider;
    }
}
