<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $id_people
 * @property string $time_begin
 * @property string $text
 *
 * @property People $people
 */
class Messages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_people', 'text'], 'required'],
            [['id_people'], 'integer'],
            [['time_begin'], 'safe'],
            [['text'], 'string'],
            [['block'], 'boolean'],
            [['id_people'], 'exist', 'skipOnError' => true, 'targetClass' => People::className(), 'targetAttribute' => ['id_people' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_people' => 'Автор',
            'time_begin' => 'Дата',
            'text' => 'Текст сообщения',
            'block' => 'Блокировать',
        ];
    }

    /**
     * Gets query for [[People]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeople()
    {
        return $this->hasOne(People::className(), ['id' => 'id_people']);
    }
}
