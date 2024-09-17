<?php
  require_once ('../phpmailer/PHPMailer.php');
  require_once ('../phpmailer/SMTP.php');
  require_once ('../phpmailer/Exception.php');
  require_once("../php/connect.php");

# проверка, что ошибки нет
if (!error_get_last()) {
    $query="select max(id_msg) as last_id_msg from feedback";
    $result=$mysqli->query($query);
    $row=$result->fetch_assoc();
    $last_id_msg=$row['last_id_msg']+1;

    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];

    // Формирование самого письма
    /* $title="Обращение из формы обратной связи #{$last_id_msg}";
    $body="
    <h2>Новое обращение</h2>
    <b>От:</b> $name<br>
    <b>Почта пользователя:</b> $email<br><br>
    <b>Текст сообщения:</b><br>$message";
      
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
    */
    // Проверяем отправленность сообщения
    /*if ($mail->send()) {
      $data['result'] = "success";
      $data['info'] = "Сообщение успешно отправлено!";
      $data['type']="main-form"; */

      $query="insert into feedback(id_msg, user_name, email, message, date) VALUES (NULL, '$name', '$email', '$message', CURDATE())";
      $mysqli->query($query);
    /*} 
    else {*/
    $query="select * from feedback where id_msg='$last_id_msg'";
    $result=$mysqli->query($query);
    if($result->num_rows>0)
    {
      $data['result'] = "success";
      $data['info'] = "Сообщение успешно отправлено!";
      $data['type']="main-form"; }
    else {
      $data['result'] = "error";
      $data['info'] = "Сообщение не было отправлено. Ошибка при отправке письма";
      $data['desc'] = "Причина ошибки: {$mail->ErrorInfo}";
    }
    /* } */
    header('Content-Type: application/json');
    echo json_encode($data);
}
?>