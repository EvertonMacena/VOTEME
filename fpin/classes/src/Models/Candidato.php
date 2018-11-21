<?php

namespace Fpin\Models;

use \Fpin\DB\Sql;
use \Fpin\Model;
use \Fpin\Mailer;

class Candidato extends Model{

    public function save(){

        $sql = new Sql();
        $results = $sql->select("CALL sp_candidato_save(:id, :numero, :idlocalidade, :nome, :idtipo, :partido, :img)", array(
            ":id"=>$this->getid(),
            ":numero"=>$this->getnumero(),
            ":idlocalidade"=>$this->getidlocalidade(),
            ":nome"=>utf8_decode($this->getnome()),
            ":idtipo"=>$this->getidtipo(),
            ":partido"=>$this->getpartido(),
            ":img"=>$this->getimg()
        ));

        $this->setData($results[0]);
    }

    public function get($id){

        $sql = new Sql();

        $results = $sql->select("SELECT a.id, a.numero, a.idlocalidade, a.nome, a.idtipo, a.photo, a.partido AS idpartido, b.descricao AS tipo, c.estado AS localidade, d.sigla AS partido
                        FROM tb_cadidato a
                        INNER JOIN tb_tipo b ON a.idtipo = b.id
                        INNER JOIN tb_localidade c ON a.idlocalidade = c.id
                        INNER JOIN tb_partido d ON a.partido = d.id
                        WHERE a.id = :idcadidato", array(":idcadidato"=>$id));

        $this->setData($results[0]);

    }

    public static function getAllLocation($location){

        $sql = new Sql();

        $results = $sql->select("SELECT a.id, a.numero, a.idlocalidade, a.nome, a.idtipo, a.photo, a.partido AS idpartido, b.descricao AS tipo, c.estado AS localidade, d.sigla AS partido
                        FROM tb_cadidato a
                        INNER JOIN tb_tipo b ON a.idtipo = b.id
                        INNER JOIN tb_localidade c ON a.idlocalidade = c.id
                        INNER JOIN tb_partido d ON a.partido = d.id
                        WHERE c.estado = :localidade
                        ORDER BY a.numero", array(":localidade"=>$location));

        return $results;

    }

    public function getPropostas(){

        $sql = new Sql();

        $results = $sql->select("SELECT a.id, a.descricao, a.idtipo, b.descricao AS tipo
                                FROM tb_proposta a
                                INNER JOIN tb_tipo_prop b ON a.idtipo = b .id
                                WHERE a.idcandidato = :idcadidato
                                ORDER BY tipo", array(":idcadidato"=>$this->getid()));

        return $results;

    }

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_cadidato WHERE id = :idcadidato", array(
            ":idcadidato"=>$this->getid()));
    }

    public function uploadImg($file){

        $extension = explode('.', $file->getClientFilename());

        $extension = end($extension);
        $newFile = "avatar".$this->getid().".".$extension;

        $dirTemp = $_SERVER["DOCUMENT_ROOT"].DIRECTORY_SEPARATOR."res".DIRECTORY_SEPARATOR."images".DIRECTORY_SEPARATOR."candidatos".DIRECTORY_SEPARATOR.$newFile;
        $file->moveTo($dirTemp);

        \Cloudinary :: config ( array (
                                    "cloud_name" => Cloudinary::CLOUD_NAME ,
                                    "api_key" => Cloudinary::API_KEY ,
                                    "api_secret" => Cloudinary::API_SECRET
        ));
        $response = \Cloudinary\Uploader::upload($dirTemp, $options = array ());
        $url = $response['url'];
        $sql = new Sql();
        $sql->query("UPDATE tb_cadidato SET photo = :url WHERE id = :id",[":url"=>$url, ":id"=>$this->getid()]);
        unlink($dirTemp);

        return $url;
    }

    public static function getAllTipo(){
         $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_tipo");

        return $results;
    }

    public static function getAllPartido(){
         $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_partido");

        return $results;
    }

    public static function getAllLocalidade(){
         $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_localidade");

        return $results;
    }

    public static function getPage( $page = 1, $itensPerPage = 10){

        $start = ($page-1) * $itensPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS
            a.id, a.numero, a.nome, b.estado AS localidade, c.sigla AS partido
            FROM tb_cadidato a
            INNER JOIN tb_localidade b ON a.idlocalidade = b.id
            INNER JOIN tb_partido c ON a.partido = c.id
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