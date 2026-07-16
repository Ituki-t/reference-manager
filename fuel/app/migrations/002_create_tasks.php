<?php

namespace Fuel\Migrations;

class Create_tasks
{
	public function up()
	{
		\DBUtil::create_table('tasks', array(
			'id' => array(
				'constraint' => 11,
				'type' => 'int',
				'auto_increment' => true,
				'unsigned' => true,
				),
			'title' => array(
				'constraint' => 100,
				'type' => 'varchar',
				),
			'description' => array(
				'type' => 'text',
				),
			'status' => array(
				'constraint' => 11,
				'type' => 'int',
				'default' => 0,
				),
			'dev_location' => array(
				'constraint' => 2048,
				'type' => 'varchar',
				'null' => true,
				),
			'deadline' => array(
				'type' => 'date',
				'null' => true,
				),
			'created_at' => array(
				'type' => 'datetime',
				),
			'updated_at' => array(
				'type' => 'datetime',
				),
			'user_id' => array(
				'constraint' => 11,
				'type' => 'int',
				'unsigned' => true,
				),
			),
			array('id')
		);

		\DBUtil::add_foreign_key('tasks', array(
			'constraint' => 'fk_tasks_user_id',
			'key' => 'user_id',
			'reference' => array(
				'table' => 'users',
				'column' => 'id',
			),
			'on_update' => 'CASCADE',
			'on_delete' => 'CASCADE',
		));

	}

	public function down()
	{
		\DBUtil::drop_table('tasks');
	}
}