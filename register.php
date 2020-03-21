<?php
session_start();
$login = htmlentities(trim($_POST['login']));
$password = htmlentities(trim($_POST['password']));
$name = htmlentities(trim($_POST['name']));
$lastname = htmlentities(trim($_POST['lastname']));

if (isset($_SESSION['login'])) {
	echo "<meta http-equiv=\"refresh\" content=\"0;URL=/main.php\">";
}

if (!empty($login) && !empty($password) && !empty($name) && !empty($lastname)) {

	$link = mysqli_connect("localhost", "root", "", "test_site") or die('Ошибка соединения с БД');

	/* Проверить соединение */
	if (mysqli_connect_errno()) {
			printf("Попытка соединения не удалась: %s\n", mysqli_connect_error());
			exit();
	}

	$query = "SELECT login FROM users WHERE login = ?";

	if ($stmt = mysqli_prepare($link, $query)) {

			mysqli_stmt_bind_param($stmt, 's', $login);

			/* Запустить запрос */
			mysqli_stmt_execute($stmt);

			/* Определить переменные для результата */
			mysqli_stmt_bind_result($stmt, $log);

			/* Выбрать значения */
			if (mysqli_stmt_fetch($stmt)) {
				$alert = "Такой логин существует!";
				mysqli_stmt_close($stmt);
				echo "<meta http-equiv=\"refresh\" content=\"2;URL=/register.php\">";
			} else {
				mysqli_stmt_close($stmt);
				$query = "INSERT INTO users (login, password, name, lastname) VALUES (?, ?, ?, ?)";
					if ($asas = mysqli_prepare($link, $query)) {

						mysqli_stmt_bind_param($asas, 'ssss', $login, $password, $name, $lastname);

						/* Запустить запрос */
						mysqli_stmt_execute($asas);

						$alert = "Успешная регистрация!";
						echo "<meta http-equiv=\"refresh\" content=\"2;URL=/auth.php\">";
					}
				}
	mysqli_close($link);
}

} else {
	$alert = 'Введите данные';
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>
	<?=substr($_SERVER['PHP_SELF'], 0, -4);?>
	</title>
<link rel="stylesheet" type="text/css" href="css/<?php if (isset($_SESSION['style'])) {echo $_SESSION['style'];} else {echo "red";}; echo substr($_SERVER['PHP_SELF'], 0, -3) . "css";?>">
</head>
	<body>
		<div class="alert"><?=$alert?></div>
		<form action="" method="post" class="form">
			<fieldset class="fieldset fieldset__login">
				<div class="label-wrap"><label for="login">Введите логин:</label></div>
				<input name="login" type="text" class="login form__login">
			</fieldset>
			<fieldset class="fieldset fieldset__password">
				<div class="label-wrap"><label for="password">Введите пароль:</label></div>
				<input name="password" type="text" class="password form__password">
			</fieldset>
			<fieldset class="fieldset fieldset__personal-data">
				<div class="label-wrap"><label for="name">Ваше имя:</label></div>
				<input name="name" type="text" class="name form__name">
				<div class="label-wrap"><label for="lastname">Ваша фамилия:</label></div>
				<input name="lastname" type="text" class="lastname form__lastname">
			</fieldset>
			<button type="submit" class="button">Регистрация</button>
		</form>
	</body>
</html>
