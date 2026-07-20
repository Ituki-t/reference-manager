<?php

class Model_ReferenceItemTag extends \Model
{
    public static function add_tag_to_reference_item($reference_item_id, $tag_id)
    {
        \DB::insert('reference_item_tags')
            ->set(array(
                'reference_item_id' => $reference_item_id,
                'tag_id' => $tag_id,
            ))
            ->execute();
    }
}
