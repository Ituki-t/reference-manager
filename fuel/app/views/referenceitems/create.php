<form action="<?php echo Uri::create('referenceitems/create/' . $task_id); ?>" method="post">
    <div>
        <label for="title">タイトル</label>
        <input
            type="text"
            name="title"
            id="title"
            value="<?php echo Input::post('title'); ?>"
        >
    </div>
    <div>
        <label for="url">URL</label>
        <input
            type="text"
            name="url"
            id="url"
            value="<?php echo Input::post('url'); ?>"
        >
    </div>
    <div>
        <label for="memo">メモ</label>
        <textarea
            name="memo"
            id="memo"
        ><?php echo Input::post('memo'); ?></textarea>
    </div>
    <div>
        <input type="submit" value="作成">
    </div>
</form>
