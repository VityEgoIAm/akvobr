<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $id
 * @property string|null $surname
 * @property string $name
 * @property string|null $patronymic
 * @property string|null $birth_date
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $img_url
 * @property int $user_id
 *
 * @property User $user
 */
class UserInfo extends \yii\db\ActiveRecord
{
    public $image;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{user_info}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id'], 'required'],
            [['birth_date'], 'safe'],
            [['created_at', 'updated_at', 'user_id'], 'integer'],
            [['surname', 'patronymic', 'img_url'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 64],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['image'], 'file', 'maxSize'=>'100000'],
            [['birth_date'], 'date', 'format' => 'yyyy-M-d'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилие',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
            'birth_date' => 'Дата рождения',
            'created_at' => 'Дата создания записи',
            'updated_at' => 'Дата обновления записи',
            'img_url' => 'Изображение',
            'image' => 'Изображение',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function getPreview()
    {
        if (!empty($this->img_url))
            return "<img src='$this->img_url' width='auto' height='100%'>";

        return "";
    }
}
