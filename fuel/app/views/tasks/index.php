<a href="<?php echo \Uri::create('/tasks/create'); ?>">新しいタスクを作成</a>
<?php if (empty($tasks)): ?>
    <p>タスクはありません。</p>
<?php else: ?>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <a href="<?php echo \Uri::create('/tasks/detail/' . $task['id']); ?>">
                    <strong><?php echo e($task['title']); ?></strong>
                </a><br>
                <?php echo nl2br(e($task['description'])); ?><br>
                作成日: <?php echo e($task['created_at']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>