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


    public static function create_reference_item($task_id, $title, $url, $memo)
    {
        \DB::insert('reference_items')->set(array(
            'task_id' => $task_id,
            'title' => $title,
            'url' => $url,
            'memo' => $memo,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ))->execute();
    }


    public static function update_reference_item($reference_item_id, $title, $url, $memo)
    {
        \DB::update('reference_items')->set(array(
            'title' => $title,
            'url' => $url,
            'memo' => $memo,
            'updated_at' => date('Y-m-d H:i:s'),
        ))
        ->where('id', $reference_item_id)
        ->execute();
    }


    public static function get_reference_item_by_id($reference_item_id)
    {
        return \DB::select()
            ->from('reference_items')
            ->where('id', $reference_item_id)
            ->execute()
            ->current();
    }
}