<?php
session_start();
require 'exit.php';

if (isset($_SESSION['login']) && isset($_SESSION['password'])) {
	$alert = "Добро пожаловать, " . $_SESSION['login'] . "!";
} else {
	$alert = 'Вы не авторизованы!';
	echo "<meta http-equiv=\"refresh\" content=\"2;URL=/auth.php\">";
}
require 'header.php';
?>
		<main>
			<div class="alert"><?=$alert?></div>
			<table class="info" cellspacing="0" cellpadding="7">
			<tbody>
				<tr>
					<td>Имя:</td>
					<td><?=$_SESSION['name'];?></td>
				</tr>
				<tr>
					<td>Фамилия:</td>
					<td><?=$_SESSION['lastname'];?></td>
				</tr>
			</tbody>
			</table>
		</main>
	</body>
</html>
