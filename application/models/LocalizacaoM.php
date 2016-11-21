<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LocalizacaoM extends CI_Model {

    private $table = 'tb_localizacao';
    private $viewEstabelecimentos = 'vw_estabelecimentos';

    /**
     * Localização constructor.
     */
    public function __construct(){
        parent::__construct();
    }


    /**
     * Seleciona a localização por ID
     *
     * @param int $id
     * @return CI_DB_result
     */
    public function getById($id){

        /** Retorna o resultado da tabela TB_Localizacao onde o ID = $id */
        return $this->db->get_where($this->table, array('CodLocalizacao' => $id));
    }

    /**
     * Adiciona nova localização
     *
     * @param string $localizacao
     * @return bool
     */
    public function novaLocalizacao($localizacao)
    {
        /** Insere na tabela TB_Localizacao a localização passado com seus respectivos campos */
        return $this->db->insert($this->table, $localizacao);

    }


    /**
     * Atualiza as informações da localização
     *
     * @param $localizacao
     * @param $id
     * @return bool
     */
    public function atualizaLocalizacao($localizacao, $id)
    {
        /** Atualiza a localização onde o ID foi passado no parametro */
        $this->db->where('CodLocalizacao', $id);
        return $this->db->update($this->table, $localizacao);
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

    public function getEsRaio($latitudeAtual, $longitudeAtual)
    {

        $sql = "SELECT *, (6371 *" .
            "acos(" .
            "cos(radians(?)) *" . // lat atual
            "cos(radians(LoLatitude)) *" . // lat table
            "cos(radians(?) - radians(LoLongitude)) +" . // long atual
            "sin(radians(?)) *" . // lat atual
            "sin(radians(LoLatitude))" .
            ")) AS distancia" .
            " FROM " . $this->viewEstabelecimentos . " HAVING distancia <= 1";

        return $this->db->query($sql, array($latitudeAtual, $longitudeAtual, $latitudeAtual));
    }



}