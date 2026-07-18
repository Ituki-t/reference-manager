<?php

class Controller_ReferenceItems extends Controller_Template
{
    public function action_create($task_id)
    {
        if (\Input::method() == 'POST') {
            $title = \Input::post('title');
            $url = \Input::post('url');
            $memo = \Input::post('memo');

            Model_ReferenceItem::create_reference_item($task_id, $title, $url, $memo);

            return \Response::redirect(\Uri::create('tasks/detail/' . $task_id));
        }

        $this->template->title = '参考資料の作成';
        $this->template->content = \View::forge('referenceitems/create', array('task_id' => $task_id));
}
}