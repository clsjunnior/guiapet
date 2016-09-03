<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller
{

    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();

        /** Caso não esteja logado redireciona para a pagina de login */
        if (!$this->session->has_userdata('login')) {
            redirect(site_url('login'));
        }

        /** Carregamento de bibliotecas */
        $this->load->library('form_validation');
        $this->load->library('encrypt');

        /** Carregamentos de helpers */
        $this->load->helper('user');

        /** Carregamento de models */
        $this->load->model('Users', 'user');
        $this->load->model('Locations', 'location');
    }


    /**
     *  Página inicial do perfil
     */
    public function index()
    {
        /** Dados para view */
        $dados['title'] = "Editar perfil";
        $dados['user'] = getSesUser();
        $dados['location'] = getSesLocation();

        /** Seta as regras para o formulario caso seja edição de perfil */
        if ($this->input->post('submit') == 'perfil') {
            $this->setRulesPerfil();
        }

        /** Seta as regras para o formulario caso seja edição de localização */
        if ($this->input->post('submit') == 'localizacao') {
            $this->setRulesLocalizacao();
        }

        /** Se executou o formulario */
        if ($this->form_validation->run() == true) {

            /** Caso executou o formulario de perfil */
            if ($this->input->post('submit') == 'perfil') {

                /** Preenche dados para o banco */
                $user['name'] = $this->input->post('name');
                $user['sex'] = $this->input->post('sex');
                $user['tel'] = $this->input->post('tel');
                if ($this->input->post('password')) {
                    $user['password'] = $this->encrypt->encode($this->input->post('password'));
                }

                /** Salva no banco, atualiza a session e cria a mensagem se sucesso */
                if ($this->user->updateUser($user, getSesUser(['id']))) {
                    setSesUser($this->user->getByLogin(getSesUser(['login']))->result_array()[0]);
                    $this->session->set_flashdata('perfil', $this->mensagem('alert-success', 'fa-check', 'Sucesso!', 'Dados atualizados com sucesso!'));
                } else {
                    $this->session->set_flashdata('perfil', $this->mensagem('alert-warning', 'fa-warning', 'Ops!', 'Erro ao atualizar dados, tente mais tarde, caso o problema persistir entre em contato!'));
                }
            }

            /** Caso executou o formulario de localizacao */
            if ($this->input->post('submit') == 'localizacao') {
                $location['state'] = $this->input->post('state');
                $location['city'] = $this->input->post('city');
                $location['zip_code'] = $this->input->post('zip_code');
                $location['street'] = $this->input->post('street');
                $location['number'] = $this->input->post('number');
                $location['neighborhood'] = $this->input->post('neighborhood');
                $location['complement'] = $this->input->post('complement');

                /** Caso o usuario ja tenha uma localização */
                if (getSesUser(['location_id']) != null) {

                    /** Atualiza a localização e a session */
                    if ($this->location->updateLocation($location, getSesUser(['location_id']))) {

                        setSesLocation($this->location->getById(getSesUser(['location_id']))->result_array()[0]);

                        $this->session->set_flashdata('perfil', $this->mensagem('alert-success', 'fa-check', 'Sucesso!', 'Dados atualizados com sucesso!'));
                    } else {
                        $this->session->set_flashdata('perfil', $this->mensagem('alert-warning', 'fa-warning', 'Ops!', 'Erro ao atualizar dados, tente mais tarde, caso o problema persistir entre em contato!'));
                    }

                } else {

                    /** Cria nova localização */
                    if ($this->location->newLocation($location)) {
                        $user = null;
                        $user['location_id'] = $this->location->getIdLastInsert();

                        /** Atualiza o usuario e as session */
                        if ($this->user->updateUser($user, getSesUser(['id']))) {
                            setSesUser($this->user->getByLogin(getSesUser(['login']))->result_array()[0]);
                            setSesLocation($this->location->getById(getSesUser(['location_id']))->result_array()[0]);
                            $this->session->set_flashdata('perfil', $this->mensagem('alert-success', 'fa-check', 'Sucesso!', 'Dados atualizados com sucesso!'));
                        } else {
                            $this->session->set_flashdata('perfil', $this->mensagem('alert-warning', 'fa-warning', 'Ops!', 'Erro ao atualizar dados, tente mais tarde, caso o problema persistir entre em contato!'));
                        }
                    } else {
                        $this->session->set_flashdata('perfil', $this->mensagem('alert-warning', 'fa-warning', 'Ops!', 'Erro ao atualizar dados, tente mais tarde, caso o problema persistir entre em contato!'));
                    }
                }
            }

        }
        $this->load->view('admin/perfil', $dados);
    }


    /**
     * Regra de validação para checar se a senha é igual a anterior
     *
     * @param $senha
     * @return bool
     */
    public function check($senha)
    {
        /** Verifica se a senha informada é igual a atual */
        if ($this->encrypt->decode(getSesUser(['password'])) == $senha) {
            return true;
        }

        /** Retorna mensagem caso o usuario ou senha esteja errado */
        $this->form_validation->set_message('check', 'Senha atual incorreta');
        return false;

    }

    /**
     * Validações de perfil
     */
    private function setRulesPerfil()
    {
        $this->form_validation->set_rules('name', 'Nome', 'required|trim|max_length[120]');
        $this->form_validation->set_rules('sex', 'Sexo', 'required|trim|in_list[M,F]');
        $this->form_validation->set_rules('tel', 'Telefone', 'trim');
        $this->form_validation->set_rules('password', 'Nova senha', 'trim');
        $this->form_validation->set_rules('passwordConf', 'Confirmação', 'trim|matches[password]');
        $this->form_validation->set_rules('passwordAtual', 'Senha atual', 'trim|required|callback_check');
    }

    /**
     * Validações de localização
     */
    private function setRulesLocalizacao()
    {
        $this->form_validation->set_rules('state', 'Estado', 'trim|max_length[50]');
        $this->form_validation->set_rules('city', 'Cidade', 'trim|max_length[120]');
        $this->form_validation->set_rules('zip_code', 'Cep', 'trim|max_length[9]');
        $this->form_validation->set_rules('street', 'Endereço', 'trim|max_length[255]');
        $this->form_validation->set_rules('neighborhood', 'Bairro', 'trim|max_length[255]');
        $this->form_validation->set_rules('complement', 'Complemento', 'trim|max_length[255]');
    }

    /**
     * Cria Box com a mensagem
     *
     * @param $tipo
     * @param $icone
     * @param $titulo
     * @param $mensagem
     * @return string
     */
    private function mensagem($tipo, $icone, $titulo, $mensagem)
    {
        $texto = '<div class="row">';
        $texto .= '<div class="col-xs-12 col-sm-6 col-sm-offset-3">';
        $texto .= "<div class='alert $tipo alert-dismissible'>";
        $texto .= '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>';
        $texto .= "<h4><i class='icon fa $icone'></i>$titulo</h4>";
        $texto .= $mensagem;
        $texto .= "</div></div></div>";
        return $texto;
    }

}