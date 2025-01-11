<?php
namespace Controller;

require __DIR__.'/../includes/con.php';

class MembersController
{
    private $dbconn;

    public function __construct($dbconn)
    {
        $this->con = $dbconn;
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
        pg_query($this->con, $query);
    }
}
