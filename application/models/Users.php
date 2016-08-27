<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Users extends CI_Model {

	public function __construct(){
		parent::__construct();
	}


	public function getByLogin($login){
	    return $this->db->get_where('users', array('login' => $login));
    }

    /**
     * @param $user string
     * @return bool
     */
    public function newUser($user){
        $user['created_at'] = gmdate('Y-m-d H:i:s',time());
        return $this->db->insert('users', $user);
    }

}