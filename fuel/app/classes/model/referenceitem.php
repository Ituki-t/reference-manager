<?php

class Model_ReferenceItem extends \Model
{
    public static function get_reference_items_by_task_id($task_id)
    {
        return \DB::select()
            ->from('reference_items')
            ->where('task_id', $task_id)
            ->execute()
            ->as_array();
    }
}