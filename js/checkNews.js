document.getElementById['delete'].onclick= function() {
  if (confirm("Вы действительно хотите удалить новость?"))
  {
    alert("Запись успешно удалена");
    location.href='article.php?article=<?php$row['id_news']?>';
  }
}