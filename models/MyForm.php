<?php

namespace app\models;

use yii\base\Model;

class MyForm extends Model
{
    public $title;
    public $short_description;
    public $description;
    public $date;
    public $author;
    public $image;

    public function rules()
    {
        return [
            [
                [
                    'title',
                    'short_description',
                    'description',
                    'date',
                    'author',
                ],
                'required'
            ],
            ['image', 'image', 'extensions' => 'jpg, png, jpeg']
        ];
    }
}