<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstabelecimentoM extends CI_Model
{

    private $table = 'tb_estabelecimento';
    private $tableTagEstabelecimento = '_TagEstabelecimento';
    private $tableTag = 'TB_Tag';
    private $viewEstabelecimentos = 'VW_Estabelecimentos';

    /**
     * Estabelecimento constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Seleciona estabelecimento por ID
     *
     * @param $id int
     * @return CI_DB_result
     */
    public function getById($id)
    {

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
    public function getAllBy($where = array())
    {
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
        foreach ($tags as $tag) {
            foreach ($tagsDB as $tagDB) {
                if (trim($tag) == trim($tagDB["Nome"])) {
                    $tagAtual["CodTag"] = $tagDB["CodTag"];
                    $tagAtual["Nome"] = $tagDB["Nome"];
                }
            }

            if ($tagAtual != null) {
                $tagsAdd[] = $tagAtual["CodTag"];
            } else {
                $this->db->insert($this->tableTag, ["Nome" => $tag]);
                $tagsAdd[] = $this->db->insert_id();
            }
            $tagAtual = null;
        }

        $this->db->reset_query();
        $this->db->delete($this->tableTagEstabelecimento, array("EstabelecimentoCod" => $idEstabelecimento));

        foreach ($tagsAdd as $tag) {
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


    /** Gera recomendaçao
     *
     * Parametro passado
     * $config = [
     *              'idUser' => (int),                // ID do usuario para realizar recomendação pelo seu historico
     *              'historicoCatQtde' => (int),      // Quantidade de registros que vai se basear para categoria
     *              'historicoTagQtde' => (int),      // Quantidade de registros que vai se basear para tags
     *              'totalResult' => (int),           // Total de resultados
     *              'listTags' => array((int)),       // Lista de ID de TAGS
     *              'listCategorias' => array((int)), // Lista de ID de Categorias
     *           ]
     *
     * @param array $config
     * @return CI_DB_result
     */
    public function gerarRecomendacao($config = array())
    {
        $categorias = [];
        $tags = [];
        $resultado = [];

        // Reseta a Query
        $this->db->reset_query();

        // Se foi informado ID do usuario busca no historico dele as ultimas visitas
        if (isset($config['idUser'])) {

            // Busca categorias visitadas
            $categoriasDb = $this->db->select('CategoriaCod')
                ->from('tb_historico')
                ->where('UsuarioCod', $config['idUser'])
                ->order_by('CodHistorico', 'desc')
                ->limit($config['historicoCatQtde'])
                ->get()->result_array();

            // Pega o código das categorias sem repetir
            foreach ($categoriasDb as $categoriaDb) {
                if (!in_array($categoriaDb['CategoriaCod'], $categorias)) {
                    $categorias[] = (int)$categoriaDb['CategoriaCod'];
                }
            }

            // Reseta a Query
            $this->db->reset_query();

            // Busca tags visitadas
            $tagsDb = $this->db->select('TagsCod')
                ->from('tb_historico')
                ->where('UsuarioCod', $config['idUser'])
                ->order_by('CodHistorico', 'desc')
                ->limit($config['historicoTagQtde'])
                ->get()->result_array();

            // Pega o codigo das tags sem repetir
            foreach ($tagsDb as $tagdb) {
                $tagList = explode(',', $tagdb['TagsCod']);
                foreach ($tagList as $tag) {
                    if (!in_array($tag, $tags) && $tag != '') {
                        $tags[] = (int)$tag;
                    }
                }
            }
        }

        // Se for informado tags, pega seu código sem repetir
        if (isset($config['listTags'])) {
            foreach ($config['listTags'] as $tagConfig) {
                if (!in_array($tagConfig, $tags)) {
                    $tags[] = (int)$tagConfig;
                }
            }
        }

        // Se for informado categorias, pega seu código sem repetir
        if (isset($config['listCategorias'])) {
            foreach ($config['listCategorias'] as $categoriaConfig) {
                if (!in_array($categoriaConfig, $categorias)) {
                    $categorias[] = (int)$categoriaConfig;
                }
            }
        }

        // Reseta a Query
        $this->db->reset_query();

        // Inicia a seleção
        $this->db->select('e.*')->from($this->table . ' as e');

        // Se conter categorias, adiciona na seleção
        if (count($categorias) != 0) {
            $this->db->or_where_in('CategoriaCod', $categorias);
        }

        // Se conter tags, adiciona na seleção
        if (count($tags) != 0) {
            $this->db->join('tb_tagestabelecimento as te', 'te.EstabelecimentoCod = e.CodEstabelecimento', 'left');
            $this->db->or_where_in('te.TagCod', $tags);
        }

        // Limita o resultado e remove repetidos
//        $this->db->limit($config['totalResult'])->group_by('e.CodEstabelecimento');
        $this->db->group_by('e.CodEstabelecimento');

        // Pega os resultados
        $result = $this->db->get()->result_array();

        // Embaralha
        shuffle($result);

        // Atribui o retorno do resultado
        for ($i = 0; $i < $config['totalResult']; $i++) {
            if (isset($result[$i])) {
                $resultado[] = $result[$i];
            }
        }

        // Retorna o resultado
        return $resultado;
    }


}