<?php

class Controller_Tasks extends Controller_Template
{
    public function action_index()
    {
        $tasks = Model_Task::get_tasks_all();

        $this->template->title = "タスク一覧";
        $this->template->content = \View::forge('tasks/index', array('tasks' => $tasks));
    }
}