<?php

/**
 * Created by PhpStorm.
 * User: Windows 10
 * Date: 07/09/2016
 * Time: 01:24
 */
class CategoriaM extends CI_Model
{

    private $table = 'tb_categoria';


    /**
     * Categoria constructor
     */
    public function __construct(){
        parent::__construct();
    }


    /**
     * Retorna todas as categorias
     *
     * @return CI_DB_result
     */
    public function getAll(){
        $categoria = $this->db->get($this->table);
        $this->console->info($categoria->num_rows() . " registro(2) 'CategoriaM@getAll': ");
        $this->console->info($categoria->result());
        /** Retorna todas as categorias (no formato de classe) */
        return $categoria;
    }

    public function getCatCount()
    {
        $this->db->select("tb_categoria.Nome, count(tb_estabelecimento.CodEstabelecimento)  as qtd")
            ->from("tb_categoria")
            ->join("tb_estabelecimento", "tb_categoria.CodCategoria = tb_estabelecimento.CategoriaCod", "inner")
            ->group_by("tb_categoria.Nome");

        return $this->db->result_id();

    }

    public function getAllCount()
    {
        $this->db->reset_query();
        $this->db->select("ct.Nome, count(es.CodEstabelecimento) as qtd")
            ->from($this->table . " as ct")
            ->join('tb_estabelecimento as es', 'ct.CodCategoria = es.CategoriaCod', 'left')
            ->group_by('ct.Nome');
        return $this->db->get();
    }

}