<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php
    $id = substr($_SERVER['REQUEST_URI'], -1);

    $link = mysqli_connect("127.0.0.1", "root", "", "test_site") or die('Ошибка соединения с БД');//Подключаемся к БД

    if (mysqli_connect_errno()) {// Проверить соединение
        printf("Попытка соединения не удалась: %s\n", mysqli_connect_error());
        exit();
    }

    $query = "SELECT `views`, `path` FROM `gallery` WHERE `id` = ?";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'i', $id);

    mysqli_stmt_execute($stmt);//Запустить запрос

    mysqli_stmt_bind_result($stmt, $a, $b);

    mysqli_stmt_fetch($stmt);

    echo "<img src=\"$b\" alt=\"\">";

    $a++;

    mysqli_stmt_close($stmt);

    $query = "UPDATE `gallery` SET `views` = ? WHERE `id` = ?";

    $stmt = mysqli_prepare($link, $query);

    mysqli_stmt_bind_param($stmt, 'ii', $a, $id);

    mysqli_stmt_execute($stmt);//Запустить запрос

    ?>
  </body>
</html>
