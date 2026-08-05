<?php

class Controller_Base extends Controller_Template
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

    $token_hash = hash('sha256', $token);

    $user = Model_User::get_user_by_token($token_hash);

    if (!$user) {
      \Cookie::delete($cookie_name);
      return \Response::redirect('accounts/login');
    }

    \Session::set('user_id', $user['id']);
    \Session::set('username', $user['username']);
  }
}
