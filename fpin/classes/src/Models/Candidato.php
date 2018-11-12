<?php

namespace Fpin\Models;

use \Fpin\DB\Sql;
use \Fpin\Model;
use \Fpin\Mailer;

class Candidato extends Model{

    public function save(){

        $sql = new Sql();
        $results = $sql->select("CALL sp_candidato_save(:id, :idlocalidade, :nome, :idtipo)", array(
            ":id"=>$this->getid(),
            ":idlocalidade"=>$this->getlocalidade(),
            ":nome"=>utf8_decode($this->getnome()),
            ":idtipo"=>$this->gettipo()
        ));

        $this->setData($results[0]);
    }

    public function get($id){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_cadidato WHERE id = :idcadidato", array(":idcadidato"=>$id));

        $this->setData($results[0]);

    }

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_cadidato WHERE id = :idcadidato", array(
            ":idcadidato"=>$this->getid()));
    }

    public static function getPage( $page = 1, $itensPerPage = 10){

        $start = ($page-1) * $itensPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS
            a.id, a.nome
            FROM tb_cadidato a
            ORDER BY a.id
            LIMIT $start, $itensPerPage");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

        return ['data'=> $results,
                'total'=>(int)$resultTotal[0]["nrtotal"],
                'pages'=>ceil($resultTotal[0]["nrtotal"] / $itensPerPage)];

    }

    public static function getPageSearch($search, $page = 1, $itensPerPage = 10){


        $start = ($page-1) * $itensPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS
            a.id, a.nome
            FROM tb_cadidato a
            WHERE a.nome LIKE :search OR a.id LIKE :search
            ORDER BY a.id
            LIMIT $start, $itensPerPage", [
                ':search'=> '%'.$search.'%']);

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

        return ['data'=> $results,
                'total'=>(int)$resultTotal[0]["nrtotal"],
                'pages'=>ceil($resultTotal[0]["nrtotal"] / $itensPerPage)];

    }

}
?>