<?php

namespace app\models;

use yii\base\Model;

class CommentsForm extends Model
{
    public $text;
    public $name;
    public $article_id;

    public function rules()
    {
        return [
            [
                [
                    'text',
                    'name',
                ],
                'required'
            ]
        ];
    }
}