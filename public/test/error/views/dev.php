<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ошибка</title>
</head>
<body>
    <h1>Произошла ошибка</h1>
    <? if (array_key_exists($errno, $errors)): ?>
        <p><b>Тип ошибки:</b> <?= $errors[$errno] ?></p>
    <? else: ?>
        <p><b>Тип ошибки:</b> <?= $errno ?></p>
    <? endif ?>
    <p><b>Текст ошибки:</b> <?= $errstr ?></p>
    <p><b>Файл, в котором произошла ошибка:</b> <?= $errfile ?></p>
    <p><b>Строка, в которой произошла ошибка:</b> <?= $errline ?></p>
</body>
</html>