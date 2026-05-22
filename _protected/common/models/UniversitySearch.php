<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\University;

/**
 * UniversitySearch represents the model behind the search form of `common\models\University`.
 */
class UniversitySearch extends University
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'bank_hisob', 'INN', 'number', 'mfo'], 'integer'],
            [['name', 'bank_name', 'bank_adress', 'shartnoma', 'status'], 'safe'],
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
        $query = University::find();

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
            'bank_hisob' => $this->bank_hisob,
            'INN' => $this->INN,
            'number' => $this->number,
            'mfo' => $this->mfo,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name])
            ->andFilterWhere(['like', 'bank_adress', $this->bank_adress])
            ->andFilterWhere(['like', 'shartnoma', $this->shartnoma])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
