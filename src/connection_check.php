<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Connected {
    private $connected;

    private function connect_Check(){
        session_start();
        if(isset($_SESSION['user'] )&& isset($_SESSION['role'])){
            $this->connected = true;
        }else{
            $this->connected = false;
        }
        return $this->connected;
    }
    public function relocalisation_Connect_Check(){
        if(!($this->connect_Check())){
            header('Location:index.php');
        }
    }
    public function relocation_connected(){
        if($this->connect_Check()){
            return true;
        }
    }
}
