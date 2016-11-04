<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Galeria extends CI_Controller
{
    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();


        /** Carregamento de models */
        $this->load->model('GaleriaM', 'galeria');
    }

    public function cadastrar()
    {
        //carrega a biblioteca de upload do CI
        $this->load->library('upload');

        //Configuração do upload
        //informa o diretorio para salvar as imagens
        $config['upload_path'] = DIR_IMG;
        //define os tipos de arquivos suportados
        $config['allowed_types'] = 'gif|jpg|jpeg|png';


        //Inicializa o método de upload
        $this->upload->initialize($config);

        //processa o upload e verifica o status
        if (!$this->upload->do_upload('file')) {
            //Determina o status do header
            $this->output->set_status_header('400');

            //Retorna a mensagem de erro a ser exibida
            echo $this->upload->display_errors(null, null);
        } else {

            $galeria['Arquivo'] = $this->upload->data()['file_name'];
            $galeria['EstabelecimentoCod'] = $this->input->post('EstabelecimentoCod');
            $this->galeria->cadastrar($galeria);

            //Determina o status do header
            $this->output->set_status_header('200');
        }
    }


}