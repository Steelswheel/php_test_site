<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?=ucfirst(substr($_SERVER['PHP_SELF'], 1, -4));?></title>
    <link rel="stylesheet" type="text/css" href="css/<?php if (isset($_SESSION['style'])) {echo $_SESSION['style'];} else {echo "red";}; echo substr($_SERVER['PHP_SELF'], 0, -3) . "css";?>">
  </head>
  <body>
	<header>
			<nav class="menu">
				<ul class="nav-bar">
					<li><div><a href="main.php">Личная страница</a></div></li>
					<li><div><a href="gallery.php">Галерея</a></div></li>
					<li><div><a href="settings.php">Настройки</a></div></li>
					<li><div><a href="<?php echo $_SERVER['PHP_SELF'] . '?do=exit'?>">Выйти</a></div></li>
				</ul>
			</nav>
		</header>
