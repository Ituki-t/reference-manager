<?php echo Form::open(array('method' => 'post')); ?>
    <div>
        <?php echo Form::label('ユーザー名', 'username'); ?>
        <?php echo Form::input('username', Input::post('username'), array('id' => 'username')); ?>
    </div>
    <div>
        <?php echo Form::label('メールアドレス', 'email'); ?>
        <?php echo Form::input('email', Input::post('email'), array('id' => 'email')); ?>
    </div>
    <div>
        <?php echo Form::label('パスワード', 'password'); ?>
        <?php echo Form::password('password', '', array('id' => 'password')); ?>
    </div>
    <div>
        <?php echo Form::submit('submit', '登録'); ?>
    </div>
<?php echo Form::close(); ?>