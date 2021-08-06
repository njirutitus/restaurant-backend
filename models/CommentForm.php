<?php


namespace app\models;


class CommentForm extends \tn\phpmvc\DbModel
{
    public string $comment = '';
    public int $menu = 0;
    public int $author = 0;



    public static function tableName(): string
    {
        return 'comment';
    }

    public function attributes(): array
    {
        return ['comment','menu','author'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'comment' => [self::RULE_REQUIRED],
            'menu' => [self::RULE_REQUIRED,[self::RULE_EXISTS,'col' => 'id','class' => Menu::class]],
            'author' => [self::RULE_REQUIRED,[self::RULE_EXISTS,'col' => 'id','class' => User::class]],
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }

    public function fetchAll($where)
    {
        return parent::findMany($where);
    }
}