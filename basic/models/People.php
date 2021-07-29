<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "people".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $email
 * @property int $role
 *
 * @property Messages[] $messages
 * @property Roles $role0
 */
class People extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'people';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'name', 'email', 'role'], 'required'],
            [['role'], 'integer'],
            [['username', 'password', 'name', 'email'], 'string', 'max' => 255],
            [['role'], 'exist', 'skipOnError' => true, 'targetClass' => Roles::className(), 'targetAttribute' => ['role' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Имя пользователя',
            'password' => 'Пароль',
            'name' => 'Имя',
            'email' => 'Email',
            'role' => 'Роль',
        ];
    }

    /**
     * Gets query for [[Messages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMessages()
    {
        return $this->hasMany(Messages::className(), ['id_people' => 'id']);
    }

    /**
     * Gets query for [[Role0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRoles()
    {
        return $this->hasOne(Roles::className(), ['id' => 'role']);
    }
}
