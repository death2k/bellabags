<?php

namespace Codemy\Models;

use Codemy\Models\Model;
use Codemy\DB\Sql;

class User extends Model {

    const SESSION = "User";

    public static function login($login, $password){


        //buscar o login e senha do bd 
        $sql = new Sql();

        $results = $sql->select("SELECT * FROM tb_users WHERE  deslogin = :LOGIN", array(
            ":LOGIN"=>$login
        ));


        if (count($results) === 0) {
            
            throw new \Exception("Senha invalida ou Usuario invalido", 1);
        }

        $data = $results[0];
 
        if (password_verify($password, $data["despassword"]) === true) {
            
            $user = new User();
           // $user->setiduser($data["iduser"]);
            $user->setData($data);

            //criar a sessao do usuario 
            $_SESSION[User::SESSION] = $user->getValues();
           //objeto criado com os dados do usuario retorna ele 
           return $user;

        } else {
            throw new \Exception("Senha invalida ou Usuario invalido", 1);
        }
    }

    // verifica o login
    public static function verifyLogin($inadmin = true){
                if (        !isset($_SESSION[User::SESSION]) ||
                                   !$_SESSION[User::SESSION] || 
                !(int)$_SESSION[User::SESSION]["iduser"] > 0 || 
        (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
                ) {
                    header("Location: /admin/login");
                }
    }
    // logout 
    public static function logout(){
        $_SESSION[User::SESSION] = NULL;
        //session_destroy();
    }
}


?>