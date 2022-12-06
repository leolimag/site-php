<?php 
class PostController {
    public function index($params){
        try {
            $post = Postagem::selecionarId($params);

            $loader = new \Twig\Loader\FilesystemLoader('app/view');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('single.html');

            $parametros = array();
            $parametros['id'] = $post->id;
            $parametros['titulo'] = $post->titulo;
            $parametros['conteudo'] = $post->conteudo;
            $parametros['comentarios'] = $post->comentarios;
            $conteudo = $template->render($parametros); //passando parametros para a pagina home.html, que no caso, são as postagens
            echo $conteudo;

        } catch (Exception $e){
            echo $e->getMessage();
        }
    }
}

?>