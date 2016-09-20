<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LocalizacaoM extends CI_Model {

    private $table = 'TB_Localizacao';

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
        /** Preenche o campo CriadoEm com a data e hora atual no formato do banco de dados*/
        $localizacao['CriadoEm'] = gmdate('Y-m-d H:i:s', time());
        $localizacao['AtualizadoEm'] = gmdate('Y-m-d H:i:s', time());

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
        /** Preenche o campo EditadoEm com a data e hora atual no formato do banco de dados*/
        $localizacao['AtualizadoEm'] = gmdate('Y-m-d H:i:s', time());

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



}