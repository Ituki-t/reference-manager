<?php

namespace Fuel\Migrations;

class Create_users
{
    public function up()
    {
        \DBUtil::create_table(
            'users',
            array(
                'id' => array(
                    'type' => 'int',
                    'constraint' => 11,
                    'auto_increment' => true,
                    'unsigned' => true,
                    'null' => false,
                    ),
                'username' => array(
                    'type' => 'varchar',
                    'constraint' => 50,
                    'null' => false,
                    ),
                'email' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false,
                    ),
                'password' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => false,
                    ),
                'created_at' => array(
                    'type' => 'datetime',
                    'null' => false,
                    ),
                'updated_at' => array(
                    'type' => 'datetime',
                    'null' => false,
                    ),
                'remember_token' => array(
                    'type' => 'varchar',
                    'constraint' => 255,
                    'null' => true,
                    'default' => null,
                    ),
            ),
            array('id')
        );

        \DBUtil::create_index('users', 'username', 'users_username_unique', 'UNIQUE');
    }


    public function down()
    {
        \DBUtil::drop_table('users');
    }
}