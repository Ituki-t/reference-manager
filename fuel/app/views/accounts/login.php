<form action="<?php echo Uri::create('accounts/login'); ?>" method="post">
    <div>
        <label for="username">ユーザー名</label>
        <input
            type="text"
            name="username"
            id="username"
            value="<?php echo Input::post('username'); ?>"
        >
    </div>
    <div>
        <label for="password">パスワード</label>
        <input
            type="password"
            name="password"
            id="password"
        >
    </div>
    <div>
        <input type="submit" value="ログイン">
    </div>
    <div>
        <label for="remember">
            <input
                type="checkbox"
                name="remember"
                id="remember"
                <?php echo Input::post('remember') ? 'checked' : ''; ?>
            >
            ログイン状態を保持する
        </label>
</form>