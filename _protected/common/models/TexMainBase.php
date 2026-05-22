<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tex_main_base".
 *
 * @property int $id
 * @property int|null $tartib_raqami
 * @property string|null $uzasbo_nomi
 * @property int|null $tipi_id
 * @property string|null $parametr
 * @property string|null $bino
 * @property int|null $tarkibiy_bolinma_id
 * @property string|null $inventar_ichki
 * @property string|null $yili
 * @property int|null $holati_id
 * @property int|null $yaroqliligi_id
 * @property string|null $inventar_b
 * @property int|null $partiya
 * @property string|null $dona_narx
 * @property int|null $partiya_narx
 * @property int|null $bino_qushimcha
 * @property int|null $how_come_id
 * @property int $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class TexMainBase extends \yii\db\ActiveRecord
{
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tex_main_base';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tartib_raqami', 'tipi_id', 'tarkibiy_bolinma_id',
                'holati_id', 'yaroqliligi_id', 'partiya',
                'partiya_narx',  'how_come_id', 'who_recive_id',
                'status', 'created_by', 'updated_by'], 'integer'],
            [['building_id', 'room_id'], 'integer', 'message'=>'xona yuq'],
            [['parametr', 'parametr_full'], 'string'],
            [['yili', 'created_at', 'updated_at'], 'safe'],
            [['uzasbo_nomi', 'bino_qushimcha', 'inventar_ichki'], 'string', 'max' => 255],
            [['bino', 'inventar_b', 'dona_narx', 'biriktirilgan'], 'string', 'max' => 99],


        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tartib_raqami' => 'Tartib Raqami',
            'uzasbo_nomi' => 'Uzasbo Nomi',
            'tipi_id' => 'Tipi ID',
            'parametr' => 'Parametr',
            'parametr_full' => 'To`liq parametr',
            'bino' => 'Bino',
            'tarkibiy_bolinma_id' => 'Tarkibiy Bolinma ID',
            'inventar_ichki' => 'Inventar Ichki',
            'yili' => 'Yili',
            'biriktirilgan' => 'Biriktirilgan',
            'holati_id' => 'Holati ID',
            'yaroqliligi_id' => 'Yaroqliligi ID',
            'inventar_b' => 'Inventar B',
            'partiya' => 'Partiya',
            'dona_narx' => 'Dona Narx',
            'partiya_narx' => 'Partiya Narx',
            'bino_qushimcha' => 'Bino Qushimcha',
            'how_come_id' => 'How Come ID',
            'building_id' => 'Bino',
            'room_id' => 'Xona',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }


     public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }
    public function holati()
    {
        $holati = Holati::findOne($this->holati_id);
        return $holati;
    }
    public function how_come()
    {
        $howcome = HowCome::findOne($this->how_come_id);
        return $howcome;
    }
    public function yaroqliligi()
    {
        $yaroqliligi = Yaroqliligi::findOne($this->yaroqliligi_id);
        return $yaroqliligi;
    }
//    public function tarkibiy_bolinma()
//    {
//        $tarkibiy_bolinmaa = TarkibiyBolinma::findOne($this->tarkibiy_bolinma_id);
//        return $tarkibiy_bolinmaa;
//    }

    public function tipi()
    {
        $tipi = Tipi::findOne($this->tipi_id);
        return $tipi;
    }

    public function who_recive()
    {
        $who_reciveee = WhoRecive::findOne($this->who_recive_id);
        return $who_reciveee;
    }




     public function getHowCome()
    {
        return $this->hasOne(HowCome::className(), ['id' => 'how_come_id']);
    }


     public function getHolati()
    {
        return $this->hasOne(Holati::className(), ['id' => 'holati_id']);
    }

     public function getYaroqliligi()
    {
        return $this->hasOne(Yaroqliligi::className(), ['id' => 'yaroqliligi_id']);
    }

    public function getWhoRecive()
    {
        return $this->hasOne(WhoRecive::className(), ['id' => 'who_recive_id']);
    }

    public function getTarkibiy_bolinma()
    {
        return $this->hasOne(TarkibiyBolinma::className(), ['id' => 'tarkibiy_bolinma_id']);
    }

    public function getTarkibiyBolinma()
    {
        return $this->hasOne(TarkibiyBolinma::className(), ['id' => 'tarkibiy_bolinma_id']);
    }
    
    

     public function getTipi()
    {
        return $this->hasOne(Tipi::className(), ['id' => 'tipi_id']);
    }
     public function getStatus()
    {
        if($this->status == 1){
            return 'Faol';
        }
        elseif($this->status == 0){
            return 'Nofaol';
        }
//        return $this->hasOne(Tipi::className(), ['id' => 'tipi_id']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuilding()
    {
        return $this->hasOne(\common\models\Building::className(), ['id' => 'building_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(\common\models\Room::className(), ['id' => 'room_id']);
    }


}
