<?php

class Model_Task extends \Model
{
    public static function get_tasks_all($user_id)
    {
        return \DB::select()
            ->from('tasks')
            ->where('user_id', '=', $user_id)
            ->order_by('created_at', 'desc')
            ->execute()
            ->as_array();
    }

    public static function get_task_by_id($task_id, $user_id)
    {
        return \DB::select(
            'tasks.*',
            array('users.username', 'username')
        )
            ->from('tasks')
            ->join('users')
            ->on('tasks.user_id', '=', 'users.id')
            ->where('tasks.id', '=', $task_id)
            ->where('tasks.user_id', '=', $user_id)
            ->execute()
            ->current();
    }

    public static function create_task(
        $title,
        $description,
        $status,
        $dev_location,
        $deadline,
        $user_id
    ) {
        return \DB::insert('tasks')
            ->set(array(
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'dev_location' => $dev_location,
                'deadline' => $deadline,
                'user_id' => $user_id,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ))
            ->execute();
    }

    public static function update_task(
        $task_id,
        $title,
        $description,
        $status,
        $dev_location,
        $deadline,
        $user_id
    ) {
        return \DB::update('tasks')
            ->set(array(
                'title' => $title,
                'description' => $description,
                'status' => $status,
                'dev_location' => $dev_location,
                'deadline' => $deadline,
                'updated_at' => date('Y-m-d H:i:s'),
            ))
            ->where('id', '=', $task_id)
            ->where('user_id', '=', $user_id)
            ->execute();
    }

    public static function delete_task($task_id, $user_id)
    {
        return \DB::delete('tasks')
            ->where('id', '=', $task_id)
            ->where('user_id', '=', $user_id)
            ->execute();
    }

    public static function search_tasks_by_keyword($user_id, $keyword)
    {
        return \DB::select()
            ->from('tasks')
            ->where('user_id', '=', $user_id)
            ->where_open()
                ->where('title', 'like', '%' . $keyword . '%')
                ->or_where('description', 'like', '%' . $keyword . '%')
            ->where_close()
            ->order_by('created_at', 'desc')
            ->execute()
            ->as_array();
    }
}
