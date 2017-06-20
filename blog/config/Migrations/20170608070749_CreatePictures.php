<?php
use Migrations\AbstractMigration;

class CreatePictures extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('pictures');
        $table->addColumn('data', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
    }
}
