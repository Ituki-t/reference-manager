<form action="<?php echo Uri::create('referenceitems/update/' . $reference_item['id']); ?>" method="post">
    <div>
	<label for="title">タイトル</label>
	<input
	    type="text"
	    name="title"
	    id="title"
	    value="<?php echo Input::post('title', $reference_item['title']); ?>"
	>
    </div>
    <div>
	<label for="url">URL</label>
	<input
	    type="text"
	    name="url"
	    id="url"
	    value="<?php echo Input::post('url', $reference_item['url']); ?>"
	>
    </div>
    <div>
	<label for="memo">メモ</label>
	<textarea
	    name="memo"
	    id="memo"
	><?php echo Input::post('memo', $reference_item['memo']); ?></textarea>
    </div>
    <div>
	<input type="submit" value="更新">
    </div>
</form>
