<?php
header("Refresh: 0; url=$_SERVER[HTTP_REFERER]");
require 'script.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

  if ($_FILES['inputfile']['error'] == 0 && $_FILES['inputfile']['type'] == 'image/jpeg') {
    $file_name = $_POST['file_name'];
    $destiation_dir = $dir . '/' . $file_name . substr($_FILES['inputfile']['name'], -4);
    if (move_uploaded_file($_FILES['inputfile']['tmp_name'], $destiation_dir)) {
      echo "Изображение загружено!";

      $link = mysqli_connect("127.0.0.1", "root", "", "test_site") or die('Ошибка соединения с БД');//Подключаемся к БД

    	if (mysqli_connect_errno()) {// Проверить соединение
    			printf("Попытка соединения не удалась: %s\n", mysqli_connect_error());
    			exit();
    	}

      $query = "INSERT INTO `gallery` (`name`, `path`) VALUES (?, ?)";

      if ($stmt = mysqli_prepare($link, $query)) {

    			mysqli_stmt_bind_param($stmt, 'ss', $file_name, $destiation_dir);

    			mysqli_stmt_execute($stmt);//Запустить запрос

    			mysqli_stmt_close($stmt);

          mysqli_close($link);
    		} else {
          echo "Не удалось создать запрос";
          echo mysqli_stmt_error($stmt);
        }
    	}  else {
        echo "Изображение не загружено!";
      }
  } else {
    switch ($_FILES['inputfile']['error']) {
      case UPLOAD_ERR_NO_FILE:
        echo 'Файл не загружен!';
        break;
      default:
        echo 'Что-то пошло не так';
    }
  }
} else {
  echo "Введите данные!";
  var_dump($_POST);
}
?>
