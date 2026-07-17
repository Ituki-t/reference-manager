<form action="<?php echo Uri::create('tasks/update/' . $task['id']); ?>" method="post">
    <div>
        <label for="title">タイトル</label>
        <input
            type="text"
            name="title"
            id="title"
            value="<?php echo $task['title']; ?>"
        >
    </div>
    <div>
        <label for="description">説明</label>
        <textarea
            name="description"
            id="description"
        ><?php echo $task['description']; ?></textarea>
    </div>
    <div>
        <label for="status">ステータス</label>
        <select name="status" id="status">
            <option value="0" <?php echo $task['status'] === '0' ? 'selected' : ''; ?>>未着手</option>
            <option value="1" <?php echo $task['status'] === '1' ? 'selected' : ''; ?>>進行中</option>
            <option value="2" <?php echo $task['status'] === '2' ? 'selected' : ''; ?>>完了</option>
        </select>
    </div>
    <div>
        <label for="dev_location">開発場所</label>
        <input
            type="text"
            name="dev_location"
            id="dev_location"
            value="<?php echo $task['dev_location']; ?>"
        >
    </div>
    <div>
        <label for="deadline">締め切り</label>
        <input
            type="date"
            name="deadline"
            id="deadline"
            value="<?php echo $task['deadline']; ?>"
        >
    </div>
    <div>
        <input type="submit" value="更新">
    </div>
</form>