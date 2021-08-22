<?php


namespace app\models;

use tn\phpmvc\Application;
use tn\phpmvc\DbModel;
use tn\phpmvc\utils\Mailer;
use tn\phpmvc\View;

/**
 * Class User
 * @package app\models
 */
class PasswordResetForm extends DbModel
{

    public string $email = '';

    public static function tableName(): string
    {
        return 'user';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL,[self::RULE_EXISTS,'class' =>self::class]]
        ];
    }

    public function  attributes(): array
    {
        return ['email'];
    }

    public function  labels(): array
    {
        return [
            'email' => 'Email'
        ];
    }

    public function send($url): bool
    {
        $view = new View();
        $content = $view->renderView('password',['url'=>$url]);
        $mail = Application::$app->mailer;
        $mail->to(array(array('email'=>$this->email)));
        $mail->replyTo(array(array('email'=>'royalkinginvest@gmail.com','name' => 'Royal King Investment')));
        $mail->from(array('email'=>'royalkinginvest@gmail.com','name' => 'Royal King Investment'));
        $mail->subject('Password Reset');
        $mail->body($content);
        $mail->html(true);
        ob_start();
        return $mail->send();

    }
}