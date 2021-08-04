<?php


namespace app\models;


use tn\phpmvc\Application;
use tn\phpmvc\db\Model;
use tn\phpmvc\DbModel;
use tn\phpmvc\utils\Mailer;

class ContactForm extends DbModel
{
    public string $subject = '';
    public string $email = '';
    public string $name = '';
    public string $body = '';

    public static function tableName(): string
    {
        return 'contact';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRED],
            'name' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED,self::RULE_EMAIL],
            'body' => [self::RULE_REQUIRED],
        ];
    }

    public function  attributes(): array
    {
        return ['subject','name','email','body'];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Enter your subject',
            'name' => 'Your name',
            'email' => 'Your email',
            'body' => 'Body'
        ];
    }

    public function add(): bool
    {
        return parent::save();
    }

    public function send(): bool
    {
        $mail = Application::$app->mailer;
        $mail->to(array(array('email'=>"titokym96@gmail.com",'name'=>"Titus Kim")));
        $mail->replyTo(array(array('email'=>$this->email,'name' => $this->name)));
        $mail->from(array('email'=>'royalkinginvest@gmail.com','name' => 'Royal King Investment'));
        $mail->subject($this->subject);
        $mail->body($this->body);
        $mail->html(true);

        return $mail->send();


    }

}