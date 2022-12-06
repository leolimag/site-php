<?php

class Comentario {

    public static function selecionarComentarios($id){
        $con = Connection::getCon();
        $sql = "select * from comentario where id_postagem = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT);
        $sql->execute();

        $res = array();

        while ($row = $sql->fetchObject('Comentario')) {
            $res[] = $row;
        }

        return $res;
    }
}

?>