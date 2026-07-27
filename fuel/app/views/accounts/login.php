<div class="row justify-content-center mt-5">
  <div class="col-md-6 col-lg-4">

    <div class="card shadow-sm">
      <div class="card-body">

        <h2 class="text-center mb-4">ログイン</h2>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
              <?php echo e($error); ?>
            </div>
          <?php endif; ?>

        <form action="<?php echo Uri::create('accounts/login'); ?>" method="post">
        <?php echo \Form::csrf(); ?>

          <div class="mb-3">
            <label
              for="username"
              class="form-label"
            >
              ユーザー名
            </label>

            <input
              type="text"
              name="username"
              id="username"
              class="form-control"
              value="<?php echo Input::post('username'); ?>"
            >
          </div>

          <div class="mb-3">
            <label
              for="password"
              class="form-label"
            >
              パスワード
            </label>

            <input
              type="password"
              name="password"
              id="password"
              class="form-control"
            >
          </div>

          <div class="form-check mb-3">
            <label
              for="remember"
              class="form-check-label"
            >
              <input
                type="checkbox"
                name="remember"
                id="remember"
                class="form-check-input"
                <?php echo Input::post('remember') ? 'checked' : ''; ?>
              >
              ログイン状態を保持する
            </label>
          </div>

          <div class="d-grid">
            <input
              type="submit"
              value="ログイン"
              class="btn btn-primary"
            >
          </div>

        </form>
        <a href="<?php echo Uri::create('accounts/signup'); ?>" class="d-block mt-3 text-center">アカウントをお持ちでない方</a>

      </div>
    </div>

  </div>
</div>
