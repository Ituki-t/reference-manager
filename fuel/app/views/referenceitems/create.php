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
        <label for="tag-keyword">タグ検索</label>
        <input
            type="text"
            name="tag-keyword"
            id="tag-keyword"
            data-bind="value: keyword, valueUpdate: 'input'"
        >

        <div data-bind="foreach: searchResults">
            <button
                type="button"
                data-bind="
                    text: name,
                    click: $parent.selectTag
                "
            ></button>
        </div>
        <button 
            type="button"
            data-bind="click: createTag"
        >新しいタグを作成
        </button>


        <div>
            <p>選択されたタグ:</p>
            <div data-bind="foreach: selectedTags">
                <span data-bind="text: name"></span>
                <input 
                    type="hidden" 
                    name="tag_ids[]"
                    data-bind="value: id"
                >

                <button 
                    type="button" 
                    data-bind="click: $parent.removeTag"
                >削除
                </button>
            </div>
        </div>
    <button type="submit">作成</button>
</form>
<?php echo Asset::js('referenceitems/create.js'); ?>
