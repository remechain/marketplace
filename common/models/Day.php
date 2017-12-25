<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "day".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Schedule[] $schedules
 */
class Day extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'day';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['id_day' => 'id']);
    }

    static function getWeekendMap()
    {
        return ArrayHelper::map(Day::find()->where( 'id > :id', ['id' => '5'])->all(),'id','name');
    }

    static function getWeekdayMap()
    {
        return ArrayHelper::map(Day::find()->where('id < :id', ['id' => '6'])->all(),'id','name');
    }

}
