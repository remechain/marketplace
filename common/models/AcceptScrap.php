<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "accept_scrap".
 *
 * @property integer $id
 * @property string $prise
 * @property integer $clogging
 * @property double $min_weight
 * @property integer $id_category_scrap_gost
 *
 * @property CategoryScrapGost $idCategoryScrapGost
 * @property ObjectAcceptScrap[] $objectAcceptScraps
 */
class AcceptScrap extends \yii\db\ActiveRecord
{
    public $schedule = [];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'accept_scrap';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['prise', 'min_weight'], 'number'],
            [['clogging', 'id_category_scrap_gost'], 'integer'],
            [['id_category_scrap_gost'], 'exist', 'skipOnError' => true, 'targetClass' => CategoryScrapGost::className(), 'targetAttribute' => ['id_category_scrap_gost' => 'id']],

            [['schedule'],'each','rule' => ['array']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prise' => 'Prise',
            'clogging' => 'Clogging',
            'min_weight' => 'Min Weight',
            'id_category_scrap_gost' => 'Id Category Scrap Gost',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdCategoryScrapGost()
    {
        return $this->hasOne(CategoryScrapGost::className(), ['id' => 'id_category_scrap_gost']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getObjectAcceptScraps()
    {
        return $this->hasMany(ObjectAcceptScrap::className(), ['id_accept_scrap' => 'id']);
    }
}
