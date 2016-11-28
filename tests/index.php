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
        <img src="<?= $img->avatar->src($email); ?>" alt="My Gravatar Image">
        <br>
        <p>Image generated from class</p>
        <br>
        <?= $img->avatar->img($email, 'My Gravatar Image'); ?>
        <br><br>
        Profile Info
        <?php
        $p = $img->profile->get();
        ?>
        <table>
    <tr>
        <td>Hash</td>
        <td><?= $p->hash; ?></td>
    </tr>
    <tr>
        <td>Profile URL</td>
        <td><a href="<?= $p->profileUrl; ?>" target="_blank"><?= $p->profileUrl; ?></a></td>
    </tr>
    <tr>
        <td>Username</td>
        <td><?= $p->preferredUsername; ?></td>
    </tr>
    <tr>
        <td>Pics</td>
        <td>
            <?php

            for ($i = 0; $i < 3; $i++) {
                $photos = $img->profile->convert('array', $p->photos);
                // quick break hack ;)
                if (!isset($photos[$i])) {
                    break;
                }
                echo '<img src="'.$photos[$i]->value.'"><br>';
            }

            ?>
        </td>
    </tr>
    <tr>
        <td>Name</td>
        <?php $n = $p->name; ?>
        <td>First: <?=$n->givenName?><br>Last: <?=$n->familyName?><br>Full: <?=$n->formatted?></td>
    </tr>
</table>
<?php if (isset($p->accounts)): ?>
<br>
<br>
Accounts
<br>
<?php foreach ($p->accounts as $a): ?>
    <table>
        <tr>
            <td>Domain</td>
            <td><?=$a->domain?></td>
        </tr>
        <tr>
            <td>Display</td>
            <td><?=$a->display?></td>
        </tr>
        <tr>
            <td>URL</td>
            <td><?=$a->url?></td>
        </tr>
        <tr>
            <td>User ID</td>
            <td><?php echo (isset($a->userid)) ? $a->userid : $a->username ?></td>
        </tr>
        <tr>
            <td>Verified</td>
            <td><?=$a->verified?></td>
        </tr>
        <tr>
            <td>Shortname</td>
            <td><?=$a->shortname?></td>
        </tr>
    </table>
    <br>
<?php endforeach; ?>
<?php endif; ?>
<?php if (isset($p->urls)): ?>
<br>
<br>
Accounts
<br>
<?php foreach ($p->urls as $a): ?>
    <table>
        <tr>
            <td>Value</td>
            <td><?=$a->value?></td>
        </tr>
        <tr>
            <td>Title</td>
            <td><?=$a->title?></td>
        </tr>
    </table>
    <br>
<?php endforeach; ?>
<?php endif; ?>
        <br><br>
        Full Data
        <br>
        <pre><?= print_r($img->profile->get($email)); ?></pre>
        <?php endif; ?>
    </body>
</html>
