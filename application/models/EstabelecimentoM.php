<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EstabelecimentoM extends CI_Model {

    private $table = 'TB_Estabelecimento';
    private $viewEstabelecimentos = 'VW_Estabelecimentos2';

    /**
     * Estabelecimento constructor.
     */
    public function __construct(){
        parent::__construct();
    }

    /**
     * Seleciona estabelecimento por ID
     *
     * @param $id int
     * @return CI_DB_result
     */
    public function getById($id){

        return $this->db->get_where($this->table, array('CodEstabelecimento' => $id));
    }

    /**
     * Cadastra novo estabelecimento
     * @param $estabelecimento
     * @return int
     */
    public function novoEstabelecimento($estabelecimento)
    {
        /** Preenche o campo CriadoEm com a data e hora atual no formato do banco de dados*/
        $estabelecimento['CriadoEm'] = gmdate('Y-m-d H:i:s', time());
        $estabelecimento['AtualizadoEm'] = gmdate('Y-m-d H:i:s', time());

        /** Insere na tabela de estabelecimento o estabelecimento passado com seus respectivos campos */
        $this->db->insert($this->table, $estabelecimento);

        return $this->db->insert_id();
    }


    /**
     * Seleciona estabelecimento pela View do banco
     *
     * @param array $where
     * @return CI_DB_result
     */
    public function getAllBy($where = array()){
        return $this->db->get_where($this->viewEstabelecimentos, $where);
    }


}