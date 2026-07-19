<div>
    <h2><?php echo e($reference_item['title']); ?></h2>
    <p><?php echo e($reference_item['url']); ?></p>
    <p><?php echo e($reference_item['memo']); ?></p>
    <a href="<?php echo Uri::create('referenceitems/update/' . $reference_item['id']); ?>">編集</a>
    <form 
        action="<?php echo Uri::create('referenceitems/delete/' . $reference_item['id']); ?>" 
        method="post" onsubmit="return confirm('本当に削除しますか？');">
            <input type="submit" value="削除">
    </form>
</div>
