<?php

class Model_Tag extends \Model
{
    public static function get_tags_all($user_id)
    {
	return \DB::select()
	    ->from('tags')
    	    ->where('user_id', $user_id)
    	    ->execute()
    	    ->as_array();
    }


    public static function search_tags_by_keyword($keyword, $user_id)
    {
        return \DB::select()
            ->from('tags')
            ->where('name', 'like', '%' . $keyword . '%')
            ->and_where('user_id', $user_id)
            ->execute()
            ->as_array();
    }
}
