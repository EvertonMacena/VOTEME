<?php

namespace Fpin\Models;

use \Fpin\DB\Sql;
use \Fpin\Model;
use \Fpin\Mailer;

class Proposta extends Model{

    public function save(){

        $sql = new Sql();
        $sql->query("INSERT INTO tb_proposta (descricao, idcandidato, idtipo) VALUES (:descricao, :idcandidato, :idtipo)", [":descricao"=>$this->getdescricao(),
                                        ":idcandidato"=>$this->getidcandidato(),
                                        ":idtipo"=>$this->getidtipo()]);
    }

    public function update(){

        $sql = new Sql();
        $sql->query("UPDATE tb_proposta SET descricao = :descricao, idcandidato = :idcandidato, idtipo = :idtipo WHERE id = :id",
                                        [":descricao"=>$this->getdescricao(),
                                        ":idcandidato"=>$this->getidcandidato(),
                                        ":idtipo"=>$this->getidtipo(),
                                        ":id"=>$this->getid()]);
    }

    public function get($id){

        $sql = new Sql();

        $results = $sql->select("SELECT a.id, a.descricao, a.idcandidato, a.idtipo, b.descricao AS tipo
                                    FROM tb_proposta a
                                    INNER JOIN tb_tipo_prop b ON a.idtipo = b.id
                                    WHERE a.id = :id", array(":id"=>$id));

        $this->setData($results[0]);

    }

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_proposta WHERE id = :id", array(
            ":id"=>$this->getid()));
    }

    public static function getAllTipo(){
         $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_tipo_prop");

        return $results;
    }

}
?>