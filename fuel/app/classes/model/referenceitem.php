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
    $result = \DB::insert('reference_items')->set(array(
      'task_id' => $task_id,
      'title' => $title,
      'url' => $url,
      'memo' => $memo,
      'created_at' => date('Y-m-d H:i:s'),
      'updated_at' => date('Y-m-d H:i:s'),
    ))->execute();

    return $result[0]; // Return the ID
  }


  public static function update_reference_item($reference_item_id, $title, $url, $memo)
  {
    return \DB::update('reference_items')->set(array(
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


  public static function delete_reference_item($reference_item_id)
  {
    \DB::delete('reference_items')
      ->where('id', $reference_item_id)
      ->execute();
  }


  public static function get_reference_items_by_keyword($keyword, $task_id)
  {
    return \DB::select('reference_items.*')
      ->from('reference_items')
      ->join('reference_item_tags', 'LEFT')
      ->on('reference_items.id', '=', 'reference_item_tags.reference_item_id')
      ->join('tags', 'LEFT')
      ->on('reference_item_tags.tag_id', '=', 'tags.id')
      ->where('task_id', '=', $task_id)
      ->where_open()
        ->where('reference_items.title', 'like', '%' . $keyword . '%')
        ->or_where('tags.name', 'like', '%' . $keyword . '%')
      ->where_close()
      ->distinct()
      ->execute()
      ->as_array();
  }
}
