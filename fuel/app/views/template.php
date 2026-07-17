<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? e($title) : 'Reference Manager'; ?></title>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>