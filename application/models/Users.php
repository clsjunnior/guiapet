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
     * @param string $login
     * @return CI_DB_result
     */
    public function getByLogin($login){
	    return $this->db->get_where('users', array('login' => $login));
    }

    /**
     * @param string $user
     * @return bool
     */
    public function newUser($user){
        $user['created_at'] = gmdate('Y-m-d H:i:s',time());
        return $this->db->insert('users', $user);
    }

}