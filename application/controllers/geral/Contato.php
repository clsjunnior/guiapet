<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: Celso Junnior
 * Date: 12/12/2016
 * Time: 20:45
 */
class Contato extends CI_Controller
{

    public function index()
    {
        $dados['title'] = "Contato - Guia do Pet";


        $this->load->view('geral/contato', $dados);


    }

}