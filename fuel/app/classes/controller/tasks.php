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
    \config::load('remember', true);
    $cookie_name = \config::get('remember.cookie_name');
    $token = \cookie::get($cookie_name);

    if (empty($token)) {
      return \response::redirect('accounts/login');
    }

    $user = model_user::get_user_by_token($token);

    if (!$user) {
      \cookie::delete($cookie_name);
      return \response::redirect('accounts/login');
    }

    \session::set('user_id', $user['id']);
    \session::set('username', $user['username']);
  }


  public function action_index()
  {
    $user_id = \session::get('user_id');
    $tasks = model_task::get_tasks_all($user_id);

    foreach ($tasks as &$task) {
      if ($task['deadline'] === null) {
        $task['deadline'] = '';
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
    }
    unset($task); 

    $this->template->title = "タスク一覧";
    $this->template->content = \View::forge('tasks/index', array('tasks' => $tasks));
  }


  private function render_create($error = '')
  {
    $status_data = array(
      0 => '未着手',
      1 => '進行中',
      2 => '完了'
    );

    $this->template->title = "タスク作成";
    $this->template->content = \View::forge('tasks/create', array(
      'status_data' => $status_data,
      'error' => $error
    ));
  }


  public function get_create()
  {
    $this->render_create();
  }


  public function post_create()
  {
    $title = \Input::post('title');
    $description = \Input::post('description');
    $status = \Input::post('status');
    $dev_location = \Input::post('dev_location');
    $deadline = \Input::post('deadline');
    $user_id = \Session::get('user_id');

    if ($deadline === '') {
      $deadline = null;
    }

    if (empty($title) || empty($description)) {
      $error = 'タイトルと説明を入力して下さい。';
      $this->render_create($error);
      return;
    }

    Model_Task::create_task(
      $title,
      $description,
      $status,
      $dev_location,
      $deadline,
      $user_id
    );

    return \Response::redirect('tasks');
  }


  public function action_detail($task_id)
  {
    $user_id = \Session::get('user_id');
    // tasks/detailの処理
    $task = Model_Task::get_task_by_id($task_id, $user_id);

    if (!$task) {
      return \Response::redirect('tasks');
    }

    if ($task['deadline'] === null) {
      $task['deadline'] = '';
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

    foreach ($reference_items as &$item) {
      $item['tags'] = Model_Tag::get_tags_by_reference_item_id($item['id']);
    }
    unset($item);

    $this->template->title = "タスク詳細";
    $this->template->content = \View::forge('tasks/detail', array(
      'task' => $task,
      'reference_items' => $reference_items
    ));
  }


  private function render_update($task, $error = '')
  {
    $status_data = array(
      0 => '未着手',
      1 => '進行中',
      2 => '完了'
    );

    $this->template->title = 'タスク編集';
    $this->template->content = \View::forge('tasks/update', array(
      'task' => $task,
      'status_data' => $status_data,
      'error' => $error
    ));
  }


  public function get_update($task_id)
  {
    $user_id = \Session::get('user_id');
    $task = Model_Task::get_task_by_id($task_id, $user_id);

    if (!$task) {
      return \Response::redirect('tasks');
    }

    if ($task['deadline'] === null) {
      $task['deadline'] = '';
    }

    $this->render_update($task);
  }


  public function post_update($task_id)
  {
    $user_id = \Session::get('user_id');
    $task = Model_Task::get_task_by_id($task_id, $user_id);

    if (!$task) {
      return \Response::redirect('tasks');
    }

    $title = \Input::post('title');
    $description = \Input::post('description');
    $status = \Input::post('status');
    $dev_location = \Input::post('dev_location');
    $deadline = \Input::post('deadline', '');

    if ($deadline === '') {
      $deadline = null;
    }

    if (empty($title) || empty($description)) {

      $task['title'] = $title;
      $task['description'] = $description;
      $task['status'] = $status;
      $task['dev_location'] = $dev_location;
      $task['deadline'] = $deadline === null ? '' : $deadline;

      $error = 'タイトルと説明を入力して下さい。';
      $this->render_update($task, $error);
      return;
    }

    Model_Task::update_task($task_id, $title, $description, $status, $dev_location, $deadline, $user_id);

    return \Response::redirect('tasks/detail/' . $task_id);
  }


  public function post_delete($task_id)
  {
    $user_id = \Session::get('user_id');

    $task = Model_Task::get_task_by_id($task_id, $user_id);

    if (!$task) {
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
      if ($task['deadline'] === null) {
        $task['deadline'] = '';
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
    }
    unset($task); 

    return \Response::forge(
      json_encode($tasks, JSON_UNESCAPED_UNICODE),
      200,
      array('Content-Type' => 'application/json')
    );
  }
}
