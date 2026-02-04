<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pseudo = trim($_POST['pseudo']);
  $avatar = trim($_POST['avatar']);
  $color = trim($_POST['color']);
  $message = trim($_POST['message']);

  if ($pseudo && $message) {
    $_SESSION['pseudo'] = $pseudo;
    $_SESSION['avatar'] = $avatar;
    $_SESSION['color'] = $color;

    $pseudo = str_replace([';', "\n"], '', $pseudo);
    $avatar = str_replace([';', "\n"], '', $avatar);
    $color = str_replace([';', "\n"], '', $color);
    $message = str_replace(["\n", "\r"], ' ', $message);

    $time = date('H:i:s');
    $line = "$time;$pseudo;$avatar;$color;$message\n";

    file_put_contents('messages.txt', $line, FILE_APPEND);
  }
}

header('Location: index.php');
exit;