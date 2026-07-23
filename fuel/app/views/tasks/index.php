<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="mb-0">タスク一覧</h2>

    <?php echo \Html::anchor(
        'tasks/create',
        '新規投稿',
        array(
            'class' => 'btn btn-primary',
        )
    ); ?>
</div>

<div class="mb-4">
    <input
        type="text"
        class="form-control"
        data-bind="value: keyword, valueUpdate: 'input'"
        placeholder="キーワードを入力してください"
    >
</div>

<p
    class="alert alert-secondary"
    data-bind="visible: tasks().length === 0"
>
    タスクはありません。
</p>

<div
    class="table-responsive"
    data-bind="visible: tasks().length > 0"
>
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th>タスク名</th>
                <th>ステータス</th>
                <th>参考資料件数</th>
                <th>期限</th>
            </tr>
        </thead>

        <tbody data-bind="foreach: tasks">
            <tr>
                <td>
                    <a
                        data-bind="
                            attr: {
                                href: '/tasks/detail/' + id
                            },
                            text: title
                        "
                    ></a>
                </td>

                <td>
                    <span
                        class="badge"
                        data-bind="
                            text:
                                status == 1
                                    ? '未着手'
                                    : status == 2
                                        ? '進行中'
                                        : '完了',
                            css: {
                                'bg-secondary': status == 1,
                                'bg-primary': status == 2,
                                'bg-success': status == 3
                            }
                        "
                    ></span>
                </td>

                <td data-bind="text: reference_items_count"></td>

                <td data-bind="text: deadline || '-'"></td>
            </tr>
        </tbody>
    </table>
</div>

<?php echo \Asset::js('tasks/index.js'); ?>
