<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Página login
 */
class Registrar extends CI_Controller {

    /**
     * Registrar constructor.
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
     * Página index de registrar
     */
    public function index(){

        /** Regras de validação do formulario */
        $this->form_validation->set_rules('nome', 'Nome', 'required|trim|max_length[120]');
        $this->form_validation->set_rules('sexo', 'Sexo', 'required|trim|in_list[M,F]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|trim|is_unique[users.email]|max_length[255]',[
        'is_unique' => 'O e-mail informado já está sendo utilizado.'
            ]);
        $this->form_validation->set_rules('emailc', 'Confirma e-mail', 'required|matches[email]');
        $this->form_validation->set_rules('login', 'Login', 'required|trim|is_unique[users.login]|max_length[30]',
            [
                'is_unique' => 'Login informado já está sendo utilizado.'
            ]);
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');

        /** Caso não foi executado o formulario ou não for OK */
        if ($this->form_validation->run() != true) {

            /** Carrega a view de registrar */
            $this->load->view('registrar');
        }else{

            /** @var Users $user Dados do usuario*/
            $user = [
                'name' => $this->input->post('nome'),
                'sex' => $this->input->post('sexo'),
                'login' => $this->input->post('login'),
                'password' => $this->encrypt->encode($this->input->post('senha')),
                'email' => $this->input->post('email')
            ];

            /** Grava o usuário no banco */
            $this->user->newUser($user);

            /** Cria uma mensagem temporaria e redireciona para a tela de login */
            $this->session->set_flashdata('login', '<div class="alert alert-success alert-dismissible">
                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> 
                                                    <h4><i class="icon fa fa-check-circle"></i> Bem vindo!</h4> Cadastro realizado com sucesso. </div>
                                          ');
            redirect(site_url('login'));
//            $this->session->keep_flashdata('login');
        }
	}



}