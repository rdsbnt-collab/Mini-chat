<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Mini-Chat</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <h1>Mini-Chat 2</h1>

  <div class="chat-box">
    <?php
    if (file_exists('messages.txt')) {
      $lines = array_reverse(file('messages.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));
      if (count($lines) === 0) {
        echo "<p class='empty'>Aucun message pour le moment…</p>";
      } else {
        foreach ($lines as $line) {
          list($time, $pseudo, $avatar, $color, $message) = explode(';', $line);
          echo "<div class='message'>";
          echo "<img src='" . htmlspecialchars($avatar ?: 'https://i.pravatar.cc/45') . "' class='avatar' alt='avatar'>";
          echo "<div class='content'>";
          echo "<span class='pseudo' style='color:$color;'>" . htmlspecialchars($pseudo) . "</span>";
          echo "<span class='time'>[$time]</span>";
          echo "<p class='texte'>" . htmlspecialchars($message) . "</p>";
          echo "</div></div>";
        }
      }
    } else {
      echo "<p class='empty'>Aucun message pour le moment…</p>";
    }
    ?>
  </div>

  <form action="chat.php" method="post" class="chat-form">
    <input type="text" name="pseudo" placeholder="Pseudo" required
      value="<?php echo htmlspecialchars($_SESSION['pseudo'] ?? ''); ?>">

    <input type="url" name="avatar" placeholder="URL de votre avatar (facultatif)"
      value="<?php echo htmlspecialchars($_SESSION['avatar'] ?? ''); ?>">

    <input type="color" name="color"
      value="<?php echo htmlspecialchars($_SESSION['color'] ?? '#000000'); ?>">

    <input type="text" name="message" placeholder="Votre message..." required>

    <button type="submit">Envoyer</button>
  </form>

</body>
</html>