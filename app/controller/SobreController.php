<?php 
class SobreController {
    public function index(){

        $loader = new \Twig\Loader\FilesystemLoader('app/view');
        $twig = new \Twig\Environment($loader);
        $template = $twig->load('sobre.html');

        $parametros = array();
        $conteudo = $template->render($parametros); //passando parametros para a pagina home.html, que no caso, são as postagens
        echo $conteudo;
    }
}

?>