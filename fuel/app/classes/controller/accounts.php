<?php

class Controller_Accounts extends Controller_Template
{
  public function action_signup()
  {
    $error = "";

    if (\Input::method() == 'POST') {
      $username = \Input::post('username');
      $email = \Input::post('email');
      $password = password_hash(\Input::post('password'), PASSWORD_DEFAULT);

      if (empty($username) || empty($email) || empty($password)) {
        $error = "すべての項目を入力してください。";
      } elseif (Model_User::get_user_by_username($username)) {
        $error = "このユーザー名は既に使用されています。";
      } else {
        Model_User::create_user($username, $email, $password);

        return \Response::redirect('accounts/login');
      }
    }

    $this->template->title = "アカウント登録";
    $this->template->content = \View::forge('accounts/signup', array('error' => $error));
  }


  public function action_login()
  {
    $error = "";

    if (\Input::method() == 'POST') {
      $username = \Input::post('username');
      $password = \Input::post('password');
      $remember = \Input::post('remember', false);

      // Validate input
      if (empty($username) || empty($password)) {
        $error = "すべての項目を入力してください。";
      } else {
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
        } else {
          $error = "ユーザー名またはパスワードが正しくありません。";
        }
      }
    }
    $this->template->title = "ログイン";
    $this->template->content = \View::forge('accounts/login', array('error' => $error));
  }


  public function action_logout()
  {
    \Config::load('remember', true);
    $cookie_name = \Config::get('remember.cookie_name');
    \Cookie::delete($cookie_name);

    Model_User::set_remember_token(\Session::get('user_id'), null);
    \Session::destroy();

    return \Response::redirect('accounts/login');
  }
}
