<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TexMainBase;

/**
 * TexSearch represents the model behind the search form of `app\models\TexMainBase`.
 */
class TexSearch extends TexMainBase
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tartib_raqami', 'tipi_id', 'tarkibiy_bolinma_id', 'holati_id', 'yaroqliligi_id', 'partiya', 'partiya_narx', 'bino_qushimcha', 'how_come_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['uzasbo_nomi', 'parametr', 'bino', 'inventar_ichki', 'yili', 'inventar_b', 'dona_narx', 'created_at', 'updated_at'], 'safe'],
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
        $query = TexMainBase::find();

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
            'tartib_raqami' => $this->tartib_raqami,
            'tipi_id' => $this->tipi_id,
            'tarkibiy_bolinma_id' => $this->tarkibiy_bolinma_id,
            'yili' => $this->yili,
            'holati_id' => $this->holati_id,
            'yaroqliligi_id' => $this->yaroqliligi_id,
            'partiya' => $this->partiya,
            'partiya_narx' => $this->partiya_narx,
            'bino_qushimcha' => $this->bino_qushimcha,
            'how_come_id' => $this->how_come_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'uzasbo_nomi', $this->uzasbo_nomi])
            ->andFilterWhere(['like', 'parametr', $this->parametr])
            ->andFilterWhere(['like', 'bino', $this->bino])
            ->andFilterWhere(['like', 'inventar_ichki', $this->inventar_ichki])
            ->andFilterWhere(['like', 'inventar_b', $this->inventar_b])
            ->andFilterWhere(['like', 'dona_narx', $this->dona_narx]);

        return $dataProvider;
    }
}
