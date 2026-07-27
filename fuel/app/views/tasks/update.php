<?php if (!empty($error)): ?>
  <div class="alert alert-danger">
    <?php echo e($error); ?>
  </div>
 <?php endif; ?>

<form
  action="<?php echo Uri::create('tasks/update/' . $task['id']); ?>"
  method="post"
  class="card"
>
  <?php echo \Form::csrf(); ?>
  <div class="card-body">
    <h2 class="card-title mb-4">タスク編集</h2>

    <div class="mb-3">
      <label for="title" class="form-label">タイトル</label>
      <input
        type="text"
        name="title"
        id="title"
        class="form-control"
        value="<?php echo $task['title']; ?>"
      >
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">説明</label>
      <textarea
        name="description"
        id="description"
        class="form-control"
        rows="4"
      ><?php echo $task['description']; ?></textarea>
    </div>

    <div class="mb-3">
      <label for="status" class="form-label">ステータス</label>
      <select
        name="status"
        id="status"
        class="form-select"
      >
        <?php foreach ($status_data as $value => $label): ?>
          <option
            value="<?php echo $value; ?>"
            <?php echo $task['status'] == $value ? 'selected' : ''; ?>
          >
            <?php echo e($label); ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-3">
      <label for="dev_location" class="form-label">開発場所</label>
      <input
        type="text"
        name="dev_location"
        id="dev_location"
        class="form-control"
        value="<?php echo $task['dev_location']; ?>"
      >
    </div>

    <div class="mb-4">
      <label for="deadline" class="form-label">締め切り</label>
      <input
        type="date"
        name="deadline"
        id="deadline"
        class="form-control"
        value="<?php echo $task['deadline']; ?>"
      >
    </div>

    <div>
      <input
        type="submit"
        value="更新"
        class="btn btn-primary"
      >
 
      <?php echo Html::anchor(
        'tasks/detail/' . $task['id'],
        'キャンセル',
        ['class' => 'btn btn-secondary ms-2']
      ); ?>
    </div>
  </div>
</form>
