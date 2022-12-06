<?php 
require_once 'app/core/Core.php';
require_once 'app/Controller/HomeController.php';
require_once 'app/Controller/ErroController.php';
require_once 'app/Controller/PostController.php';
require_once 'app/Controller/SobreController.php';
require_once 'app/Controller/AdminController.php';
require_once 'app/model/Postagem.php';
require_once 'lib/database/Connection.php';
require_once 'app/model/Comentario.php';
require_once 'vendor/autoload.php'; //carrega automaticamente os componentes da vendor 

$template = file_get_contents('app/template/estrutura.html');

ob_start();
    $core = new Core();
    $core->start($_GET);
    $saida = ob_get_contents();
ob_end_clean();

$tpl = str_replace('{{dinamica}}', $saida, $template);
 
echo $tpl;
?>