<?php

    require 'vendor/autoload.php';
    require 'config.php';
    
    use Qd\Qdmail;

    $mail = new Qdmail();

    $mail->errorDisplay(false);
    $mail->smtp(true);

    $param = [
        'host'     => MAIL_HOST,
        'port'     => MAIL_PORT,
        'from'     => MAIL_FROM,
        'protocol' => MAIL_PROTOCOL,
        'user'     => MAIL_USER,
        'pass'     => MAIL_PASS
    ];
    $mail->smtpServer($param);

    $mail->to(MAIL_TO);
    $mail->from(MAIL_FROM);
    $mail->subject('subject');
    $mail->text('text');

    echo ($mail->send()) ? "mail send OK" : "mail send NG";
