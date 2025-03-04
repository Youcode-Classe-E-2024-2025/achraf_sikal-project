<?php
session_start();
include_once("./../model/UserModel.php");

class ProjectController extends Auth {
    public function __construct() {
        if (!isset( $_POST["members"]) && isset( $_POST["project_name"])) {
            $project = $_POST["project_name"];
            $owner = $_SESSION["user"];
            $category_id = (int) $_POST["category_id"];
            $this->creatproject($project, $owner, $category_id);
            header("location: /project_oop/user.php");
        }elseif(isset( $_POST["project_name"])) {
            $project = $_POST["project_name"];
            $owner = $_SESSION["user"];
            $category_id = (int) $_POST["category_id"];
            $last_inserted_id = $this->creatproject($project, $owner, $category_id);
            foreach ($_POST["members"] as $member) {
                $this->creatteam((int)$member, $last_inserted_id);
            }
            header("location: /project_oop/user.php");
        }
        if(isset($_POST["project_description"])){
            $project_id = $_SESSION["project_id"];
            $project_desk = $_POST["project_description"];
            $this->projectdesk($project_desk, $project_id);
            header("location: /../project_oop/index.php");
        }
    }
}
new ProjectController();
?>