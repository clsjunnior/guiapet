<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class EstabelecimentoM extends CI_Model {

    private $table = 'tb_estabelecimento';
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


    public function gerarRecomendacao($idUser = null, $totResult = 6)
    {
        $this->db->select("*")
            ->from("tb_historico");
        if ($idUser != null) {
            $this->db->where('UsuarioCod', $idUser);
        }
        $historicos = $this->db->order_by('CodHistorico', 'desc')
            ->limit(20)->get()->result_array();

        $categorias = null;
        $tags = null;
        $estabelecimento = null;
        foreach ($historicos as $historico) {

            if (isset($categorias[$historico["CategoriaCod"]])) {
                $categorias[$historico["CategoriaCod"]] = $categorias[$historico["CategoriaCod"]] + 1;
            } else {
                $categorias[$historico["CategoriaCod"]] = 1;
            }

            if (isset($estabelecimento[$historico["EstabelecimentoCod"]])) {
                $estabelecimento[$historico["EstabelecimentoCod"]] = $estabelecimento[$historico["EstabelecimentoCod"]] + 1;
            } else {
                $estabelecimento[$historico["EstabelecimentoCod"]] = 1;
            }

            $tgExplode = explode(",", $historico["TagsCod"]);
            foreach ($tgExplode as $tg) {
                if ($tg != '') {
                    if (isset($tags[$tg])) {
                        $tags[$tg] = $tags[$tg] + 1;
                    } else {
                        $tags[$tg] = 1;
                    }
                }
            }
        }

        arsort($categorias);
        arsort($tags);
        arsort($estabelecimento);

        $Scategorias = [];
        $Stags = [];
        $Sestabelecimento = [];

        for ($i = 0; $i < ($totResult / 3); $i++) {
            $Scategorias[] = key($categorias);
            $Stags[] = key($tags);
            $Sestabelecimento[] = key($estabelecimento);

            next($categorias);
            next($tags);
            next($estabelecimento);
        }

        $estabelecimentoResult1 = $this->db->select("*")
            ->from("tb_estabelecimento")
            ->where_in("CategoriaCod", $Scategorias)
            ->group_by("CodEstabelecimento")
            ->limit($totResult / 3)->get();

        $tot = $totResult - $estabelecimentoResult1->num_rows();

        $notIn = [];
        $resultEnd = [];
        foreach ($estabelecimentoResult1->result_array() as $result) {
            $notIn[] = (int)$result['CodEstabelecimento'];
            $resultEnd[] = $result;
        }

        $estabelecimentoResult2 = $this->db->select("*")
            ->from("tb_estabelecimento")
            ->join('tb_tagestabelecimento', 'tb_estabelecimento.CodEstabelecimento = tb_tagestabelecimento.EstabelecimentoCod', 'inner')
            ->where_in("tb_tagestabelecimento.TagCod", $Stags)
            ->or_where_not_in("tb_estabelecimento.CodEstabelecimento", $notIn)
//            ->group_by("tb_estabelecimento.CodEstabelecimento")
            ->limit($tot / 2)->get();
        $tot = $totResult - ($estabelecimentoResult1->num_rows() + $estabelecimentoResult2->num_rows());

        foreach ($estabelecimentoResult2->result_array() as $result) {
            $notIn[] = (int)$result['CodEstabelecimento'];
            $resultEnd[] = $result;
        }

        var_dump($notIn);
        var_dump($Sestabelecimento);

        $estabelecimentoResult3 = $this->db->select("*")
            ->from("tb_estabelecimento")
            ->where_in("CodEstabelecimento", $Sestabelecimento)
            ->or_where_not_in("CodEstabelecimento", $notIn)
            ->group_by("CodEstabelecimento")
            ->limit($tot)->get();

//        var_dump($estabelecimentoResult1->result_array());
//        echo "***************************************************";
//        var_dump($estabelecimentoResult2->result_array());
//        echo "***************************************************";
//        var_dump($estabelecimentoResult3->result_array());


        foreach ($estabelecimentoResult3->result_array() as $result) {
            $resultEnd[] = $result;
        }
        var_dump($resultEnd);

        return $resultEnd;
    }


}