<?php
namespace Controller;

require 'vendor/includes/con.php';

class MembersController
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function getNewsletterMembers()
    {
        $query = "SELECT * FROM newsletter_members WHERE visible = 0";

        $members = pg_query($this->con, $query);
        return json_encode($members);
    }

    public function deleteMember($id) 
    {
        $query = "UPDATE newsletter_members SET visible = 1 WHERE id = $id";
        pg_query($this->con , $query);
    }
}