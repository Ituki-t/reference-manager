<?php

class Model_User extends \Model
{
    public static function create_user($username, $email, $password)
    {
        return \DB::insert('users')
            ->set(array(
                'username' => $username,
                'email' => $email,
                'password' => $password,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ))->execute();
    }


    public static function get_user_by_id($id)
    {
        return \DB::select('*')
            ->from('users')
            ->where('id', $id)
            ->execute()
            ->current();
    }


    public static function get_user_by_username($username)
    {
        return \DB::select('*')
            ->from('users')
            ->where('username', $username)
            ->execute()
            ->current();
    }


    public static function set_remember_token($user_id, $token)
    {
        return \DB::update('users')
            ->set(array(
                'remember_token' => $token,
            ))
            ->where('id', $user_id)
            ->execute();
    }
}
