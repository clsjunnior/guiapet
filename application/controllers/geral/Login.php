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
        $this->load->helper('user');

        /** Carregamento de models */
        $this->load->model('UsuarioM', 'usuario');
        $this->load->model('LocalizacaoM', 'localizacao');

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
            $user = $this->usuario->getByLogin($login)->result_array()[0];
            $session['usuario'] = $user;

            /** Cria uma session com todos os dados do usuario e sua localização caso tiver */
            setSesUsuario($user);
            $session['login'] = true;
            $this->session->set_userdata($session);

            redirect(site_url('dashboard'));

        }else{

            /** Carrega a View login */
            $this->load->view('geral/login');
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

        $senha = $this->input->post('senha');


        $user = $this->usuario->getByLogin($login)->result_array();


        /** Verifica se encontrou no banco */
        if (count($user) == 1) {
            $user = $user[0];

            /** Verifica se a senha informada é igual a cadastrada */
            if ($this->encrypt->decode($user['Senha']) == $senha) {
                return true;
            }
        }

        /** Retorna mensagem caso o usuario ou senha esteja errado */
        $this->form_validation->set_message('check', ' Usuário e/ou senha não existe ou incorreto.');
        return false;

    }

    public function sair(){
        $this->session->unset_userdata('login');
        $this->session->unset_userdata('usuario');
        $this->session->unset_userdata('permissao');

        redirect(site_url('login'));
    }
}