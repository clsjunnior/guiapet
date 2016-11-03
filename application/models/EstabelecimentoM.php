<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EstabelecimentoM extends CI_Model {

    private $table = 'TB_Estabelecimento';
    private $tableTagEstabelecimento = 'TB_TagEstabelecimento';
    private $tableTag = 'TB_Tag';
    private $viewEstabelecimentos = 'VW_Estabelecimentos';

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

    public function adicionaTags($idEstabelecimento, $tags = [])
    {
        $this->db->reset_query();
        $tagsDB = $this->db->select("*")
            ->from($this->tableTag)
//            ->where_in("Nome", $tags)
            ->get()->result_array();

        $tagsAdd = [];
        $tagAtual = null;
        foreach ($tags as $tag){
            foreach ($tagsDB as $tagDB){
                if (trim($tag) == trim($tagDB["Nome"])) {
                    $tagAtual["CodTag"] = $tagDB["CodTag"];
                    $tagAtual["Nome"] = $tagDB["Nome"];
                }
            }

            if ($tagAtual != null){
                $tagsAdd[] = $tagAtual["CodTag"];
            }else{
                $this->db->insert($this->tableTag,["Nome" => $tag]);
                $tagsAdd[] = $this->db->insert_id();
            }
            $tagAtual = null;
        }

        $this->db->reset_query();
        $this->db->delete($this->tableTagEstabelecimento, array("EstabelecimentoCod" => $idEstabelecimento));

        foreach ($tagsAdd as $tag){
            $this->db->reset_query();
            $this->db->insert($this->tableTagEstabelecimento, ["EstabelecimentoCod" => $idEstabelecimento, "TagCod" => $tag]);
        }

    }

    /**
     * Retorna o ID do ultimo registro inserido no banco
     *
     * @return int
     */
    public function getIdLastInsert()
    {
        return $this->db->insert_id();
    }

    public function atualizar($estabelecimento, $id)
    {
        /** Atualiza a localização onde o ID foi passado no parametro */
        $this->db->where('CodEstabelecimento', $id);
        return $this->db->update($this->table, $estabelecimento);
    }

}