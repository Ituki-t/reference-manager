<?php

class Controller_ReferenceItems extends Controller_Base
{
  private function render_create($task_id, $error = '')
  {
    $this->template->title = '参考資料の作成';
    $this->template->content = \View::forge('referenceitems/create', array(
      'task_id' => $task_id,
      'error' => $error
    ));
  }


  public function get_create($task_id)
  {
    $this->render_create($task_id);
  }


  public function post_create($task_id)
  {
    $title = \Input::post('title', '');
    $url = \Input::post('url', '');
    $memo = \Input::post('memo', '');

    $tag_ids = \Input::post('tag_ids', array());

    if (empty($title) || empty($url)) {
      $error = 'タイトルとURLは必須です。';
      $this->render_create($task_id, $error);
      return;
    }

    $reference_item_id = Model_ReferenceItem::create_reference_item($task_id, $title, $url, $memo);

    foreach ($tag_ids as $tag_id) {
      Model_ReferenceItemTag::add_tag_to_reference_item($reference_item_id, $tag_id);
    }

    return \Response::redirect(\Uri::create('tasks/detail/' . $task_id)); 
  }


  public function action_detail($reference_item_id)
  {
    $user_id = \Session::get('user_id');
    $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id, $user_id);

    if (!$reference_item) {
      return \Response::redirect(\Uri::create('tasks'));
    }

    $tags = Model_Tag::get_tags_by_reference_item_id($reference_item_id);

    $this->template->title = '参考資料の詳細';
    $this->template->content = \View::forge('referenceitems/detail', array(
      'reference_item' => $reference_item,
      'tags' => $tags,
    ));
  }


  private function render_update($reference_item, $tags, $error = '')
  {
    $this->template->title = '参考資料の更新';
    $this->template->content = \View::forge('referenceitems/update', array(
      'reference_item' => $reference_item,
      'tags' => $tags,
      'error' => $error
    ));
  }


  public function get_update($reference_item_id)
  {
    $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id);

    if (!$reference_item) {
      return \Response::redirect(\Uri::create('tasks'));
    }

    $tags = Model_Tag::get_tags_by_reference_item_id($reference_item_id);

    $this->render_update($reference_item, $tags);
  }


  public function post_update($reference_item_id)
  {
    $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id);

    if (!$reference_item) {
      return \Response::redirect(\Uri::create('tasks'));
    }

    $title = \Input::post('title', '');
    $url = \Input::post('url', '');
    $memo = \Input::post('memo', '');

    $tag_ids = \Input::post('tag_ids', array());

    if (empty($title) || empty($url)) {
      $reference_item['title'] = $title;
      $reference_item['url'] = $url;
      $reference_item['memo'] = $memo;

      $error = 'タイトルとURLは必須です。';
      $tags = Model_Tag::get_tags_by_reference_item_id($reference_item_id);
      $this->render_update($reference_item, $tags, $error);
      return;
    }

    Model_ReferenceItem::update_reference_item($reference_item_id, $title, $url, $memo);

    Model_ReferenceItemTag::delete_tags_by_reference_item_id($reference_item_id);

    foreach ($tag_ids as $tag_id) {
      Model_ReferenceItemTag::add_tag_to_reference_item($reference_item_id, $tag_id);
    }

    return \Response::redirect(\Uri::create('tasks/detail/' . $reference_item['task_id']));
  }


  public function post_delete($reference_item_id)
  {
    $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id);

    if (!$reference_item) {
      return \Response::redirect(\Uri::create('tasks'));
    }

    Model_ReferenceItem::delete_reference_item($reference_item_id);

    return \Response::redirect(\Uri::create('tasks/detail/' . $reference_item['task_id']));
  }


  public function action_search($task_id)
  {
    $keyword = \Input::get('keyword', '');

    if ($keyword === '') {
      $reference_items = Model_ReferenceItem::get_reference_items_by_task_id($task_id);
    } else {
      $reference_items = Model_ReferenceItem::get_reference_items_by_keyword($keyword, $task_id);
    }

    foreach ($reference_items as &$item) {
      $item['tags'] = Model_Tag::get_tags_by_reference_item_id($item['id']);
    }
    unset($item);

    return \Response::forge(
      json_encode($reference_items, JSON_UNESCAPED_UNICODE),
      200,
      array('content-type' => 'application/json')
    );
  }
}
