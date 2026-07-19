<div>
    <h2><?php echo e($reference_item['title']); ?></h2>
    <p><?php echo e($reference_item['url']); ?></p>
    <p><?php echo e($reference_item['memo']); ?></p>
    <a href="<?php echo Uri::create('referenceitems/update/' . $reference_item['id']); ?>">編集</a>
</div>
