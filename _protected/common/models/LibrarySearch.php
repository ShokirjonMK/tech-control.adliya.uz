<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Library;

/**
 * LibrarySearch represents the model behind the search form of `common\models\Library`.
 */
class LibrarySearch extends Library
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nomi', 'fan_id', 'course_id', 'user_id', 'uni_id', 'status'], 'integer'],
            [['file', 'created_at'], 'safe'],
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
        $query = Library::find();

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
            'nomi' => $this->nomi,
            'fan_id' => $this->fan_id,
            'course_id' => $this->course_id,
            'user_id' => $this->user_id,
            'uni_id' => $this->uni_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'file', $this->file]);

        return $dataProvider;
    }
}
