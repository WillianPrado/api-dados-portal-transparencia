<?php

use Phinx\Migration\AbstractMigration;

class ApaDado extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
       
        $table = $this->table('uf');
        $table->addColumn('sigla', 'string')
              ->addColumn('nome', 'string')
              ->save();

              $table = $this->table('municipio');
              $table->addColumn('uf_id', 'integer')
                    ->addColumn('codigoIBGE', 'integer')
                    ->addColumn('nomeIBGE', 'string')
                    ->addColumn('codigoRegiao', 'integer')
                    ->addColumn('nomeRegiao', 'string')
                    ->addColumn('pais', 'string')                    
                    ->addForeignKey('uf_id', 'uf', 'id')
                    ->save();                    
        
                    $table = $this->table('tipo');
                    $table->addColumn('tipo_id', 'integer')
                          ->addColumn('descricao', 'string')
                          ->addColumn('descricaoDetalhada', 'string')
                          ->save();

                          $table = $this->table('api_dado');
                          $table->addColumn('api_dados', 'integer')
                                ->addColumn('municipio_id', 'integer')
                                ->addColumn('tipo_id', 'integer')
                                ->addColumn('valor', 'integer')
                                ->addColumn('quantidadeBeneficiados', 'integer')
                                ->addForeignKey('municipio_id', 'municipio', 'id')
                                ->addForeignKey('tipo_id', 'tipo', 'id')                                
                                ->save();
    }
}
