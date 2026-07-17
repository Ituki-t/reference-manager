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
}