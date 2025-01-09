<?php
namespace Controller;

require 'vendor/includes/con.php';

class OwnersController
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function getNewsletterOwners()
    {
        $query = "SELECT * FROM newsletter_owners WHERE visible = 0";

        $owners = pg_query($this->con, $query);
        return json_encode($owners);
    }

    public function addOwner($email, $password)
    {
        if(empty($email) || empty($password)) {
            return json_encode(["error" => "Preencha os campos"]);
        }

        $query = "INSERT INTO newsletter_owners(email, password) VALUES($email, $password)";
        
        if(pg_query($this->con, $query)) {
            return json_encode(["success" => "Proprietário adicionado com sucesso"]);
        }
    }

    public function deleteOwner($id) 
    {
        $query = "UPDATE newsletter_members SET visible = 1 WHERE id = $id";
        pg_query($this->con , $query);
    }
}