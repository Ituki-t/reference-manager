<?php

class Controller_Accounts extends Controller_Template
{
  private function render_signup($error = '')
  {
    $this->template->title = "アカウント登録";
    $this->template->content = \View::forge('accounts/signup', array(
      'error' => $error
    ));
  }


  public function get_signup()
  {
    $this->render_signup();
  }


  public function post_signup()
  {
    $username = \Input::post('username', '');
    $email = \Input::post('email', '');
    $password = \Input::post('password', '');

    if (empty($username) || empty($email) || empty($password)) {
      $error = "すべての項目を入力してください。";
      $this->render_signup($error);
      return;
    }

    if (Model_User::get_user_by_username($username)) {
      $error = "このユーザー名は既に使用されています。";
      $this->render_signup($error);
      return;
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);
    Model_User::create_user($username, $email, $password_hash);

    return \Response::redirect('accounts/login');
  }


  private function render_login($error = '')
  {
    $this->template->title = "ログイン";
    $this->template->content = \View::forge('accounts/login', array(
      'error' => $error
    ));
  }


  public function get_login()
  {
    $this->render_login();
  }


  public function post_login()
  {
    $username = \Input::post('username', '');
    $password = \Input::post('password', '');
    $remember = \Input::post('remember', false);

    // Validate input
    if (empty($username) || empty($password)) {
      $error = "すべての項目を入力してください。";
      $this->render_login($error);
      return;
    }

    $user = Model_User::get_user_by_username($username);

    if ($user && password_verify($password, $user['password'])) {
      \Session::set('user_id', $user['id']);
      \Session::set('username', $user['username']);

      if ($remember) {
        \Config::load('remember', true);
        $token = bin2hex(random_bytes(32));

        Model_User::set_remember_token($user['id'], $token);

        \Cookie::set(
          \Config::get('remember.cookie_name'),
          $token,
          \Config::get('remember.expiration')
        );
      }
      return \Response::redirect('tasks');
    } 

    $error = "ユーザー名またはパスワードが正しくありません。";
    $this->render_login($error);
    return;
  }


  public function post_logout()
  {
    \Config::load('remember', true);
    $cookie_name = \Config::get('remember.cookie_name');
    \Cookie::delete($cookie_name);

    Model_User::set_remember_token(\Session::get('user_id'), null);
    \Session::destroy();

    return \Response::redirect('accounts/login');
  }
}
