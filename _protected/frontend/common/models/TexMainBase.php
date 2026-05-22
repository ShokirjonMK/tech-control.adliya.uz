<?php

namespace app\common\models;

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
            [['tartib_raqami', 'tipi_id', 'tarkibiy_bolinma_id', 'holati_id', 'yaroqliligi_id', 'partiya', 'partiya_narx', 'bino_qushimcha', 'how_come_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['parametr'], 'string'],
            [['yili', 'created_at', 'updated_at'], 'safe'],
            [['uzasbo_nomi', 'inventar_ichki'], 'string', 'max' => 255],
            [['bino', 'inventar_b', 'dona_narx'], 'string', 'max' => 99],
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
            'bino' => 'Bino',
            'tarkibiy_bolinma_id' => 'Tarkibiy Bolinma ID',
            'inventar_ichki' => 'Inventar Ichki',
            'yili' => 'Yili',
            'holati_id' => 'Holati ID',
            'yaroqliligi_id' => 'Yaroqliligi ID',
            'inventar_b' => 'Inventar B',
            'partiya' => 'Partiya',
            'dona_narx' => 'Dona Narx',
            'partiya_narx' => 'Partiya Narx',
            'bino_qushimcha' => 'Bino Qushimcha',
            'how_come_id' => 'How Come ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }
}
