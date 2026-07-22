<input
    type="text"
    data-bind="value: keyword, valueUpdate: 'input'"
    placeholder="タスクを検索"
>

<p data-bind="visible: tasks().length === 0">
    タスクはありません。
</p>

<ul data-bind="foreach: tasks">
    <li>
        <a data-bind="
            attr: {
                href: '/tasks/detail/' + id
            }
        ">
            <strong data-bind="text: title"></strong>
        </a>

        <br>

        <span data-bind="text: description"></span>

        <br>

        作成日:
        <span data-bind="text: created_at"></span>
    </li>
</ul>

<?php echo \Asset::js('tasks/index.js'); ?>
