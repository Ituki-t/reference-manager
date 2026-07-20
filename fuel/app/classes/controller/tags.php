<?php

class Controller_Tags extends Controller
{
    public function action_index()
    {
        $user_id = \Session::get('user_id');
        $keyword = \Input::get('keyword', '');

        if (!empty($keyword)) {
            $tags = Model_Tag::search_tags_by_keyword($keyword, $user_id);
        } else {
            $tags = Model_Tag::get_tags_all($user_id);
        }

        return \Response::forge(
            json_encode($tags, JSON_UNESCAPED_UNICODE),
            200,
            array('Content-Type' => 'application/json')
        );
    }
}   
