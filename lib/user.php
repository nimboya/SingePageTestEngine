<?php
include_once 'easydboperator.php';
include_once 'validator.php';
/* Description: Operations for Users and data on Team */
class User extends Db {
    public $userid;
    public $teamid;
    
    // Login Operation
    function login($params) {
        $response = false;
        $username = strip_tags($params['username']);
        $password = strip_tags($params['password']);
        $qry = sprint("SELECT * FROM members WHERE username='%s' AND password='%s'", $username, $password);
        $dbres = $this->dbconnect();
        $qres = mysql_num_rows(mysql_query($qry, $dbres)) or die(mysql_error());
       
        if($qres > 0) {
            $response = true;
        }
        else { 
            $response = false;
        }
    }

    // Registers a new user
    function register($params) {
        $fields = array_keys($params); //array("name","age","sex","email","state", "team","phone");
        $values = $params;//array($params['name'],$params['age'],$params['sex'],$params['email'], $params['state'], $params['team'], $params['phone']);
        $tablename = "member";
        $resp = $this->InsertOpt($tablename, $fields, $values);
        return $resp;
    }
    /*
    function user_profile($userid) {
        $response = "";
        $qry = sprintf("SELECT member.name, member.email, member.phone, member.sex, member.team, SUM(point) points FROM useranswers, member
                        WHERE useranswers.userid = member.socid AND (member.socid = '%s')", $userid);
        $dbres = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;   
    }
    */
    function userprofile($userid) {
        $response="";
        $qry = sprintf("SELECT * FROM member WHERE member.socid = '%s'", $userid);
        $dbres = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;   
    }
    
    function myscore($userid) {
        $response="";
        $qry = sprintf("SELECT SUM(point) points FROM useranswers WHERE useranswers.userid = '%s'", $userid);
        $dbres = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;  
    }
    
    function teamscore($teamid) {
        $response="";
        $qry = sprintf("SELECT SUM(point) AS points FROM useranswers WHERE teamid = '%s'",$teamid);
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;
    }
}