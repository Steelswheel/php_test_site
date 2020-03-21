<?php
session_start();
require 'script.php';
require 'exit.php';
require 'header.php';

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	$alert = "Добро пожаловать, " . $_SESSION['login'] . "!";
} else {
	$alert = 'Вы не авторизованы!';
	echo "<meta http-equiv=\"refresh\" content=\"2;URL=/auth.php\">";
}

?>
		<div class="alert"><?=$alert?></div>
    <div class="wrapper">
      <div class="gallery">
				<?php
				$link = mysqli_connect("127.0.0.1", "root", "", "test_site") or die('Ошибка соединения с БД');//Подключаемся к БД

				if (mysqli_connect_errno()) {// Проверить соединение
						printf("Попытка соединения не удалась: %s\n", mysqli_connect_error());
						exit();
				}

				$query = "SELECT `id`, `name`, `path`, `views` FROM `gallery`";

				$res = mysqli_query($link, $query);

				mysqli_fetch_assoc($res);


				foreach ($res as $key) {
					$file = $key['name'] . substr($key['path'], -4);
					if (in_array($file, $files)) {
						echo "<div class=\"col\"><img src=\"$key[path]\" alt=\"\" /><p><strong>Имя: </strong>$key[name]</p><p><a href=\"image.php?id=$key[id]\"><strong><u>Детальный просмотр</u></strong></a><p><strong>Просмотров: </strong>$key[views]</p></p></div>";
					} else {
						echo "<div class=\"no-col\">Файл не найден!</div>";
					}
				}

				mysqli_free_result($res);
				mysqli_close($link);
				?>
      </div>

        <form enctype="multipart/form-data" class="form" method="post" action="redirect.php">
					<fieldset class="fieldset">
						<div class="label"><label for="file_name">Введите название:</label></div>
						<input type="text" name="file_name" value="" class="file_name">
					</fieldset>
          <fieldset class="fieldset">
            <div class="label-wrap">
							<span class="label-text">Выберите файл</span>
							<input type="file" value="" name="inputfile" placeholder="Добавить изображение..." class="inputfile">
						</div>
            <button type="submit" name="button" class="button">Загрузить файл</button>
          </fieldset>
        </form>
      </div>
    </div>
		<script src="js/indicate.js"></script>
  </body>
</html>
