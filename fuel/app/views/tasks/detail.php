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
    <input type="hidden" id="taskID" value="<?php echo e($task['id']); ?>">

    <input 
        type="text" 
        data-bind="value: keyword, valueUpdate: 'input'"
        placeholder="参考資料を検索">

    <p data-bind="visible: referenceItems().length === 0">
        参考資料はありません。
    </p>
    <ul data-bind="foreach: referenceItems">
        <li>
            <a data-bind="
                attr: {
                    href: '/referenceitems/detail/' + id
                }
            ">
                <strong data-bind="text: title"></strong>
            </a>

            <br>

            <span data-bind="text: memo"></span>

            <br>

            作成日:
            <span data-bind="text: created_at"></span>
        </li>
    </ul>

</div>
<div>
    <a href="<?php echo \Uri::create('referenceitems/create/' . $task['id']); ?>">参考資料を追加</a>
</div>
<?php echo \Asset::js('referenceitems/index.js'); ?>
