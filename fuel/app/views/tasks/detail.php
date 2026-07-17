<div>
    <h2><?php echo $task['title']; ?></h2>
    <p><?php echo $task['description']; ?></p>
    <p>status: <?php echo $task['status']; ?></p>
    <p>開発場所: <?php echo $task['dev_location']; ?></p>
    <p>締切日: <?php echo $task['deadline']; ?></p>
<p>作成者: <?php echo $task['username']; ?></p>
</div>
<a href="<?php echo \Uri::create('tasks/update/' . $task['id']); ?>">編集</a>
<form action="<?php echo \Uri::create('tasks/delete/' . $task['id']); ?>"
    method="post"
    onsubmit="return confirm('本当に削除しますか？');">
    <input type="submit" value="削除">
</form>