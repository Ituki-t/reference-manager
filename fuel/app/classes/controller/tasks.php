<?php

class Controller_Tasks extends Controller_Template
{
    public function before()
    {
        parent::before();

        if (\Session::get('user_id') !== null) {
            return ;
        }

        // loginを保持する処理
        \Config::load('remember', true);
        $cookie_name = \Config::get('remember.cookie_name');
        $token = \Cookie::get($cookie_name);

        if (empty($token)) {
            return \Response::redirect('accounts/login');
        }

        $user = Model_User::get_user_by_token($token);

        if (!$user) {
            \Cookie::delete($cookie_name);
            return \Response::redirect('accounts/login');
        }

        \Session::set('user_id', $user['id']);
        \Session::set('username', $user['username']);
    }


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


    public function action_detail($task_id)
    {
        $task = Model_Task::get_task_by_id($task_id);

        if (!$task) {
            return \Response::redirect('tasks');
        }

        $this->template->title = "タスク詳細";
        $this->template->content = \View::forge('tasks/detail', array('task' => $task));
    }


    public function action_update($task_id)
    {
        $task = Model_Task::get_task_by_id($task_id);

        if (!$task) {
            return \Response::redirect('tasks');
        }

        if (\Input::method() == 'POST') {
            $title = \Input::post('title');
            $description = \Input::post('description');
            $status = \Input::post('status');
            $dev_location = \Input::post('dev_location');
            $deadline = \Input::post('deadline');
            $updated_at = time();

            Model_Task::update_task($task_id, $title, $description, $status, $dev_location, $deadline, $updated_at);

            return \Response::redirect('tasks/detail/' . $task_id);
        }

        $this->template->title = "タスク編集";
        $this->template->content = \View::forge('tasks/update', array('task' => $task));
    }


    public function action_delete($task_id)
    {
        $task = Model_Task::get_task_by_id($task_id);
        $user_id = \Session::get('user_id');

        if (!$task) {
            return \Response::redirect('tasks');
        }

        Model_Task::delete_task($task_id, $user_id);
        return \Response::redirect('tasks');
    }
}