<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        $this->load->model('Users', 'user');

//        if ($this->session->has_userdata('user_login') && $this->session->has_userdata('user_nome') && $this->session->has_userdata('user_id')) {
//            redirect(site_url('dashboard'));
//        }
    }

	public function index(){

        $this->form_validation->set_rules('login', 'Login', 'required|trim|callback_check');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');

	    if ($this->form_validation->run() == true) {
            $login = $this->input->post('login');

            $user = $this->user->getByLogin($login);
            $user = $user->result_array()[0];

            $session['user'] = $user;
            $session['login'] = true;
            $this->session->set_userdata($session);


	    }else{

            $this->load->view('login');
        }
	}

    public function check($login, $senha = null)
    {
        if ($senha == null){
            $senha = $this->input->post('senha');
        }

        $user = $this->user->getByLogin($login);

        if (isset($user->result()[0])) {
            if ($this->encrypt->decode($user->result()[0]->password) == $senha) {
                return true;
            }
        }
        $this->form_validation->set_message('check', ' Usuário e/ou senha não existe ou incorreto.');
        return false;

    }
}