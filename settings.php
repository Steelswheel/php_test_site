<?php
session_start();
require 'exit.php';

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	$alert = "Добро пожаловать, " . $_SESSION['login'] . "!";
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$_SESSION['style'] = $_POST['style'];
	}
} else {
	$alert = 'Вы не авторизованы!';
	echo "<meta http-equiv=\"refresh\" content=\"2;URL=/auth.php\">";
}
require 'header.php';
?>
		<div class="alert"><?=$alert?></div>
		<main>
			<form action="" method="post" class="style-form" name="style-form">
			<fieldset class="fieldset fieldset__style">
				<div class="label-wrap"><label for="style">Выберите стиль:</label></div>
				<select class="select" name="style">
					<option value="red">Красный</option>
					<option value="blue">Синий</option>
					<option value="grey">Серый</option>
				</select>
			</fieldset>
			<button type="submit" class="button">Применить</button>
		</form>
		</main>
	</body>
</html>
