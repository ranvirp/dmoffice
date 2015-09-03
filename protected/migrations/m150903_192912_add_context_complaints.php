<?php

class m150903_192912_add_context_complaints extends CDbMigration
{
	public function up()
	{
	 $this->addColumn('{{complaints}}','context',"varchar(20) default 'dmoffice'");
	  $this->addColumn('{{landdisputes}}','context',"varchar(20) default 'dmoffice'");
	}

	public function down()
	{
		echo "m150903_192912_add_context_complaints does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}