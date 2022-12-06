<?php 
class HomeController {
    public function index(){
        try {
            $colecPostagens = Postagem::selecionaTodos();

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('home.html');

            $parametros = array();
            $parametros['postagens'] = $colecPostagens;
            $conteudo = $template->render($parametros); //passando parametros para a pagina home.html, que no caso, são as postagens
            echo $conteudo;

        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

?>