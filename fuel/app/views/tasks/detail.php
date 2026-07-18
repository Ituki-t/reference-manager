<div>
    <h2><?php echo e($task['title']); ?></h2>
    <p><?php echo e($task['description']); ?></p>
    <p>status: <?php echo e($task['status']); ?></p>
    <p>開発場所: <?php echo e($task['dev_location']); ?></p>
    <p>締切日: <?php echo e($task['deadline']); ?></p>
<p>作成者: <?php echo e($task['username']); ?></p>
</div>
<a href="<?php echo \Uri::create('tasks/update/' . $task['id']); ?>">編集</a>
<form action="<?php echo \Uri::create('tasks/delete/' . $task['id']); ?>"
    method="post"
    onsubmit="return confirm('本当に削除しますか？');">
    <input type="submit" value="削除">
</form>

<div>
    <h3>参考資料一覧</h3>
    <?php if (empty($reference_items)): ?>
        <p>参考資料はありません。</p>
    <?php else: ?>
        <ul>
            <?php foreach ($reference_items as $item): ?>
                <li>
                    <a href="<?php echo e($item['url']); ?>" target="_blank">
                        <?php echo e($item['title']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>