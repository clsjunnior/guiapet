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
        $this->load->model('ContatoM', 'contato');
        $this->load->model('UsuarioM', 'usuario');
        $this->load->model('AvaliacaoM', 'avaliacao');
        $this->load->model('TagEstabelecimentoM', 'tagestabelecimento');
        $this->load->model('PermissaoM', 'permissao');
        $this->load->model('GaleriaM', 'galeria');

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

    public function visualizar($id)
    {

        if ($this->input->post("submit") == "contato") {
            $contato['TelefonePrincipal'] = $this->input->post("TelefonePrincipal");
            $contato['TelefoneSecundario'] = $this->input->post("TelefoneSecundario");
            $contato['Facebook'] = $this->input->post("Facebook");
            $contato['Twitter'] = $this->input->post("Twitter");
            $contato['Site'] = $this->input->post("Site");
            $contato['Email'] = $this->input->post("Email");

            $contAtual = $this->contato->getAllBy(['CodContato' => $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result_array()[0]['EsContatoCod']])->result_array();

            if ($contAtual) {
                if ($this->contato->atualizar($contato, 'CodContato', $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result_array()[0]['EsContatoCod'])) {

                } else {
                    // ERRO
                }
            } else {
                if ($this->contato->novo($contato)) {
                    $this->estabelecimento->atualizar(['ContatoCod' => $this->contato->getIdLastInsert()], $id);
                } else {
                    // ERRO
                }
            }
        } elseif ($this->input->post("submit") == "tag") {
            $tags = explode(",", $this->input->post("tags"));
            $this->estabelecimento->adicionaTags($id, $tags);
        }

        $dados['estabelecimento'] = $this->estabelecimento->getAllBy(['EsCodEstabelecimento' => $id])->result()[0];
        $dados['tags'] = $this->tagestabelecimento->gtNmTagByEstabelecimento($id)->result_array();
        $dados['avaliacao'] = $this->avaliacao->getByIdEs($id)->result_array()[0];
        $dados['galeria'] = $this->galeria->get(['EstabelecimentoCod' => $id])->result_array();
        $dados['title'] = 'Visualizar Estabelecimento';
        $this->load->view('admin/visualizar_estabelecimento', $dados);
    }

    public function novo()
    {

//      Rule
        $this->rulesEstabelecimento();
        $this->rulesLocation();

        $config['upload_path'] = DIR_IMG;
        $config['allowed_types'] = 'gif|jpg|png';

        $dados['establishment'] = null;
        $dados['location'] = null;

        $dados['title'] = 'Novo estabelecimento';
        $dados['id'] = '';

        if ($this->form_validation->run() == true) {
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('photograp')) {
                $this->preencheLocalizacao();

                if ($this->localizacao->novaLocalizacao($this->localizacaoP)) {
                    $this->estabelecimentoP['LocalizacaoCod'] = $this->localizacao->getIdLastInsert();

                    $this->preencheEstabelecimento();

                    $this->estabelecimento->novoEstabelecimento($this->estabelecimentoP);

                    $idUlt = $this->estabelecimento->getIdLastInsert();

                    $this->session->set_flashdata('estabelecimentos', '<div class="alert alert-success alert-dismissible">
                                                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> 
                                                    <h4><i class="icon fa fa-check-circle"></i> Estabelecimento cadastrado com sucesso!</h4>
                                                    O estabelecimento <b>' . $this->estabelecimentoP['Nome'] . '</b> foi cadastrado com sucesso
                                                    </div> ');

                } else {
                    $dados['erros'][] = 'Erro ao salvar localização';
                }

            } else {
                $dados['erros'][] = "Erro ao salvar imagem, tente novamente mais tarde";
            }

            if (getSesPermissao(['CodPermissao']) == 1) {
                $this->usuario->alteraPermissao(getSesUser(['CodUsuario']), 2);
                $session['permissao'] = $this->permissao->getWhere(['CodPermissao' => getSesUser(['CodUsuario'])])->result_array()[0];
                $this->session->set_userdata($session);
            }

            redirect(site_url('dashboard/estabelecimentos/visualizar/' . $idUlt));
        } else {
            $dados['erros'][] = validation_errors();
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
        if ($_FILES['photograp']['name'] != '') {
            $this->estabelecimentoP['Foto'] = $this->upload->data()['file_name'];
        }
        $this->estabelecimentoP['Descricao'] = $this->input->post('description');
        $this->estabelecimentoP['CNPJ'] = $cnpj;
    }

    public function editar($id)
    {

//      Rule
        $this->rulesEstabelecimento();
        $this->rulesLocation();

        $config['upload_path'] = DIR_IMG;
        $config['allowed_types'] = 'gif|jpg|png';

        $dados['establishment'] = $this->estabelecimento->getById($id)->result_array()[0];
        $dados['location'] = $this->localizacao->getById($dados['establishment']["LocalizacaoCod"])->result_array()[0];

        $dados['title'] = 'Editar estabelecimento';
        $dados['id'] = $id;

        if ($this->form_validation->run() == true) {

            if ($_FILES['photograp']['name'] != '') {
                echo 1;
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('photograp')) {

                    $this->preencheLocalizacao();
                    if ($this->localizacao->atualizaLocalizacao($this->localizacaoP, $dados['establishment']["LocalizacaoCod"])) {
                        $this->estabelecimentoP['LocalizacaoCod'] = $dados['establishment']["LocalizacaoCod"];

                        if ($this->upload->data()['file_name']) {
                            unlink(DIR_IMG . "/" . $dados['establishment']['Foto']);
                        }

                        $this->preencheEstabelecimento();

                        $this->estabelecimento->atualizar($this->estabelecimentoP, $dados['establishment']["CodEstabelecimento"]);

                    } else {
                        $dados['erros'][] = 'Erro ao salvar localização';
                    }

                } else {
                    $dados['erros'][] = "Erro ao salvar imagem, tente novamente mais tarde";
                }
            } else {

                $this->preencheLocalizacao();
                if ($this->localizacao->atualizaLocalizacao($this->localizacaoP, $dados['establishment']["LocalizacaoCod"])) {
                    $this->estabelecimentoP['LocalizacaoCod'] = $dados['establishment']["LocalizacaoCod"];

                    $this->preencheEstabelecimento();
                    $this->estabelecimento->atualizar($this->estabelecimentoP, $dados['establishment']["CodEstabelecimento"]);

                } else {
                    $dados['erros'][] = 'Erro ao salvar localização';
                }
            }

            redirect(site_url('dashboard/estabelecimentos/visualizar/' . $id));
        }else{
            $dados['erros'][] = validation_errors();
        }

        /** Retorna todas as categorias no formato de objetos */
        $dados['categories'] = $this->categoria->getAll()->result();
        $this->load->view('admin/editar_estabelecimento', $dados);
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