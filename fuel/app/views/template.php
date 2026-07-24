<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title><?php echo isset($title) ? e($title) : 'Reference Manager'; ?></title>

  <?php echo Asset::css('lib/bootstrap.min.css'); ?>

</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
    <div class="container">

      <?php echo Html::anchor('/', '参考資料管理アプリ', ['class' => 'navbar-brand']); ?>

      <div class="navbar-nav">

        <?php echo Html::anchor(
          'tasks/index',
          'タスク一覧',
          ['class' => 'nav-link']
        ); ?>

        <?php echo Html::anchor(
          'tasks/create',
          '新規投稿',
          ['class' => 'nav-link']
        ); ?>

      </div>

      <div class="ms-auto">
        <?php if (\Session::get('user_id') === null): ?>
          <?php echo Html::anchor(
            'accounts/login',
            'ログイン',
            ['class' => 'btn btn-outline-primary me-2']
          ); ?>
          <?php echo Html::anchor(
            'accounts/signup',
            'アカウント登録',
            ['class' => 'btn btn-outline-success']
          ); ?>
        <?php else: ?>
          <?php echo Html::anchor(
            'accounts/logout',
            'ログアウト',
            ['class' => 'btn btn-outline-danger']
          ); ?>
        <?php endif; ?>
      </div>

    </div>
  </nav>

  <div class="container mt-4">
    <?php echo $content; ?>
  </div>

  <?php echo Asset::js('lib/bootstrap.bundle.min.js'); ?>
  <?php echo Asset::js('lib/knockout-3.5.3.js'); ?>

</body>
</html>
