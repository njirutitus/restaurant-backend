<?php


namespace app\models;


class Menu extends \tn\phpmvc\DbModel
{
    public string $title = '';
    public string $price = '';
    public string $desc = '';
    public string $category = '';
    public string $img = '';

    public static function tableName(): string
    {
        return 'menu';
    }

    public function attributes(): array
    {
        return ['title','price','desc','category','img'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function labels(): array
    {
        return [
            'title' => 'Meal Name',
            'price' => 'Price',
            'desc' => 'Description',
            'category' => 'Category',
            'img' => 'img'
        ];
    }

    public function rules(): array
    {
        return [
        'title' => [self::RULE_REQUIRED],
        'price' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        'desc' => [self::RULE_REQUIRED],
        'category' => [self::RULE_REQUIRED],
        'img' => [self::RULE_REQUIRED],
        ];
    }

    public function add() {
        return parent::save();
    }
}