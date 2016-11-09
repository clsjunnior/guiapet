<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UsuarioM extends CI_Model {

    private $table = 'tb_usuario';

    /**
     * Usuario constructor.
     */
    public function __construct(){
        parent::__construct();
    }


    /**
     * Seleciona o usuario pelo login e retorna o resultado
     *
     * @param string $login
     * @return CI_DB_result
     */
    public function getByLogin($login){

        /** Retorna o resultado da tabela users onde o Login = $login */
        return $this->db->get_where($this->table, array('Login' => $login));
    }

    /**
     * Adiciona novo usuario no banco
     *
     * @param string $usuario
     * @return bool
     */
    public function novoUsuario($usuario)
    {
        /** Insere na tabela TB_Usuario o usuario passado com seus respectivos campos */
        $usuario['PermissaoCod'] = 1;
        return $this->db->insert($this->table, $usuario);
    }


    /**
     * Atualiza o usuario
     *
     * @param $usuario
     * @param $id
     * @return bool
     */
    public function atualizaUsuario($usuario, $id)
    {
        /** Atualiza o usuario onde o ID foi passado no parametro */
        $this->db->where('CodUsuario', $id);
        return $this->db->update($this->table, $usuario);
    }

    public function alteraPermissao($codUsuario, $codPermissao)
    {

        $usuario['PermissaoCod'] = $codPermissao;
        $this->db->where('CodUsuario', $codUsuario);
        return $this->db->update($this->table, $usuario);
    }

    public function listUsersPgAdm()
    {
        $this->db->select('ur.CodUsuario as UrCodUsuario, ur.Nome as UrNome, ur.Login as UrLogin, count(es.CodEstabelecimento) as qtdEst, pe.Nome as PeNome');
        $this->db->from("$this->table as ur");
        $this->db->join("tb_permissao as pe", "ur.PermissaoCod = pe.CodPermissao", 'inner');
        $this->db->join("tb_estabelecimento as es", "ur.CodUsuario = es.UsuarioCod", 'left');
        $this->db->group_by("UrCodUsuario");
        return $this->db->get();
    }
}