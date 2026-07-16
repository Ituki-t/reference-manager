<?php

namespace Fuel\Migrations;

class Create_reference_item_tags
{
	public function up()
	{
		\DBUtil::create_table('reference_item_tags', array(
			'id' => array(
				'constraint' => 11,
				'type' => 'int',
				'auto_increment' => true,
				'unsigned' => true,
				'null' => false,
			),
			'reference_item_id' => array(
				'constraint' => 11,
				'type' => 'int',
				'unsigned' => true,
				'null' => false,
			),
			'tag_id' => array(
				'constraint' => 11,
				'type' => 'int',
				'unsigned' => true,
				'null' => false,
			),
			),array('id')
		);

		\DBUtil::create_index(
			'reference_item_tags',
			array('reference_item_id', 'tag_id'),
			'reference_item_tags_reference_item_id_tag_id_unique',
			'UNIQUE'
		);

		\DBUtil::add_foreign_key('reference_item_tags', array(
			'constraint' => 'fk_reference_item_tags_reference_item_id',
			'key' => 'reference_item_id',
			'reference' => array(
				'table' => 'reference_items',
				'column' => 'id',
			),
			'on_update' => 'CASCADE',
			'on_delete' => 'CASCADE',
		));
	}

	public function down()
	{
		\DBUtil::drop_table('reference_item_tags');
	}
}