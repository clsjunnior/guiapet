<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Usuario extends CI_Controller
{
    /**
     * Perfil constructor.
     */
    public function __construct()
    {
        parent::__construct();


        /** Carregamento de models */
        $this->load->model('UsuarioM', 'usuario');
        $this->load->model('PermissaoM', 'permissao');
    }

    public function alterarPermissao()
    {
        $this->output->set_content_type('application/json');

        $idUser = $this->input->post('id');
        $idPer = $this->input->post('permissao');

        $this->usuario->alteraPermissao($idUser, $idPer);

        echo $this->permissao->getWhere(['CodPermissao' => $idPer])->result_array()[0]['Nome'];
    }

}