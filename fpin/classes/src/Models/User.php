<?php

namespace Fpin\Models;

use \Fpin\DB\Sql;
use \Fpin\Model;
use \Fpin\Mailer;

class User extends Model{

    const SESSION = "User";
    const SECRET = "bkcstrkeyapp";
    const ERROR_REGISTER = "UserErrorRegister";

    public static function getFromSession(){

         $user = new User();

        if (isset($_SESSION[User::SESSION])&& (int)$_SESSION[User::SESSION]['id'] >0 ){

            $user->setData($_SESSION[User::SESSION]);

        }
        return $user;
    }

    public static function checkLogin($inadmin  = true){
        if (
            !isset($_SESSION[User::SESSION]) ||
            !$_SESSION[User::SESSION] ||
            !(int)$_SESSION[User::SESSION]["id"] >0
        ){
            //Ususario nao estar logado
            return false;

        } else {
            // Usuario estar logado
            if($inadmin === true && (bool)$_SESSION[User::SESSION]["admin"] === true){
                //Usuario é admin
                return true;

            } else if ($inadmin === false) {
                return true;
            } else {
                return false;
            }
        }
    }

    public static function login($login, $password){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user WHERE email = :LOGIN", array(":LOGIN"=>$login));

        if (count($results) === 0){
            throw new \Exception ("Usuário inexistente ou senha iinvalida");
        }

        $data = $results[0];

        if (password_verify($password, $data["senha"])){

            $user = new User();

            $user->setData($data);

            $_SESSION[User::SESSION] = $user->getValues();

            return $user;

        } else {
            throw new \Exception ("Usuário inexistente ou senha incorreta");
        }

    }

    public static function logout(){

        $_SESSION[User::SESSION] = NULL;
    }

    public static function verify_login($inadmin  = true){
        if (!User::checkLogin($inadmin)){

            if($inadmin){
                header("Location: /admin/login");
                exit;
            } else {
                header("Location: /login");
                exit;
            }
        }
    }

    public static function checkLoginExist($login){
       $sql = new Sql();

       $results = $sql->select("SELECT * FROM tb_user WHERE email = :deslogin", [
        ':deslogin'=>$login]);

       return (count($results)>0);
    }

    public static function checkCpfExist($cpf){
       $sql = new Sql();

       $results = $sql->select("SELECT * FROM tb_user WHERE cpf = :cpf", [
        ':cpf'=>$cpf]);

       return (count($results)>0);
    }

    public function save(){

        $sql = new Sql();
        $results = $sql->select("CALL sp_user_save(:id, :cpf, :email, :senha, :admin)", array(
            ":id"=>$this->getid(),
            ":email"=>$this->getemail(),
            ":senha"=>User::getPasswordHash($this->getsenha()),
            ":admin"=>$this->getadmin(),
            ":cpf"=>$this->getcpf()
        ));

        $this->setData($results[0]);
    }

    public static function getPasswordHash($password){
        return password_hash($password, PASSWORD_DEFAULT, [
            'cost'=>12]);
    }

    public function get($iduser){

        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user WHERE id = :iduser", array(":iduser"=>$iduser));

        $this->setData($results[0]);

    }

    public function delete(){

        $sql = new Sql();

        $sql->query("DELETE FROM tb_user WHERE id = :iduser", array(
            ":iduser"=>$this->getid()));
    }

    public static function getForgot($email){
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_user WHERE email = :email", array(":email"=>$email));

        if (count($results) === 0 ){
            throw new \Exception("Não foi possivel recuperar a senha");

        }else {

            $data = $results[0];

            $results2 = $sql->select("CALL sp_userspasswordsrecoveries_create(:iduser, :desip)", array(":iduser"=>$data["id"],
                        ":desip"=>$_SERVER["REMOTE_ADDR"]));

            if(count($results2)===0){
                throw new \Exception("Não foi possivel recuperar a senha");
            } else {
                $dataRecovery = $results2[0];

                $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length("AES-128-CBC"));

                $code = openssl_encrypt($dataRecovery['idrecovery'], "AES-128-CBC", User::SECRET,$options=OPENSSL_RAW_DATA, $iv);

                $result = base64_encode($iv.$code);


                $link = "http://www.vote.me/forgot/reset?code=$result";

                $mailer = new Mailer($data["email"], $data["name"], "REDEFINICAO DE SENHA - VOTEME", "recuperar_email_responsivo", array("name" => $data["name"], "link" => $link));

                $mailer->send();

                return $data;
            }

        }
    }
   public static function validForgotDecrypt($result)
 {
     $result = base64_decode($result);
     $code = mb_substr($result, openssl_cipher_iv_length("AES-128-CBC"), null, '8bit');
     $iv = mb_substr($result, 0, openssl_cipher_iv_length("AES-128-CBC"), '8bit');
     $idrecovery = openssl_decrypt($code, "AES-128-CBC", User::SECRET, $options=OPENSSL_RAW_DATA, $iv);

     $sql = new Sql();
     $results = $sql->select("
         SELECT *
         FROM tb_userpasswordsrecoveries a
         INNER JOIN tb_user b ON a.iduser = b.id
         WHERE
         a.idrecovery = :idrecovery
         AND
         a.dtrecovery IS NULL
         AND
         DATE_ADD(a.dtregister, INTERVAL 1 HOUR) >= NOW();
     ", array(
         ":idrecovery"=>$idrecovery
     ));

     if (count($results) === 0)
     {
         throw new \Exception("Não foi possível recuperar a senhaaaaa.");
     }
     else
     {
         return $results[0];
     }
    }

    public static function setForgotUsed($idrecovery){

        $sql = new Sql();

        $sql->query("UPDATE tb_userpasswordsrecoveries SET dtrecovery = NOW() WHERE idrecovery = :idrecovery", array(":idrecovery"=>$idrecovery));
    }

    public function setPassword($password){
        $sql = new Sql();

        $sql->query("UPDATE tb_user SET despassword = :password WHERE id = :iduser", array(":password"=>$password, ":iduser"=>$this->getid()));
    }

    public static function setErroRegister($msg){
        $_SESSION[User::ERROR_REGISTER] = $msg;
    }

    public static function getErroRegister (){
        $msg = (isset($_SESSION[User::ERROR_REGISTER]) && $_SESSION[User::ERROR_REGISTER]) ? $_SESSION[User::ERROR_REGISTER] : '';

        User::clearErroRegister();

        return $msg;
    }

    public static function clearErroRegister(){
        $_SESSION[User::ERROR_REGISTER] = NULL;
    }


    public static function getPage( $page = 1, $itensPerPage = 10){

        $start = ($page-1) * $itensPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS
            a.id, a.email, a.cpf, a.admin
            FROM tb_user a
            ORDER BY a.id
            LIMIT $start, $itensPerPage", [], "User");

        $resultTotal = $sql->select("SELECT FOUND_ROWS() AS nrtotal;");

        return ['data'=> $results,
                'total'=>(int)$resultTotal[0]["nrtotal"],
                'pages'=>ceil($resultTotal[0]["nrtotal"] / $itensPerPage)];

    }

    public static function getPageSearch($search, $page = 1, $itensPerPage = 10){


        $start = ($page-1) * $itensPerPage;

        $sql = new Sql();

        $results = $sql->select("SELECT SQL_CALC_FOUND_ROWS
            a.id, a.email, a.cpf, a.admin
            FROM tb_user a
            WHERE a.cpf LIKE :search OR a.email LIKE :search
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