<?php

class Controller_Tasks extends Controller_Template
{
    public function action_index()
    {
        $tasks = Model_Task::get_tasks_all();

        $this->template->title = "タスク一覧";
        $this->template->content = \View::forge('tasks/index', array('tasks' => $tasks));
    }


    public function action_create()
    {
        if (\Input::method() == 'POST') {
            $title = \Input::post('title');
            $description = \Input::post('description');
            $status = \Input::post('status');
            $dev_location = \Input::post('dev_location');
            $deadline = \Input::post('deadline');
            $user_id = \Session::get('user_id');

            Model_Task::create_task($title, $description, $status, $dev_location, $deadline, $user_id);
        }

        $this->template->title = "タスク作成";
        $this->template->content = \View::forge('tasks/create');
    }
}