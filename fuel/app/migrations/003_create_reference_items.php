<?php

namespace Fuel\Migrations;

class Create_reference_items
{
	public function up()
	{
		\DBUtil::create_table('reference_items', array(
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
			'url' => array(
				'constraint' => 2048,
				'type' => 'varchar',
			),
			'memo' => array(
				'type' => 'text',
				'null' => true,
			),
			'created_at' => array(
				'type' => 'datetime',
			),
			'updated_at' => array(
				'type' => 'datetime',
			),
			'task_id' => array(
				'constraint' => 11,
				'type' => 'int',
				'unsigned' => true,
			),
		), array('id'));

		\DBUtil::add_foreign_key('reference_items', array(
			'constraint' => 'fk_reference_items_task_id',
			'key' => 'task_id',
			'reference' => array(
				'table' => 'tasks',
				'column' => 'id',
			),
			'on_update' => 'CASCADE',
			'on_delete' => 'CASCADE',
		));
	}

	public function down()
	{
		\DBUtil::drop_table('reference_items');
	}
}