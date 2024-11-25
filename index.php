<?php
require_once ('translate.php');

$result = null;
$default_source = 'ja';
$default_target = 'en';

if ($_POST) {
    $result = translate(
        $_POST['text'],
        $_POST['source'],
        $_POST['target']
    );
} else {
    $_POST['source'] = $default_source;
    $_POST['target'] = $default_target;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type='text/css' rel="stylesheet" href='./css/reset.css'>
    <link type='text/css' rel="stylesheet" href='./css/style.css'>
    <title>Translation Service</title>
</head>
<body>
    <header>
        <h1>Translation Service</h1>
    </header>
    <main>
        <form method="post">
            <div class="form-group">
                <label for="text">Text to translate:</label>
                <textarea name="text" id="text" required><?= isset($_POST['text']) ? htmlspecialchars($_POST['text']) : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="source">Source Language:</label>
                <select name="source" id="source">
                    <?php foreach (SUPPORTED_LANGUAGES as $code => $name): ?>
                        <option value="<?= $code ?>" <?= (isset($_POST['source']) && $_POST['source'] === $code) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="target">Target Language:</label>
                <select name="target" id="target">
                    <?php foreach (SUPPORTED_LANGUAGES as $code => $name): ?>
                        <option value="<?= $code ?>" <?= (isset($_POST['target']) && $_POST['target'] === $code) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Translate">
            </div>
        </form>

        <?php if ($result): ?>
            <?php if (!$result['success']): ?>
                <div class="error">
                    <?= $result['message'] ?>
                </div>
            <?php else: ?>
                <div class="success">
                    <h2>Translation Result:</h2>
                    <p><?= $result['translation'] ?></p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </main>
    <footer>
        <p>© 2024 Kento.S All rights reserved.</p>
    </footer>
</body>
</html>
