<?php

class Controller_ReferenceItems extends Controller_Template
{
    public function action_create($task_id)
    {
        if (\Input::method() == 'POST') {
            $title = \Input::post('title');
            $url = \Input::post('url');
            $memo = \Input::post('memo');

            $tag_ids = \Input::post('tag_ids', array());

            $reference_item_id = Model_ReferenceItem::create_reference_item($task_id, $title, $url, $memo);

            foreach ($tag_ids as $tag_id) {
                Model_ReferenceItemTag::add_tag_to_reference_item($reference_item_id, $tag_id);
            }

            return \Response::redirect(\Uri::create('tasks/detail/' . $task_id));
        }

        $this->template->title = '参考資料の作成';
        $this->template->content = \View::forge('referenceitems/create', array('task_id' => $task_id));
    }


    public function action_detail($reference_item_id)
    {
        $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id);
        $tags = Model_Tag::get_tags_by_reference_item_id($reference_item_id);

        if (!$reference_item) {
            return \Response::redirect(\Uri::create('tasks'));
        }

        $this->template->title = '参考資料の詳細';
        $this->template->content = \View::forge('referenceitems/detail', array(
            'reference_item' => $reference_item,
            'tags' => $tags,));
    }


    public function action_update($reference_item_id)
    {
        $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id);

        if (!$reference_item) {
            return \Response::redirect(\Uri::create('tasks'));
        }

        if (\Input::method() == 'POST') {
            $title = \Input::post('title');
            $url = \Input::post('url');
            $memo = \Input::post('memo');

            $tag_ids = \Input::post('tag_ids', array());

            Model_ReferenceItem::update_reference_item($reference_item_id, $title, $url, $memo);

            Model_ReferenceItemTag::delete_tags_by_reference_item_id($reference_item_id);
            foreach ($tag_ids as $tag_id) {
                Model_ReferenceItemTag::add_tag_to_reference_item($reference_item_id, $tag_id);
            }

            return \Response::redirect(\Uri::create('tasks/detail/' . $reference_item['task_id']));
        }

        $tags = Model_Tag::get_tags_by_reference_item_id($reference_item_id);

        $this->template->title = '参考資料の更新';
        $this->template->content = \View::forge('referenceitems/update', array(
            'reference_item' => $reference_item,
            'tags' => $tags
        ));
    }


    public function action_delete($reference_item_id)
    {
        $reference_item = Model_ReferenceItem::get_reference_item_by_id($reference_item_id);

        if (!$reference_item) {
            return \Response::redirect(\Uri::create('tasks'));
        }

        Model_ReferenceItem::delete_reference_item($reference_item_id);

        return \Response::redirect(\Uri::create('tasks/detail/' . $reference_item['task_id']));
    }
}
