<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? e($title) : 'Reference Manager'; ?></title>
    <?php echo Asset::js('lib/knockout-3.5.3.js'); ?>
</head>
<body>
    <?php echo $content; ?>
</body>
</html>
