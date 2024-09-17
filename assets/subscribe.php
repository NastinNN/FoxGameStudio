<?php
  require_once ('../phpmailer/PHPMailer.php');
  require_once ('../phpmailer/SMTP.php');
  require_once ('../phpmailer/Exception.php');
  require_once("../php/connect.php");

// проверка, что ошибки нет
if (!error_get_last()) {

  $query="select * from mailing where email='{$_POST['sub-email']}'";
  $result=$mysqli->query($query);
  if($result->num_rows>0)
  {
    $data['result'] = "already done";
    header('Content-Type: application/json');
    echo json_encode($data);
  }
  else
  {
    $email=$_POST['sub-email'];

    // Формирование самого письма
    /* $title="Подписка на рассылку";
    $body="
    <b>Почта пользователя:</b> $email<br>
    ";
      
    // Настройки PHPMailer
    $mail=new PHPMailer\PHPMailer\PHPMailer();
    
    $mail->isSMTP();   
    $mail->CharSet="UTF-8";
    $mail->SMTPAuth=true;
    $mail->Debugoutput=function($str, $level) {$GLOBALS['data']['debug'][]=$str;};
    
    // Настройки вашей почты
    $mail->Host='smtp.rambler.ru'; // SMTP сервера вашей почты
    $mail->Username='foxgame.studio@rambler.ru'; // Логин на почте
    $mail->Password='*******'; // Пароль на почте
    $mail->SMTPSecure='ssl';
    $mail->Port=465;
    $mail->setFrom('foxgame.studio@rambler.ru'); // Адрес самой почты и имя отправителя
    
    // Получатель письма
    $mail->addAddress('foxgame.studio@rambler.ru');  

    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject=$title;
    $mail->Body=$body;    
    
    // Проверяем отправленность сообщения
    if ($mail->send()) {
      $data['result'] = "success";
      $data['info'] = "Сообщение успешно отправлено!";
      $data['type']="sub-form"; */

      $query="insert into mailing(id_email, email) VALUES (NULL, '$email')";
      $mysqli->query($query);
    /*} 
    else {*/
    $query="select * from mailing where email='{$_POST['sub-email']}'";
    $result=$mysqli->query($query);
    if($result->num_rows>0)
    {
      $data['result'] = "success";
      $data['info'] = "Сообщение успешно отправлено!";
      $data['type']="sub-form"; }
    else {
      $data['result'] = "error";
      $data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
      $data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
    }
    header('Content-Type: application/json');
    echo json_encode($data);
  }
}
?>