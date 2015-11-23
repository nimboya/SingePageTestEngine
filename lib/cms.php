<?php
include_once 'easydboperator.php';
include_once 'validator.php';
include_once 'upload.php';
/* Description: Create Questions and Answers */
class Cms extends Db {
    function createepisode($params) {
        $fields = array_keys($params); //array("name","age","sex","email","state", "team","phone");
        $values = $params;//array($params['name'],$params['age'],$params['sex'],$params['email'], $params['state'], $params['team'], $params['phone']);
        $tablename = "episodes";
        $resp = $this->InsertOpt($tablename, $fields, $values);
        return $resp;
    }
    
    function createquestion($params,$file_name='') {
		//print_r($_FILES);
		//exit();
		
		if($file_name != ''){
			$upload = new Upload($file_name,'../lib/uploads/',5242880);
			$upload->file_prefix = 'closeup_'.$this->rand_string();
			$upload_result = $upload->upload_process();
		    
			if ($upload->upload_error) {
				$response = $upload->upload_error;
			} else {
				$params['filename'] = $upload_result['name'];
				$fields = array_keys($params);
				$values = $params;
				$tablename = "questions";
				$response = $this->InsertOpt($tablename, $fields, $values);
			}
		}else{
			$fields = array_keys($params);
			$values = $params;
			$tablename = "questions";
			$response = $this->InsertOpt($tablename, $fields, $values);
		}
		return $response;
    }
	
	function rand_string($length = 5, $chars = 'ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghqrt123456789'){//
        $chars_length = (strlen($chars) - 1);
        $string = $chars{rand(0, $chars_length)};
        for ($i = 1; $i < $length; $i = strlen($string)){
            $r = $chars{rand(0, $chars_length)};
            if ($r != $string{$i - 1}) $string .=  $r;
        }
        return $string;
    }
    
   function Upload($type, $tmp, $file) {
            // Get File Type
            $ftype = $type;
            $allowedtypes = array("image/jpeg","image/png","video/mp4");
            $folder = "../lib/uploads/"; $fpath = $folder.$file;
            //if(count($tmp) > 5) {
			if(!file_exists($folder)) mkdir($folder);
            # Upload File
            return move_uploaded_file($tmp, $fpath);
			//}
    }       
    
    function viewquestions() {
        $response="";
        $qry = "SELECT * FROM questions";
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        while($response = mysql_fetch_object($qres)) {
            $data[] = $response;
        }
        return $data;
    }
    
    function setasanswered($epid) {
        // Append Answered Episode to User Profile
		$addepisode = $epid;
		$qry = "UPDATE member SET member.episdoesanswered = member.episdoesanswered + '$addepisode' WHERE member.socid='$userid'";
		$qryres = mysql_query($qry);
    }
	
	function hideifanswered($userid, $epid) {
		$response="";
        $qry = sprintf("SELECT * FROM useranswers WHERE userid='%s' AND episodeid='%s'", $userid, $epid);
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_num_rows($qres);
        return $response;
	}
    
    // Get Question by Week ID
    function getquestionbyweek($weekid) {
        $response="";
        $qry = sprintf("SELECT * FROM questions WHERE episodeid='%s'", $weekid);
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        while($response = mysql_fetch_object($qres)) {
            $res[] = $response;
        }
        return $res;
    }
    
    // Get Week Question
    function getweekquestion() {
        $response="";
        //$qry = sprintf("SELECT * FROM questions");
        $qry = sprintf("SELECT * FROM questions GROUP BY episodeid");
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        while($response = mysql_fetch_object($qres)) {
            $res[] = $response;
        }
        return $res;
    }
    
    // Get Question by ID
    function getquestion($qid) {
        $response="";
        $qry = sprintf("SELECT * FROM questions WHERE id='%s'", $qid);
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;
    }
    
    function editquestion($params) {
        $response = "";
        $question = $params['question'];
        $answer = $params['answer'];
        $options = $params['options'];
        $qid = $params['id'];
        $qry = sprintf("UPDATE questions SET question='%s', answer='%s', options='%s' WHERE id='%s'", $question, $answer, $options, $qid);
        
		$res = $this->dbconnect();
        $response = mysql_query($qry);
        return $response;
    }
	
	function deletequestion($qid) {
		$response = "";
        $qry = sprintf("DELETE FROM questions WHERE id='%s'", $qid);
        $res = $this->dbconnect();
        $response = mysql_query($qry);
        return $response;
	}
    
    function deleteepisode ($delepid) {
        $response = "";
        $qry = sprintf("DELETE FROM questions WHERE episodeid='%s'", $delepid);
        $res = $this->dbconnect();
        $response = mysql_query($qry);
        return $response;
    }
    
	function answerdetails($userid, $epid) {
		$response = "";
        $qry = sprintf("SELECT question, options, `questions`.`episodeid`, `questions`.`answer`, `useranswers`.`answer` AS correctanswer,`useranswers`.`point` AS myanswer  FROM `questions`, `useranswers` WHERE `useranswers`.`qid` = `questions`.`id` AND  `useranswers`.`userid` = '%s' AND `useranswers`.`episodeid` = '%s'", $userid, $epid);
        $res = $this->dbconnect();
        $response = mysql_query($qry);
        return $response;
	}
	
    function post_answer($params) {
        $fields = array_keys($params);
        $values = $params;
        $tablename = "useranswers";
        $response = $this->InsertOpt($tablename, $fields, $values);
        return $response;   
    }
    
    function getuserpoints($userid) {
        $response="";
        $qry = sprintf("SELECT SUM(points) FROM useranswers WHERE userid='%s'", mysql_real_escape_string($qid));
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;
    }
    
    function itemretriever($tablename, $val="", $dbcol="") {
        $response="";
        $qry = sprintf("SELECT * FROM `$tablename` WHERE `$dbcol`='%s'", mysql_real_escape_string($val));
        $res = $this->dbconnect();
        $qres = mysql_query($qry);
        $response = mysql_fetch_object($qres);
        return $response;
    }
}