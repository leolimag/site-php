<?php

class Postagem {
    public static function selecionaTodos(){
        $con = Connection::getCon();
        $sql = "select * from postagem order by id desc";
        $sql =  $con->prepare($sql);
        $sql->execute();

        $res = array();

        while ($row = $sql->fetchObject('Postagem')){
            $res[] = $row;
        }
        if (!$res){
            throw new Exception("Não foi encontrado nenhum registro no banco.");
        }
        return $res;
    }

    public static function selecionarId($id){
        $con = Connection::getCon();
        $sql = "select * from postagem where id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id, PDO::PARAM_INT); //método para trocar o valorde :id
        $sql->execute();

        $res = $sql->fetchObject('Postagem');

        if (!$res){
            throw new Exception("Não foi encontrado nenhum registro no banco.");
        } else {
            $res->comentarios = Comentario::selecionarComentarios($res->id);
        }

        return $res;
    }

    public static function insert($dadosPost){
        if (empty($dadosPost['titulo']) or empty($dadosPost['conteudo'])){
            throw new Exception("Preencha todos os campos.");
            return false;
        }

        $con = Connection::getCon();
        $sql = "insert into postagem (titulo, conteudo) values (:tit, :cont)";
        $sql = $con->prepare($sql);
        $sql->bindValue(':tit', $dadosPost['titulo']);
        $sql->bindValue(':cont', $dadosPost['conteudo']);
        $res = $sql->execute();

        if($res == 0){
            throw new Exception("Falha ao inserir publicação.");
            return false;
        }

        return true;
    }

    public static function update($params){
        $con = Connection::getCon();
        $sql = "update postagem set titulo = :tit, :cont where id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':tit', $params['titulo']);
        $sql->bindValue(':cont', $params['conteudo']);
        $sql->bindValue(':id', $params['id']);
        $res = $sql->execute();

        if ($res == 0){
            throw new Exception("Falha ao alterar publicação.");
            return false;
        }
        return true;
    }

    public static function delete($id){
        $con = Connection::getCon();
        $sql = "delete from postagem where id = :id";
        $sql = $con->prepare($sql);
        $sql->bindValue(':id', $id);
        $res = $sql->execute();

        if ($res == 0){
            throw new Exception("Falha ao deletar publicação.");
            return false;
        }
        return true;
    }
}

?>