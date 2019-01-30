<?php
/**
 * Created by PhpStorm.
 * User: olia
 * Date: 27.01.19
 * Time: 22:49
 */
namespace app\models;

use yii\db\ActiveRecord;

class Articles extends ActiveRecord
{
    public static function tableName()
    {
        return 'articles';
    }
}
