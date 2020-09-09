<?php

namespace App\Controllers;

use App\Models\LoggedIn;
use App\Models\sql;
use \Core\View;
use \Core\Model;
use http\Message;

/**
 * Login controller
 *
 * PHP version 7.0
 */
class database extends \Core\Controller
{
    private function REQ($values = []){
        foreach ($values as $parameter){
            if(!array_key_exists($parameter,$_POST)){
                echo sprintf("Parameter %s not found",$parameter);
                die();
            }
        }
    }
    private static function generateRandomString($length = 32) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function insertNewLoginAction(){
        $this->REQ(["username","password","2password"]);
        if($_POST["password"] != $_POST["2password"])
            header('Location: '.$_SESSION["htmlPath"]."create/login");
        $secretKey =self::generateRandomString(10);

        $password = hash("sha256",$_POST["password"].$secretKey);
        sql::db_Insert("datingapph2","account", [
            "username"=>$_POST["username"],
            "password"=>$password,
            "secretKey"=>$secretKey
        ]);
        $_SESSION["acc_id"] = sql::db_Select("datingapph2","account","id","password='".$password."'")["id"];
        $_SESSION["LoginState"] = 1;
        header('Location: '.$_SESSION["htmlPath"]."create/account");
    }
    public function insertNewAccountAction(){
        $this->REQ(["email","zip_code","city","address","phone_nr"]);
        $columns = sprintf("phone='%s',email='%s',address='%s'",str_replace("-","",$_POST["phone_nr"]) ,$_POST["email"],$_POST["address"]);
        $where = sprintf("id='%s'",$_SESSION["acc_id"]);
        sql::db_Update("datingapph2", "account",
            $columns,
            $where
        );
        header('Location: '.$_SESSION["htmlPath"]."create/profile");
    }
    public function insertNewProfileAction(){
        $this->REQ(["name","birthday","gender","preference","description"]);

        //This function i copied from https://stackoverflow.com/questions/3776682/php-calculate-age
        //And rewritten from date input with mm/dd/yyyy format to yyyy-mm-dd
        $birthDate1 = explode("-", $_POST["birthday"]);
        $birthDate =[$birthDate1[1], $birthDate1[2], $birthDate1[0]];
        $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[0], $birthDate[1], $birthDate[2]))) > date("md")
            ? ((date("Y") - $birthDate[2]) - 1)
            : (date("Y") - $birthDate[2]));

        sql::db_Insert("datingapph2","profile", [
            "name"=>$_POST["name"],
            "sex"=>$_POST["gender"],
            "age"=>$age,
            "birthday"=>$_POST["birthday"],
            "text"=>$_POST["description"],
            "preferences"=>$_POST["preference"],
            "activeStatus" => 1,
            "rating" => 3,
        ]);
        $_SESSION["profile_id"] = sql::db_Select("datingapph2","profile","id",sprintf("name='%s' AND birthday='%s' AND sex='%s'",$_POST["name"],$_POST["birthday"],$_POST["gender"]))["id"];

        sql::db_Update("datingapph2", "account",
            "profileID='".$_SESSION["profile_id"]."'",
            "id='".$_SESSION["acc_id"]."'"
        );
        header('Location: '.$_SESSION["htmlPath"]."swipe_page");
    }
    public function doLikeAction(){
        $this->REQ(["like"]);
        if($_POST["like"] != 0){
            $exists = sql::db_Select("datingapph2","matchtable","*",sprintf("(reqID='%s' AND requestedID='%s') OR (reqID='%s' AND requestedID='%s')",$_POST["like"],$_SESSION["profile_id"],$_SESSION["profile_id"],$_POST["like"]));
            if($exists != null){
                $request = sql::db_Update("datingapph2","matchtable","isMatch='1'","id='".$exists["id"]."'");
                header('Location: '.$_SESSION["htmlPath"]."swipe_page");
            }else{
                sql::db_Insert("datingapph2","matchtable",[
                    "reqID" => $_SESSION["profile_id"],
                    "requestedID" => $_POST["like"]
                ]);
                header('Location: '.$_SESSION["htmlPath"]."swipe_page");
            }
        }elseif($_POST["like"] == 0){
            header('Location: '.$_SESSION["htmlPath"]."swipe_page");
        }
    }
}
