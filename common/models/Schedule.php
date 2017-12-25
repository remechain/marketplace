<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property integer $id_object
 * @property integer $id_day
 * @property string $time_begin
 * @property string $time_end
 *
 * @property Day $idDay
 * @property Object $idObject
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_object', 'id_day'], 'required'],
            [['id_object', 'id_day'], 'integer'],
            [['time_begin', 'time_end'], 'safe'],
            [['id_day'], 'exist', 'skipOnError' => true, 'targetClass' => Day::className(), 'targetAttribute' => ['id_day' => 'id']],
            [['id_object'], 'exist', 'skipOnError' => true, 'targetClass' => Object::className(), 'targetAttribute' => ['id_object' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_object' => 'Id Object',
            'id_day' => 'Id Day',
            'time_begin' => 'Time Begin',
            'time_end' => 'Time End',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDay()
    {
        return $this->hasOne(Day::className(), ['id' => 'id_day']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdObject()
    {
        return $this->hasOne(Object::className(), ['id' => 'id_object']);
    }

    static function setWeekdays($weekdays, $id_object ,$timeBegin, $timeEnd)
    {
        Schedule::deleteAll(['id_object' => $id_object]);

        if ($weekdays != '') {

            foreach ($weekdays as $id_day) {

                $objectWeekdays = new Schedule();
                $objectWeekdays->id_object = $id_object;
                $objectWeekdays->id_day = $id_day;
                $objectWeekdays->time_begin = $timeBegin;
                $objectWeekdays->time_end = $timeEnd;
                if (!$objectWeekdays->save()) {

                    return false;
                }
            }
        }
        return true;
    }

    static function setWeekend($weekend, $id_object ,$timeBegin, $timeEnd)
    {
        Schedule::deleteAll(['id_object' => $id_object]);

        if ($weekend != '') {

            foreach ($weekend as $id_day) {

                $objectWeekdays = new Schedule();
                $objectWeekdays->id_object = $id_object;
                $objectWeekdays->id_day = $id_day;
                $objectWeekdays->time_begin = $timeBegin;
                $objectWeekdays->time_end = $timeEnd;
                if (!$objectWeekdays->save()) {

                    return false;
                }
            }
        }
        return true;
    }
}
