<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ExamPermission;

/**
 * ExamPermissionSearch represents the model behind the search form of `common\models\ExamPermission`.
 */
class ExamPermissionSearch extends ExamPermission
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'faculty_id', 'direction_id', 'group_id', 'fan_id', 'exam_id', 'exam_name_id', 'course_number_id', 'status'], 'integer'],
            [['start_date', 'finish_date'], 'safe'],
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
        $query = ExamPermission::find();

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
            'faculty_id' => $this->faculty_id,
            'direction_id' => $this->direction_id,
            'group_id' => $this->group_id,
            'fan_id' => $this->fan_id,
            'exam_id' => $this->exam_id,
            'start_date' => $this->start_date,
            'finish_date' => $this->finish_date,
            'exam_name_id' => $this->exam_name_id,
            'course_number_id' => $this->course_number_id,
            'status' => $this->status,
        ]);

        return $dataProvider;
    }
}
