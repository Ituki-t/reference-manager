<form
  action="<?php echo Uri::create('tasks/create'); ?>"
  method="post"
  class="card"
>
  <div class="card-body">

    <h2 class="card-title mb-4">
      タスク作成
    </h2>

    <div class="mb-3">
      <label
        for="title"
        class="form-label"
      >
        タイトル
      </label>

      <input
        type="text"
        name="title"
        id="title"
        class="form-control"
        value="<?php echo Input::post('title'); ?>"
      >
    </div>

    <div class="mb-3">
      <label
        for="description"
        class="form-label"
      >
        説明
      </label>

      <textarea
        name="description"
        id="description"
        class="form-control"
        rows="4"
      ><?php echo Input::post('description'); ?></textarea>
    </div>

    <div class="mb-3">
      <label
        for="status"
        class="form-label"
      >
        ステータス
      </label>

      <select
        name="status"
        id="status"
        class="form-select"
      >
        <?php foreach ($status_data as $value => $label): ?>
          <option
            value="<?php echo $value; ?>"
            <?php echo Input::post('status') == $value ? 'selected' : ''; ?>
          >
            <?php echo e($label); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label
        for="dev_location"
        class="form-label"
      >
        開発場所
      </label>

      <input
        type="text"
        name="dev_location"
        id="dev_location"
        class="form-control"
        value="<?php echo Input::post('dev_location'); ?>"
      >
    </div>

    <div class="mb-4">
      <label
        for="deadline"
        class="form-label"
      >
        締め切り
      </label>

      <input
        type="date"
        name="deadline"
        id="deadline"
        class="form-control"
        value="<?php echo Input::post('deadline'); ?>"
      >
    </div>

    <div>
      <input
        type="submit"
        value="作成"
        class="btn btn-primary"
      >
    </div>

  </div>
</form>
