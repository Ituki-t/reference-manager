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

                \Response::redirect('accounts/login');
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

            // Validate input
            if (empty($username) || empty($password)) {
                $error = "すべての項目を入力してください。";
            } else {
                $user = Model_User::get_user_by_username($username);

                if ($user && password_verify($password, $user['password'])) {
                    \Session::set('user_id', $user['id']);
                    \Response::redirect('dashboard');
                } else {
                    $error = "ユーザー名またはパスワードが正しくありません。";
                }
            }
        }
        $this->template->title = "ログイン";
        $this->template->content = \View::forge('accounts/login', array('error' => $error));
    }
}