<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Página login
 */
class Login extends CI_Controller {

    /**
     * Login constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /** Carregamento de bibliotecas */
        $this->load->library('form_validation');
        $this->load->library('encrypt');

        /** Carregamento de models */
        $this->load->model('Users', 'user');
    }

    /**
     *  Página index do login
     */
    public function index(){

        /** Regras de validação do formulario */
        $this->form_validation->set_rules('login', 'Login', 'required|trim|callback_check');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');

        /** Se foi executado o formulario e esteve OK*/
	    if ($this->form_validation->run() == true) {

	        /** @var string $login Valor do campo login do formulario*/
            $login = $this->input->post('login');
            /** @var Users $user busca o usuário no banco por login*/
            $user = $this->user->getByLogin($login)->result_array()[0];

            /** @var $session cria uma sessão com todos dados do usuario e uma login  */
            $session['user'] = $user;
            $session['login'] = true;
            $this->session->set_userdata($session);

	    }else{

	        /** Carrega a View login */
            $this->load->view('login');
        }
	}

    /**
     * Regra de formulário setado no campo login
     *
     * @param string $login
     * @return bool
     */
    public function check($login)
    {
        /** @var string $senha Senha do campo do formulario*/
            $senha = $this->input->post('senha');

        /** @var Users $user busca o usuário no banco por login*/
        $user = $this->user->getByLogin($login);

        /** Verifica se encontrou no banco */
        if (isset($user->result()[0])) {

            /** Verifica se a senha informada é igual a cadastrada */
            if ($this->encrypt->decode($user->result()[0]->password) == $senha) {
                return true;
            }
        }

        /** Retorna mensagem caso o usuario ou senha esteja errado */
        $this->form_validation->set_message('check', ' Usuário e/ou senha não existe ou incorreto.');
        return false;

    }
}