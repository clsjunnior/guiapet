<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Perfil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if(!$this->session->has_userdata('login')){
            redirect(site_url('login'));
        }

        /** Carregamento de bibliotecas */
        $this->load->library('form_validation');
        $this->load->library('encrypt');

        /** Carregamento de models */
        $this->load->model('Users', 'user');
        $this->load->model('Locations', 'location');
    }

	public function index(){
        $dados['title'] = "Editar perfil";
        $dados['user'] = $this->session->userdata('user');
        $dados['location'] = (isset($dados['user']['location']) ? $dados['user']['location'] : null);

        /** Seta as regras para o formulario caso seja edição de perfil ou localização */
        if ($this->input->post('perfil')){
            $this->form_validation->set_rules('name', 'Nome', 'required|trim|max_length[120]');
//            $this->form_validation->set_rules('email', 'E-mail', 'required|trim|is_unique[users.email]|max_length[255]',[
//                'is_unique' => 'O e-mail informado já está sendo utilizado.'
//            ]);
            $this->form_validation->set_rules('sex', 'Sexo', 'required|trim|in_list[M,F]');
            $this->form_validation->set_rules('tel', 'Telefone', 'trim');
            $this->form_validation->set_rules('password', 'Senha', 'trim');
            $this->form_validation->set_rules('passwordConf', 'Confirmação', 'trim|matches[password]');
            $this->form_validation->set_rules('passwordAtual', 'Senha atual', 'trim|required|callback_check');
        }elseif ($this->input->post('localizacao')){
            $this->form_validation->set_rules('state', 'Estado', 'trim|max_length[50]');
            $this->form_validation->set_rules('city', 'Cidade', 'trim|max_length[120]');
            $this->form_validation->set_rules('zip_code', 'Cep', 'trim|max_length[9]');
            $this->form_validation->set_rules('street', 'Endereço', 'trim|max_length[255]');
            $this->form_validation->set_rules('neighborhood', 'Bairro', 'trim|max_length[255]');
            $this->form_validation->set_rules('complement', 'Complemento', 'trim|max_length[255]');
        }

        if ($this->form_validation->run() != true) {
            $this->load->view('admin/perfil', $dados);
        }else{

            $this->load->view('admin/perfil', $dados);
        }
	}


    public function check($senha)
    {
        $user = $this->session->userdata('user');

            /** Verifica se a senha informada é igual a atual */
            if ($this->encrypt->decode($user['password']) == $senha) {
                return true;
            }

        /** Retorna mensagem caso o usuario ou senha esteja errado */
        $this->form_validation->set_message('check', 'Senha atual incorreta');
        return false;

    }

}