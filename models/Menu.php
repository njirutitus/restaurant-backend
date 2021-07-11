<?php


namespace app\models;


class Menu extends \tn\phpmvc\DbModel
{
    public string $item_title = '';
    public string $price = '';
    public string $desc = '';
    public string $item_category = '';
    public string $img = '';

    public static function tableName(): string
    {
        return 'menu';
    }

    public function attributes(): array
    {
        return ['item_title','item_category','price','img','desc'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function labels(): array
    {
        return [
            'item_title' => 'Meal Name',
            'item_category' => 'Category',
            'price' => 'Price',
            'img' => 'Meal Cover Image',
            'desc' => 'Description',
        ];
    }

    public function rules(): array
    {
        return [
        'item_title' => [self::RULE_REQUIRED],
        'item_category' => [self::RULE_REQUIRED],
        'price' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        'img' => [self::RULE_REQUIRED],
        'desc' => [self::RULE_REQUIRED],
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }

    public function fetchAll()
    {
        return parent::findAll();
    }
}