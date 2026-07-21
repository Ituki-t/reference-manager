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


    public function action_create()
    {
        $user_id = \Session::get('user_id');
        $tag_name = trim(\Input::post('tag_name', ''));

        if ($tag_name === '') {
            return \Response::forge(
                json_encode(array('error' => 'Tag name is required'), JSON_UNESCAPED_UNICODE),
                400,
                array('Content-Type' => 'application/json')
            );
        }

        if (Model_Tag::get_tag_by_name($tag_name, $user_id)) {
            return \Response::forge(
                json_encode(array('error' => 'Tag already exists'), JSON_UNESCAPED_UNICODE),
                409,
                array('Content-Type' => 'application/json')
            );
        }

        $tag_id = Model_Tag::create_tag($tag_name, $user_id);

        return \Response::forge(
            json_encode(array(
                'id' => $tag_id,
                'name' => $tag_name
            ), JSON_UNESCAPED_UNICODE),
            201,
            array('Content-Type' => 'application/json')
        );
    }
}
