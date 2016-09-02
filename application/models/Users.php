<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Model {

    /**
     * Users constructor.
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
	    return $this->db->get_where('users', array('login' => $login));
    }

    /**
     * Adiciona novo usuario no banco
     *
     * @param string $user
     * @return bool
     */
    public function newUser($user){
        /** Preenche o campo created_at com a data e hora atual no formato do banco de dados*/
        $user['created_at'] = gmdate('Y-m-d H:i:s',time());

        /** Insere na tabela users o usuario passado com seus respectivos campos */
        return $this->db->insert('users', $user);
    }

}