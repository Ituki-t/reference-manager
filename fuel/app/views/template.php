<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($title) ? e($title) : 'Reference Manager'; ?></title>

    <?php echo Asset::css('lib/bootstrap.min.css'); ?>

</head>
<body>
    <?php echo $content; ?>

    <?php echo Asset::js('lib/bootstrap.bundle.min.js'); ?>
    <?php echo Asset::js('lib/knockout-3.5.3.js'); ?>

</body>
</html>
