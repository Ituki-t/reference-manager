<div class="row justify-content-center">
  <div class="col-lg-8">
    <div class="card shadow-sm">
      <div class="card-body">
        <h2 class="card-title mb-4">参考資料作成</h2>

          <?php if (!empty($error)): ?>
            <div class="alert alert-danger">
              <?php echo e($error); ?>
            </div>
          <?php endif; ?>

        <form action="<?php echo Uri::create('referenceitems/create/' . $task_id); ?>" method="post">
          <?php echo \Form::csrf(); ?>
          <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input
              type="text"
              name="title"
              id="title"
              class="form-control"
              value="<?php echo Input::post('title'); ?>"
            >
          </div>

          <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input
              type="text"
              name="url"
              id="url"
              class="form-control"
              value="<?php echo Input::post('url'); ?>"
            >
          </div>

          <div class="mb-4">
            <label for="memo" class="form-label">メモ</label>
            <textarea
              name="memo"
              id="memo"
              class="form-control"
              rows="5"
            ><?php echo Input::post('memo'); ?></textarea>
          </div>

          <div class="mb-4">
            <label for="tag-keyword" class="form-label">タグ検索</label>
            <input
              type="text"
              name="tag-keyword"
              id="tag-keyword"
              class="form-control mb-3"
              data-bind="value: keyword, valueUpdate: 'input'"
            >

            <div
              class="d-flex flex-wrap gap-2 mb-3"
              data-bind="foreach: searchResults"
            >
              <button
                type="button"
                class="btn btn-outline-secondary btn-sm"
                data-bind="
                  text: name,
                  click: $parent.selectTag
                "
              ></button>
            </div>

            <button
              type="button"
              class="btn btn-outline-primary btn-sm"
              data-bind="click: createTag"
            >
              ＋新しいタグを作成
            </button>
          </div>

          <div class="border rounded p-3 mb-4">
            <p class="fw-bold mb-3">選択されたタグ:</p>

            <div
              class="d-flex flex-wrap gap-2"
              data-bind="foreach: selectedTags"
            >
              <div class="d-flex align-items-center gap-2 border rounded p-2">
                <span data-bind="text: name"></span>

                <input
                  type="hidden"
                  name="tag_ids[]"
                  data-bind="value: id"
                >

                <button
                  type="button"
                  class="btn btn-outline-danger btn-sm"
                  data-bind="click: $parent.removeTag"
                >
                  削除
                </button>
              </div>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">作成</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php echo Asset::js('referenceitems/create.js'); ?>
