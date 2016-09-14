<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimento extends CI_Controller
{

    /**
     * Estabelecimento constructor.
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

        /** Carregamentos de helpers */
        $this->load->helper('user');

        /** Carregamento de models */
        $this->load->model('Establishments', 'establishment');
        $this->load->model('Categories', 'category');
    }


    /**
     *  Página inicial de estabelecimentos
     */
    public function index()
    {
        /** Dados para view */
        $dados['title'] = "Estabelecimentos";

        $this->load->view('admin/estabelecimentos', $dados);
    }


    public function editar($id = null){
//        $this->form_validation->set_rules('cnpj', 'CNPJ', 'required|trim|max_length[11]');
//        $this->form_validation->set_rules('photograp', 'Fotografia', 'required');

        $this->form_validation->set_rules('name',         'Nome',        'required|trim|max_length[120]');
        $this->form_validation->set_rules('website',      'Site',        'valid_url|trim|max_length[255]');
        $this->form_validation->set_rules('tel',          'Telefone',    'trim|max_length[255]');
        $this->form_validation->set_rules('category',     'Categoria',   'required|trim');
        $this->form_validation->set_rules('description',  'Descrição',   'required|trim');
        $this->form_validation->set_rules('latitude',     'Latitude',    'required');
        $this->form_validation->set_rules('longitude',    'Longitude',   'required');
        $this->form_validation->set_rules('city',         'Cidade',      'required|max_length[120]');
        $this->form_validation->set_rules('state',        'Estado',      'required|max_length[50]');
        $this->form_validation->set_rules('street',       'Endereço',    'required|max_length[255]');
        $this->form_validation->set_rules('neighborhood', 'Bairro',      'required|max_length[255]');
        $this->form_validation->set_rules('zip_code',     'CEP',         'required|max_length[9]');
        $this->form_validation->set_rules('number',       'Número',      'integer|max_length[11]');
        $this->form_validation->set_rules('complement',   'Complemento', 'max_length[255]');

        $config['upload_path'] = DIR_IMG;
        $config['allowed_types'] = 'gif|jpg|png';

        $dados['establishment'] = null;
        $dados['location'] = null;
        $estabelecimento = null;
        $localizacao = null;

        if ($id == null) {
            $dados['title'] = "Novo estabelecimento";

        }else{
            $dados['title'] = "Editar estabelecimento";
            $dados['establishment'] = $this->establishment->getById($id)->result_array()[0];
            $dados['location'] = $this->location->getById($dados['establishment']['location_id'])->result_array()[0];
        }

        if ($this->form_validation->run() == true) {

            $this->load->library('upload', $config);
            if ($this->upload->do_upload('photograp')){
                if ($id != null){
                    $estabelecimento['id'] = $dados['establishment']['id'];
                    $localizacao['id'] = $dados['establishment']['location_id'];
                }

                $localizacao['state'] = $this->input->post('state');
                $localizacao['city'] = $this->input->post('city');
                $localizacao['zip_code'] = $this->input->post('zip_code');
                $localizacao['street'] = $this->input->post('street');
                $localizacao['number'] = $this->input->post('number');
                $localizacao['neighborhood'] = $this->input->post('neighborhood');
                $localizacao['complement'] = $this->input->post('complement');
                if (isset($localizacao['id'])){
                    $this->location->updateLocation($localizacao);
                }else {
                    $idLoc = $this->location->newLocation($localizacao);
                    if ($idLoc != 0) {
                        $estabelecimento['location_id'] = $idLoc;
                    }else{
                        $dados['erros'][] = "Erro ao salvar localização";
                    }
                }
                $estabelecimento['name'] = $this->input->post('name');
                $estabelecimento['website'] = $this->input->post('website');
                $estabelecimento['description'] = $this->input->post('description');
                $estabelecimento['photograph'] = $this->upload->data()['file_name'];
                $estabelecimento['cnpj'] = str_replace(['.','-','/'],['','',''],$this->input->post('cnpj'));
                $estabelecimento['tel'] = $this->input->post('tel');
                $estabelecimento['latitude'] = $this->input->post('latitude');
                $estabelecimento['longitude'] = $this->input->post('longitude');
                $estabelecimento['user_id'] = getSesUser(['id']);
                $estabelecimento['categorie_id'] = $this->input->post('category');

                if (isset($estabelecimento['location_id'])){
                    $this->establishment->newEstablishment($estabelecimento);
                }

            }else{
                $dados['erros'] = $this->upload->display_errors();
            }

        }

        /** @noinspection ForgottenDebugOutputInspection */
        var_dump($dados);
        var_dump($estabelecimento);
        var_dump($localizacao);

        /** Retorna todas as categorias no formato de objetos */
        $dados['categories'] = $this->category->getAll()->result();

        $this->load->view('admin/novo_estabelecimento', $dados);
    }

}