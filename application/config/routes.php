<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'geral/Inicial';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['estabelecimento/(:num)'] = 'geral/InfoEstabelecimento/index/$1';
$route['contato'] = 'geral/Contato/index';

$route['login'] = 'geral/Login';
$route['registrar'] = 'geral/Registrar';
$route['sair'] = 'geral/Login/sair';

//ADM
$route['dashboard'] = 'admin/inicial';
$route['dashboard/inicio'] = 'admin/inicial';
$route['dashboard/perfil'] = 'admin/Perfil';
$route['dashboard/estabelecimentos'] = 'admin/Estabelecimento';
$route['dashboard/estabelecimentos/novo'] = 'admin/Estabelecimento/novo';
$route['dashboard/estabelecimentos/visualizar/(:num)'] = 'admin/Estabelecimento/visualizar/$1';
$route['dashboard/estabelecimentos/editar/(:num)'] = 'admin/Estabelecimento/editar/$1';
$route['dashboard/tags'] = 'admin/Tag/index';
$route['dashboard/categorias'] = 'admin/Categoria/index';
$route['dashboard/usuarios'] = 'admin/Usuario/index';

//API
$route['api/estabelecimentos/buscaTotal'] = 'api/Estabelecimento/buscaTotal';
$route['api/estabelecimentos/buscaEsOrdenada'] = 'api/Estabelecimento/buscaEsOrdenada';
$route['api/estabelecimentos/buscaEstabelecimentoId/(:any)'] = 'api/Estabelecimento/buscaEstabelecimentoId/';
$route['api/estabelecimentos/buscaEstabelecimentoCategoria/(:num)'] = 'api/Estabelecimento/buscaEstabelecimentoCategoria/$1';
$route['api/estabelecimentos/recomendacao/(:any)'] = 'api/Estabelecimento/recomendacao/$1';
$route['api/estabelecimentos/recomendacaoTags/(:any)'] = 'api/Estabelecimento/recomendacaoTags/$1';
$route['api/estabelecimentos/raio'] = 'api/Estabelecimento/EsRaio';
//$route['api/tagsEstabelecimento/buscatges'] = 'api/TagEstabelecimento/buscaEsTg/';
$route['api/tagsEstabelecimento/buscatges/(:any)'] = 'api/TagEstabelecimento/buscaEsTg/$1';

$route['api/tags/buscaTag'] = 'api/Tag/buscaTag';
$route['api/tags/buscaTag/(:any)'] = 'api/Tag/buscaTag/$1';
$route['api/tagsEstabelecimento/buscaTag'] = 'api/TagEstabelecimento/buscaTag';
$route['api/tagsEstabelecimento/buscaTagEs/(:any)'] = 'api/TagEstabelecimento/buscaTagEs';

$route['api/avaliacao/buscaAvaliacaoEs/(:any)'] = 'api/Avaliacao/buscaAvaliacaoEs/';
$route['api/avaliacao/buscaEsAvaliacao/(:any)'] = 'api/Avaliacao/buscaEsAvaliacao/';
$route['api/avaliacao/avaliar/(:num)/(:num)'] = 'api/Avaliacao/avaliar/';
//$route['api/estabelecimentos/busca/(:any)'] = 'api/Estabelecimento/busca';
$route['api/galeria/cadastrar'] = 'api/Galeria/Cadastrar/';


$route['api/usuario/altpermissao'] = 'api/Usuario/alterarPermissao/';