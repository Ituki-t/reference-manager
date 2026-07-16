<?php

namespace Fuel\Migrations;

class Create_tags
{
	public function up()
	{
		\DBUtil::create_table('tags', array(
			'id' => array(
				'constraint' => 11,
				'type' => 'int',
				'auto_increment' => true,
				'unsigned' => true,
				'null' => false,
			),
			'name' => array(
				'constraint' => 100,
				'type' => 'varchar',
				'null' => false,
			),
			'user_id' => array(
				'constraint' => 11,
				'type' => 'int',
				'unsigned' => true,
				'null' => false,
			),

		), array('id'));

		\DBUtil::create_index(
			'tags',
			array('user_id', 'name'),
			'tags_user_id_name_unique',
			'UNIQUE'
			);

		\DBUtil::add_foreign_key('tags', array(
			'constraint' => 'fk_tags_user_id',
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
		\DBUtil::drop_table('tags');
	}
}