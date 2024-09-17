<?php
        if (isset($_POST['create']))
        {
          $query="select * from news where id_news='{$_POST['id_news']}'";
          $result=$mysqli->query($query);
          if($result->num_rows>0)
          {
            $data['result']="already done";
            header('Content-Type: application/json');
            echo json_encode($data);
          }
          else
          {
            move_uploaded_file($_FILES['photo']['tmp_name'],"Image/news/{$id_news}.jpg");
            $query="insert into news(id_news, title, subtitle, article, date) VALUES ({$_POST['id_news']}, '{$_POST['title']}','{$_POST['subtitle']}','{$_POST['article']}',CURDATE())";
            $mysqli->query($query);
            if ($mysqli->affected_rows>0)
            {
              ?><script>
              alert("Новость успешно добавлена");
              location.href='news.php';
              </script><?php
            }
          }
        }