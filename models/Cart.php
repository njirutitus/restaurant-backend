<?php


namespace app\models;


use tn\phpmvc\utils\Filesystem;

class Cart extends \tn\phpmvc\DbModel
{
    public string $item_title = '';
    public string $price = '';
    public mixed $img = null;
    public int $quantity = 1;
    public int $id = 0;

    public function __construct()
    {
        Filesystem::$destination_folder = 'public/media';
    }

    public static function tableName(): string
    {
        return 'menu';
    }

    public function attributes(): array
    {
        return ['id','quantity','price'];
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
        'id' => [self::RULE_REQUIRED],
        'quantity' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        'price' => [self::RULE_REQUIRED,self::RULE_NUMBER],
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }
}