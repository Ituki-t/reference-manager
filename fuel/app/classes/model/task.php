<?php

class Model_Task extends \Model
{
    public static function get_tasks_all()
    {
        return \DB::select()
            ->from('tasks')
            ->order_by('created_at', 'desc')
            ->execute()
            ->as_array();
    }

    public static function create_task($title, $description, $status, $dev_location, $deadline, $user_id)
    {
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
}