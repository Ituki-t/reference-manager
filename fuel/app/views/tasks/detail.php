<div class="card">
  <div class="card-body">

    <h2 class="card-title mb-4">
      <?php echo e($task['title']); ?>
    </h2>

    <table class="table table-borderless">
      <tbody>
        <tr>
          <th>説明・メモ</th>
          <td><?php echo e($task['description']); ?></td>
        </tr>

        <tr>
          <th>ステータス</th>
          <td>
            <span class="badge <?php echo e($task['status_class']); ?>">
              <?php echo e($task['status_text']); ?>
            </span>
          </td>
        </tr>

        <tr>
          <th>開発場所</th>
          <td><?php echo e($task['dev_location']); ?></td>
        </tr>

        <tr>
          <th>締切日</th>
          <td><?php echo e($task['deadline']); ?></td>
        </tr>

        <tr>
          <th>作成者</th>
          <td><?php echo e($task['username']); ?></td>
        </tr>
      </tbody>
    </table>

    <div class="mb-4">
      <a
        href="<?php echo \Uri::create('tasks/update/' . $task['id']); ?>"
        class="btn btn-secondary"
      >
        編集
      </a>

      <form
        action="<?php echo \Uri::create('tasks/delete/' . $task['id']); ?>"
        method="post"
        class="d-inline"
        onsubmit="return confirm('本当に削除しますか？');"
      >
        <input
          type="submit"
          value="削除"
          class="btn btn-danger"
        >
      </form>
    </div>

    <hr>

    <div class="d-flex justify-content-between align-items-center mb-3">
      <h3 class="mb-0">参考資料</h3>

      <a
        href="<?php echo \Uri::create('referenceitems/create/' . $task['id']); ?>"
        class="btn btn-primary"
      >
        ＋参考資料追加
      </a>
    </div>

    <input
      type="hidden"
      id="taskID"
      value="<?php echo e($task['id']); ?>"
    >

    <div class="mb-3">
      <input
        type="text"
        class="form-control"
        data-bind="value: keyword, valueUpdate: 'input'"
        placeholder="参考資料を検索"
      >
    </div>

    <p data-bind="visible: referenceItems().length === 0">
      参考資料はありません。
    </p>

    <table
      class="table table-striped"
      data-bind="visible: referenceItems().length > 0"
    >
      <thead>
        <tr>
          <th>タイトル</th>
          <th>URL</th>
          <th>作成日</th>
          <th>タグ</th>
        </tr>
      </thead>

      <tbody data-bind="foreach: referenceItems">
        <tr>
          <td>
            <a
              data-bind="
                attr: {
                  href: '/referenceitems/detail/' + id
                }
              "
            >
              <span data-bind="text: title"></span>
            </a>
          </td>

          <td data-bind="text: url"></td>

          <td data-bind="text: created_at"></td>

          <td>
            <span data-bind="foreach: tags">
              <span
                class="badge bg-secondary me-1"
                data-bind="text: name"
              ></span>
            </span>
          </td>

        </tr>
      </tbody>
    </table>

  </div>
</div>

<?php echo \Asset::js('referenceitems/index.js'); ?>
