<div class="row justify-content-center mt-5">
  <div class="col-md-6 col-lg-4">

    <div class="card shadow-sm">
      <div class="card-body">

        <h2 class="text-center mb-4">新規登録</h2>

        <?php if (!empty($error)): ?>
          <div class="alert alert-danger">
            <?php echo e($error); ?>
          </div>
        <?php endif; ?>

        <?php echo Form::open(array('method' => 'post')); ?>

          <div class="mb-3">
            <?php echo Form::label(
              'ユーザー名',
              'username',
              array('class' => 'form-label')
            ); ?>

            <?php echo Form::input(
              'username',
              Input::post('username'),
              array(
                'id' => 'username',
                'class' => 'form-control',
              )
            ); ?>
          </div>

          <div class="mb-3">
            <?php echo Form::label(
              'メールアドレス',
              'email',
              array('class' => 'form-label')
            ); ?>

            <?php echo Form::input(
              'email',
              Input::post('email'),
              array(
                'id' => 'email',
                'class' => 'form-control',
              )
            ); ?>
          </div>

          <div class="mb-3">
            <?php echo Form::label(
              'パスワード',
              'password',
              array('class' => 'form-label')
            ); ?>

            <?php echo Form::password(
              'password',
              '',
              array(
                'id' => 'password',
                'class' => 'form-control',
              )
            ); ?>
          </div>

          <div class="d-grid">
            <?php echo Form::submit(
              'submit',
              '登録',
              array('class' => 'btn btn-primary')
            ); ?>
          </div>

        <?php echo Form::close(); ?>

      </div>
    </div>

  </div>
</div>
