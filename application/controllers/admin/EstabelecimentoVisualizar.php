<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EstabelecimentoVisualizar extends CI_Controller
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

        /** Carregamentos de models */
        $this->load->model('EstabelecimentoM', 'estabelecimento');
        $this->load->model('ContatoM', 'contato');
        $this->load->model('TagM', 'tag');
        $this->load->model('TagEstabelecimentoM', 'tagestabelecimento');
//        $this->load->model('LocalizacaoM', 'localizacao');
//        $this->load->model('CategoriaM', 'categoria');

    }


    /**
     *  Página inicial de estabelecimentos
     */
    public function index($id)
    {

        if ($this->input->post("submit") == "contato") {
            $contato['TelefonePrincipal'] = $this->input->post("TelefonePrincipal");
            $contato['TelefoneSecundario'] = $this->input->post("TelefoneSecundario");
            $contato['Facebook'] = $this->input->post("Facebook");
            $contato['Twitter'] = $this->input->post("Twitter");
            $contato['Site'] = $this->input->post("Site");
            $contato['Email'] = $this->input->post("Email");
            if (isset($this->contato->getAllBy(['EstabelecimentoCod' => $id])->result_array()[0])) {
                if ($this->contato->atualizar($contato, 'EstabelecimentoCod', $id)) {
                    // SUCESSO
                } else {
                    // ERRO
                }
            } else {
                $contato['EstabelecimentoCod'] = $id;
                if ($this->contato->novo($contato)) {
                    // SUCESSO
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
        $dados['title'] = 'Visualizar Estabelecimento';
        $this->load->view('admin/visualizar_estabelecimento', $dados);
    }


}