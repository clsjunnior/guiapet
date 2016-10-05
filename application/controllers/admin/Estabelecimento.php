<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estabelecimento extends CI_Controller
{

    private $estabelecimentoP;
    private $localizacaoP;

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

        /** Carregamentos de models */
        $this->load->model('EstabelecimentoM', 'estabelecimento');
        $this->load->model('LocalizacaoM', 'localizacao');
        $this->load->model('CategoriaM', 'categoria');

        $this->estabelecimentoP = null;
        $this->localizacaoP = null;
    }


    /**
     *  Página inicial de estabelecimentos
     */
    public function index()
    {
        /** Dados para view */
        $dados['title'] = 'Estabelecimentos';
        $dados['estabelecimentos'] = $this->estabelecimento->getAllBy(['UsCodUsuario' => getSesUser(['CodUsuario'])])->result_array();

        $this->load->view('admin/estabelecimentos', $dados);
    }


    public function editar($id = null){

//      Rule
        $this->rulesEstabelecimento();
        $this->rulesLocation();

        $config['upload_path'] = DIR_IMG;
        $config['allowed_types'] = 'gif|jpg|png';

        $dados['establishment'] = null;
        $dados['location'] = null;

        if ($id == null) {
            $dados['title'] = 'Novo estabelecimento';

        }else{
            $dados['title'] = 'Editar estabelecimento';
            $dados['establishment'] = $this->estabelecimento->getById($id)->result_array()[0];
            $dados['location'] = $this->localizacao->getById($dados['establishment']['location_id'])->result_array()[0];
        }

        if ($this->form_validation->run() == true) {

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photograp')) {
                $infoIMG = $this->upload->data();
//                if ($id != null){
//                    $estabelecimento['id'] = $dados['establishment']['id'];
//                    $localizacao['id'] = $dados['establishment']['location_id'];
//                }
//

//                if (isset($localizacao['id'])){
//                    $this->localizacao->atualizaLocalizacao($localizacao,$id);
//                }else {
                $this->preencheLocalizacao();

                if ($this->localizacao->novaLocalizacao($this->localizacaoP)) {
                    $this->estabelecimentoP['LocalizacaoCod'] = $this->localizacao->getIdLastInsert();

                    }else{
                        $dados['erros'][] = 'Erro ao salvar localização';
                    unlink(DIR_IMG . "/" . $infoIMG['file_name']);
                    }
//                }
//                $estabelecimento['name'] = $this->input->post('name');
//                $estabelecimento['website'] = $this->input->post('website');
//                $estabelecimento['description'] = $this->input->post('description');
//                $estabelecimento['photograph'] = $this->upload->data()['file_name'];
//                $estabelecimento['cnpj'] = preg_replace('/[^0-9]/', '',$this->input->post('cnpj'));
//                $estabelecimento['tel'] = $this->input->post('tel');
//                $estabelecimento['latitude'] = $this->input->post('latitude');
//                $estabelecimento['longitude'] = $this->input->post('longitude');
//                $estabelecimento['user_id'] = getSesUser(['id']);
//                $estabelecimento['categorie_id'] = $this->input->post('category');
//
//                if (isset($estabelecimento['location_id'])){
                $this->preencheEstabelecimento();
                $this->estabelecimento->novoEstabelecimento($this->estabelecimentoP);
//                }
//
//            }else{
//                $dados['erros'] = $this->upload->display_errors();
//            }
//            $this->session->set_flashdata('estabelecimentos', '<div class="alert alert-success alert-dismissible">
//                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
//                                                    <h4><i class="icon fa fa-check-circle"></i> Estabelecimento cadastrado com sucesso!</h4>
//                                                    O estabelecimento <b>'.$estabelecimento['name'].'</b> foi cadastrado com sucesso
//                                                    </div> ');
//            redirect(site_url('dashboard/estabelecimentos'));
            } else {
                $dados['erros'][] = "Erro ao salvar imagem, tente novamente mais tarde";
            }
        }

        /** Retorna todas as categorias no formato de objetos */
        $dados['categories'] = $this->categoria->getAll()->result();

        $this->load->view('admin/novo_estabelecimento', $dados);
    }

    private function rulesEstabelecimento()
    {
        $this->form_validation->set_rules('name', 'Nome', 'required|trim|max_length[120]');
//        $this->form_validation->set_rules('cnpj',      'CNPJ',      'required|trim|max_length[18]|callback_validaCNPJ');
        $this->form_validation->set_rules('category', 'Categoria', 'required|trim');
        $this->form_validation->set_rules('description', 'Descrição', 'required|trim');
    }

    private function rulesLocation()
    {
        $this->form_validation->set_rules('state', 'Estado', 'trim|max_length[50]');
        $this->form_validation->set_rules('city', 'Cidade', 'trim|max_length[120]');
        $this->form_validation->set_rules('zip_code', 'Cep', 'trim|max_length[9]');
        $this->form_validation->set_rules('street', 'Endereço', 'trim|max_length[255]');
        $this->form_validation->set_rules('number', 'Número', 'integer|max_length[11]');
        $this->form_validation->set_rules('neighborhood', 'Bairro', 'trim|max_length[255]');
        $this->form_validation->set_rules('complement', 'Complemento', 'trim|max_length[255]');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
    }

    private function preencheLocalizacao()
    {
        $this->localizacaoP['Estado'] = $this->input->post('state');
        $this->localizacaoP['Cidade'] = $this->input->post('city');
        $this->localizacaoP['Cep'] = $this->input->post('zip_code');
        $this->localizacaoP['Rua'] = $this->input->post('street');
        $this->localizacaoP['Numero'] = $this->input->post('number');
        $this->localizacaoP['Bairro'] = $this->input->post('neighborhood');
        $this->localizacaoP['Complemento'] = $this->input->post('complement');
        $this->localizacaoP['Latitude'] = $this->input->post('latitude');
        $this->localizacaoP['Longitude'] = $this->input->post('longitude');
    }

    private function preencheEstabelecimento()
    {
        $cnpj = $this->input->post('cnpj');
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        $this->estabelecimentoP['CategoriaCod'] = $this->input->post('category');
        $this->estabelecimentoP['UsuarioCod'] = getSesUser(['CodUsuario']);
        $this->estabelecimentoP['Nome'] = $this->input->post('name');
        $this->estabelecimentoP['Descricao'] = $this->input->post('description');
        $this->estabelecimentoP['Foto'] = $this->upload->data()['file_name'];
        $this->estabelecimentoP['CNPJ'] = $cnpj;
    }

    public function visualizar($id)
    {
        $dados['estabelecimento'] = $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result_array()[0];
        $dados['title'] = 'Visualizar: ' . $dados['estabelecimento']['EsNome'];
        $this->console->info("Select estabelecimentos:");
        $this->console->info($dados['estabelecimento']);
        $this->load->view('admin/visualizar_estabelecimento', $dados);
    }

    public function validaCNPJ($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14) {
            $this->form_validation->set_message('validaCNPJ', ' CNPJ inválido.');
            return false;
        }

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
            $this->form_validation->set_message('validaCNPJ', ' CNPJ inválido.');
            return false;
        }

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6; $i < 13; $i++) {
            $j = ($j == 2) ? 9 : $j - 1;
        }
        return true;

    }

}