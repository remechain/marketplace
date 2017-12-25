<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "notice".
 *
 * @property integer $id
 * @property string $name
 *
 * @property NoticeSystem[] $noticeSystems
 */
class Notice extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
    public function getNoticeSystems()
    {
        return $this->hasMany(NoticeSystem::className(), ['id_notice' => 'id']);
    }
}
