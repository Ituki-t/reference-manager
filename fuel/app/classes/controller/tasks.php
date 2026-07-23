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
    $user_id = \Session::get('user_id');
    $tasks = Model_Task::get_tasks_all($user_id);

    foreach ($tasks as &$task) {
      switch ($task['status']) {
        case 0:
          $task['status_text'] = '未着手';
          $task['status_class'] = 'bg-secondary';
          break;
        case 1:
          $task['status_text'] = '進行中';
            $task['status_class'] = 'bg-primary';
          break;
        case 2:
          $task['status_text'] = '完了';
          $task['status_class'] = 'bg-success';
          break;
        default:
          $task['status_text'] = '未着手';
          $task['status_class'] = 'bg-secondary';
      }
    }
    unset($task); 

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

          return \Response::redirect('tasks');
      } 

      $status_data = array(
        0 => '未着手',
        1 => '進行中',
        2 => '完了'
      );

      $this->template->title = "タスク作成";
      $this->template->content = \View::forge('tasks/create', array(
        'status_data' => $status_data)
      );
  }


  public function action_detail($task_id)
  {
    $user_id = \Session::get('user_id');
    // tasks/detailの処理
    $task = Model_Task::get_task_by_id($task_id, $user_id);

    if (!$task) {
      return \Response::redirect('tasks');
    }

    switch ($task['status']) {
      case 0:
        $task['status_text'] = '未着手';
        $task['status_class'] = 'bg-secondary';
        break;
      case 1:
        $task['status_text'] = '進行中';
        $task['status_class'] = 'bg-primary';
        break;
      case 2:
        $task['status_text'] = '完了';
        $task['status_class'] = 'bg-success';
        break;
      default:
        $task['status_text'] = '未着手';
        $task['status_class'] = 'bg-secondary';
    }


        // reference_items/indexの処理
    $reference_items = Model_ReferenceItem::get_reference_items_by_task_id($task_id);

    $this->template->title = "タスク詳細";
    $this->template->content = \View::forge('tasks/detail', array(
      'task' => $task,
      'reference_items' => $reference_items
    ));
  }


  public function action_update($task_id)
  {
    $user_id = \Session::get('user_id');
    $task = Model_Task::get_task_by_id($task_id, $user_id);

    if (!$task) {
        return \Response::redirect('tasks');
    }

    if ($task['user_id'] !== $user_id) {
      \Session::set_flash('error', 'このタスクを更新する権限がありません。');
      return \Response::redirect('tasks');
    }
 
    if (\Input::method() == 'POST') {
      $title = \Input::post('title');
      $description = \Input::post('description');
      $status = \Input::post('status');
      $dev_location = \Input::post('dev_location');
      $deadline = \Input::post('deadline');
      $updated_at = time();
 
      Model_Task::update_task($task_id, $title, $description, $status, $dev_location, $deadline, $user_id);

      return \Response::redirect('tasks/detail/' . $task_id);
    }   

    $status_data = array(
      0 => '未着手',
      1 => '進行中',
      2 => '完了'
    );

    $this->template->title = "タスク編集";
    $this->template->content = \View::forge('tasks/update', array(
        'task' => $task,
        'status_data' => $status_data
    ));
  }


    public function action_delete($task_id)
    {
        $user_id = \Session::get('user_id');

        $task = Model_Task::get_task_by_id($task_id, $user_id);

        if (!$task) {
            return \Response::redirect('tasks');
        }
        if ($task['user_id'] !== $user_id) {
            \Session::set_flash('error', 'このタスクを削除する権限がありません。');
            return \Response::redirect('tasks');
        }

        Model_Task::delete_task($task_id, $user_id);
        return \Response::redirect('tasks');
    }


  public function action_search()
  {

    $user_id = \Session::get('user_id');
    $keyword = trim(\Input::get('keyword', ''));

    $tasks = Model_Task::search_tasks_by_keyword(
      $user_id,
      $keyword
    );

    foreach ($tasks as &$task) {
      switch ($task['status']) {
        case 0:
          $task['status_text'] = '未着手';
          $task['status_class'] = 'bg-secondary';
          break;
        case 1:
          $task['status_text'] = '進行中';
            $task['status_class'] = 'bg-primary';
          break;
        case 2:
          $task['status_text'] = '完了';
          $task['status_class'] = 'bg-success';
          break;
        default:
          $task['status_text'] = '未着手';
          $task['status_class'] = 'bg-secondary';
      }
    }
    unset($task); 

    return \Response::forge(
        json_encode($tasks, JSON_UNESCAPED_UNICODE),
        200,
        array('Content-Type' => 'application/json')
    );
    }
}
