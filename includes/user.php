<?php
include 'db.php';

class User extends DB{
    private $id;
    private $nombre;
    private $username;


    public function userExists($user, $pass){

        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE user = :user AND password = :pass');
        $query->execute(['user' => $user, 'pass' => $pass]);

        if($query->rowCount()){
            return true;
        }else{
            return false;
        }
    }
//trae información del usuario logueado
    public function setUser($user){
        $query = $this->connect()->prepare('SELECT * FROM usuario WHERE user = :user');
        $query->execute(['user' => $user]);

        foreach ($query as $currentUser) {
            $this->id = $currentUser['id'];
            $this->nombre = $currentUser['name'];
            $this->usename = $currentUser['user'];
        }
    }
    public function getId(){

        return $this->id;
    }

    public function getNombre(){
        return $this->nombre;
    }
}

?>
