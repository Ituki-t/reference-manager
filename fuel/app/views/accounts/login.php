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
</form>