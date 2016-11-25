<?php

$config = require_once __DIR__.'/../config.php';
$d = $config['defaults'];

use Pazuzu156\Gravatar\Gravatar;

$success = '';
$email = '';
$img = null;

if (isset($_POST['email'])) {
    $email = trim($_POST['email']);
    $success = 'Valid Email. You should see your Gravatar image now!';
    $img = new Gravatar($d['size'], $config['secure']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Gravatar Test Page</title>
</head>
    <body>
        <?php

        if (!empty($success)) {
            echo $success.'<br>';
        }

        ?>
        <form method="post" action="./" autocomplete="off">
            <label for="email">Email Address:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>">
            <input type="submit" name="submit" value="Get Gravatar">
        </form>
        <br>
        <?php if (!is_null($img)): ?>
        <p>Image using &lt;img&gt; tag</p>
        <br>
        <img src="<?= $img->src('klein.jae@gmail.com'); ?>" alt="My Gravatar Image">
        <br>
        <p>Image generated from class</p>
        <br>
        <?= $img->img('klein.jae@gmail.com', 'My Gravatar Image'); ?>
        <?php endif; ?>
    </body>
</html>
