<?php if (empty($tasks)): ?>
    <p>タスクはありません。</p>
<?php else: ?>
    <ul>
        <?php foreach ($tasks as $task): ?>
            <li>
                <strong><?php echo e($task['title']); ?></strong><br>
                <?php echo nl2br(e($task['description'])); ?><br>
                作成日: <?php echo e($task['created_at']); ?>
            </li>
        <?php endforeach; ?>
    </ul>

<?php endif; ?>