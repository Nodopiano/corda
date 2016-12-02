<?php

namespace Nodopiano\Corda;

use PHPMailer;

/**
 * Class Mail
 * @author yourname
 */
class Mail
{
    protected static $mail;

    public static function boot()
    {
        static::$mail = new PHPMailer;
        if (getenv('MAIL_DRIVER') == 'smtp') {
          static::$mail->isSMTP();
          static::$mail->Host = getenv('MAIL_HOST');  // Specify main and backup SMTP servers
          static::$mail->SMTPAuth = getenv('MAIL_AUTH');                               // Enable SMTP authentication
          static::$mail->Username = getenv('MAIL_USERNAME');                 // SMTP username
          static::$mail->Password = getenv('MAIL_PASSWORD');                           // SMTP password
          static::$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          static::$mail->Port = getenv('MAIL_PORT');
        }          // Set mailer to use SMTP
    }

    public static function send($rcpt, $subject, $message)
    {
        self::boot();
        static::$mail->setFrom(getevng('MAIL_FROM'));
        static::$mail->addAddress($rcpt);
        static::$mail->Subject = $subject;
        static::$mail->Body    = $message;
        if(!static::$mail->send()) {
            return 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
        } else {
            return 'Message has been sent';
        }
    }
}
