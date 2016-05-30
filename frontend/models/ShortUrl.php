<?php

namespace frontend\models;

use yii\db\ActiveRecord;

/**
 * Пользовательские укороченные урлы
 * 
 * @package frontend\models
 *
 * @property integer $id
 * @property string $url
 * @property string $short_code
 */
class ShortUrl extends ActiveRecord
{
    protected $avaliableCodeChars = 
        "qazxswedcvfrtgbnhyujmkiolp1234567890QAZXSWEDCVFRTGBNHYUJMKIOLP";

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['url', 'string', 'max' => 255],
            ['short_code', 'string', 'max' => 32],
            ['url', 'required'],
            ['url', 'url', 'defaultScheme' => 'http'],
            ['url', 'validateUrl'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'url' => 'Ссылка, которую нужно укоротить',
            'short_code' => 'Код',
        ];
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'short_url';
    }
    
    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        parent::beforeSave($insert);

        if ($insert && $this->_shortUrlExists()) {
            return false;
        }

        return true;
    }

    public function validateUrl($attribute, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->$attribute);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if(empty($response) && $response == 404) {
            $this->addError($attribute, 'Недействительная ссылка');
        }
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        if($insert && empty($this->short_code)) {
            $this->short_code = $this->_createShortCode();
            $this->save();
        }
        parent::afterSave($insert, $changedAttributes);
    }
    
    protected function _shortUrlExists()
    {
        $shortUrl = ShortUrl::findOne(['url' => $this->url]);
        
        if($shortUrl && !empty($shortUrl->short_code)) {
            $this->setAttributes($shortUrl->attributes);
            return true;
        }

        return false;
    }

    /**
     * Создать короткий код для ссылки
     */
    protected function _createShortCode()
    {
        if(!$this->id) {
            return;
        }

        $code = "";
        $charsCount = strlen($this->avaliableCodeChars);
        $index = $this->id;
        while ($index > $charsCount - 1) {
            $charNumber = (int) fmod($index, $charsCount);
            $code .= $this->avaliableCodeChars[$charNumber];
            $index = (int) floor($index / $charsCount);
        }
        $code .= $this->avaliableCodeChars[$index];
        return $code;
    }
}
