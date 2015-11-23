<?php
include_once 'easydboperator.php';
/*
Author: Diagboya Ewere
Year: 2009
Project Used: talkdeygo.com

Functionality
A Validator Class for Validating any kind of input

The Methods/Functions in this Class are

textvalid() - Used to Validate usernames and textinputs for spaces 
  $uvalu is the value you want to validate
	$errmsg is the error message you want to return

For Complaints or Comments
Phone: 08066194746
Email: boya360@yahoo.com

*/

class validator extends Db  {
    
    var $errval = "";	
	var $spamc = '';
	var $spamtxt = '';
	var $unikvalid = '';
	var $unikimg = '';
//////////////////////////////////////////
   function textvalid ($uvalu, $errmsg) {  // Validate Text
        $uvalu = stripslashes(strip_tags($uvalu));
        if (strlen($uvalu) < 2 || !ereg('([a-zA-Z0-9])', $uvalu))
        {
          $this->errval = '<font face="Verdana" size="1" color="#FF0000">' . $errmsg .'</font>';
          echo $this->errval;
          return false;
          exit();
        }
        else
        {
          $this->errval ='';
          echo $this->errval;
          return trim($uvalu);
        }
    // Validate Text
    }
//////////////////////////////////////////
    function emailvalid($emvalu, $errmsg)   { // Validate Email
		  if (!ereg('([a-z0-9.])'.'@'.'([a-z0-9.])'.'.'.'([a-z])', $emvalu) || !ereg('([a-z0-9.])'.'@'.'([a-z0-9.])'.'.'.'([a-z])'.'.'.'([a-z])', $emvalu))
		  {
			$this->errval = '<font face="Verdana" size="1" color="#FF0000">' . $errmsg .'</font>';
			echo $this->errval;
			return false;
		  }
                  /*
		  elseif ( !$this->chmailava($emvalu) ) {
		  	$this->errval = '<font face="Verdana" size="1" color="#FF0000">Email in use</font>';
			echo $this->errval;
		  }
                   * *
                   */
		  else {	  	
			$this->errval = '';
			echo $this->errval;
			return trim($emvalu);
		  }
    // Validate Email
    }
//////////////////////////////////////////	
	function chmailava ($usrmail) { // Validate Email by Availability
		$this->dbconect();
		$sqlq = "SELECT * FROM member WHERE email = '$usrmail'";
		$rq = mysql_query($sqlq);
		if ( mysql_num_rows($rq) > 0 ) {
		return false; }
		else {
		return true; }
	}
//////////////////////////////////////////	
	function chunameava ($usrname) { // Validate Username by Availability
		$this->dbconect();		
		$sqlq = "SELECT * FROM member WHERE tadeyid = '$usrname'";
		$rq = mysql_query($sqlq);
		if ( mysql_num_rows($rq) > 0 ) {
		return false;
		}
		else {
		return true; }
	}
//////////////////////////////////////////
    function phonevalid ($phvalu) { // Validate Phone
      if (strlen($phvalu) < 11 || ereg("[a-zA-Z<>.!@#$%^&*()_'=+|\?;:~` ]", $phvalu)) {
			$this->errval = '<font face="Verdana" size="1" color="#FF0000">Wrong Phone Number</font>';
			echo $this->errval;
			return false;
		}
       else {
         $this->errval ='';
         echo $this->errval;
         return $phvalu;
       }
    // Validate Phone
        if ($phvalu == '') {
                $this->errval = '<font face="Verdana" size="1" color="#FF0000">No data entered</font>';
                echo $this->errval;
                return false; }
        else {
                return $phvalu;
        }
    }
///////////////////////////////////////////
function datevalid ($novalu) {  // Validate Date
      if (!ereg("[0-9]{2}". '/'. "[0-9]{2}". "/". "[0-9]{4}", $novalu))
            {
                $this->errval = '<font face="Verdana" size="1" color="#FF0000">Invalid Input</font>';
                echo $this->errval;
                return false;
			}     else  {
         $this->errval ='';
         echo $this->errval;
         return true;
       }
    // Validate Date
		if ($novalu == '') {
			$this->errval = '<font face="Verdana" size="1" color="#FF0000">No data entered</font>';
			echo $this->errval;
			return false;			
		}
		else  {
			return true;
		}
    }
///////////////////////////////////////////
    function unamevalid ($uvalu) {     // Validates Username inputed by user
        $uvalu = stripslashes(strip_tags($uvalu));
        if (strlen($uvalu) < 4 || !ereg('([a-zA-Z0-9])', $uvalu)) {
          $this->errval = '<font face="Verdana" size="1" color="#FF0000">Tadey ID is empty</font>';
          echo $this->errval;
          return false;
        }
        elseif (!$this->chunameava($uvalu)) {
		  	$this->errval = '<font face="Verdana" size="1" color="#FF0000">Tadey ID already in use</font>';
			echo $this->errval;
			return false;
		}
		else {
          $this->errval ='';
          echo $this->errval;
          return true;
        }
    // Validate Username
     }
/////////////////////////////////////////
    function pwdvalid($pvalu)  {     // Validates Password
        $pvalu = strip_tags(stripslashes($pvalu));
        if (strlen($pvalu) < 6 || !ereg('([a-zA-Z0-9!@#$%^&*?])', $pvalu))
        {
          $this->errval = '<b><font face="Verdana" size="1" color="#FF0000">Password must be minimum of 6 characters</font></b>';
          echo $this->errval;
          return false;
        }   else {
          $this->errval ='';
          echo $this->errval;
          return true;
        }
    }
//////////////////////////////////////////
	function repwdf ($uinput, $repwd)
	{
		if ($uinput != $repwd)
		{
			echo  '<font face="Verdana" size="1" color="#FF0000">Passwords do not match</font>';
			return false;
		}
		elseif (empty($repwd))
		{
			echo  '<font face="Verdana" size="1" color="#FF0000"><img src="../images/err.png" />No data entered</font>';
			return false;
		}
		else
		{
			echo '';
			return true;
		}
	}
//////////////////////////////////////////
    function formatval($urvalu) {
        $revalu = mysql_real_escape_string(strip_tags(stripslashes($urvalu)));
        return $revalu;
    }
    
    function spamvalid($spvalu, $urvalu) { 
        //echo $this->spamtxt;
		if ($urvalu != $spvalu) {
          $this->errval = '<font face="Verdana" size="1" color="#FF0000"><img src="../images/err.png" />Spam code incorrect</font>';
          echo $this->errval;
          return false;
        }
        else {
          $this->errval = '';
          echo $this->errval;
          return true;
        }
    }
///////////////////////////////////////
	function captcha() {	  
	  $input = array("<img src='../images/spam/s.jpg'>", "<img src='../images/spam/0.gif'>", "<img src='../images/spam/x.jpg'>", "<img src='../images/spam/b.jpg'>","<img src='../images/spam/1.gif'>", "<img src='../images/spam/2.gif'>", "<img src='../images/spam/3.gif'>", "<img src='../images/spam/c.jpg'>", "<img src='../images/spam/4.gif'>", "<img src='../images/spam/5.gif'>", "<img src='../images/spam/d.jpg'>", "<img src='../images/spam/6.gif'>",  "<img src='../images/spam/e.jpg'>", "<img src='../images/spam/q.jpg'>", "<img src='../images/spam/7.gif'>",  "<img src='../images/spam/f.jpg'>", "<img src='../images/spam/8.gif'>", "<img src='../images/spam/t.jpg'>", "<img src='../images/spam/9.gif'>", "<img src='../images/spam/h.jpg'>", "<img src='../images/spam/A.gif'>", "<img src='../images/spam/B.gif'>", "<img src='../images/spam/i.jpg'>", "<img src='../images/spam/C.gif'>", "<img src='../images/spam/j.jpg'>", "<img src='../images/spam/D.gif'>", "<img src='../images/spam/v.jpg'>", "<img src='../images/spam/k.jpg'>", "<img src='../images/spam/E.gif'>", "<img src='../images/spam/F.gif'>", "<img src='../images/spam/w.jpg'>", "<img src='../images/spam/l.jpg'>", "<img src='../images/spam/G.gif'>", "<img src='../images/spam/y.jpg'>", "<img src='../images/spam/H.gif'>", "<img src='../images/spam/z.jpg'>", "<img src='../images/spam/m.jpg'>", "<img src='../images/spam/I.gif'", "<img src='../images/spam/J.gif'>", "<img src='../images/spam/n.jpg'>", "<img src='../images/spam/K.gif'>", "<img src='../images/spam/o.jpg'>", "<img src='../images/spam/L.gif'>", "<img src='../images/spam/M.gif'>", "<img src='../images/spam/N.gif'>", "<img src='../images/spam/p.jpg'>", "<img src='../images/spam/O.gif'>", "<img src='../images/spam/P.gif'>", "<img src='../images/spam/r.jpg'>", "<img src='../images/spam/Q.gif'>", "<img src='../images/spam/R.gif'>", "<img src='../images/spam/S.gif'>", "<img src='../images/spam/u.jpg'>", "<img src='../images/spam/T.gif'>", "<img src='../images/spam/U.gif'>", "<img src='../images/spam/u.jpg'>", "<img src='../images/spam/a.jpg'>", "<img src='../images/spam/V.gif'>", "<img src='../images/spam/W.gif'>", "<img src='../images/spam/X.gif'>", "<img src='../images/spam/Y.gif'>", "<img src='../images/spam/g.jpg'>", "<img src='../images/spam/Z.gif'>");
      $rand_keys = array_rand($input, 5);

      $this->spamc = $input[$rand_keys[0]] . $input[$rand_keys[1]] . $input[$rand_keys[2]] . $input[$rand_keys[3]] . $input[$rand_keys[4]];
		
	  $this->spamtxt = substr($input[$rand_keys[0]], 25, 1) . substr($input[$rand_keys[1]], 25, 1) . substr($input[$rand_keys[2]], 25, 1) . substr($input[$rand_keys[3]], 25, 1) . substr($input[$rand_keys[4]], 25, 1);

      echo $this->spamc;
	  //echo $this->spamtxt;
	}
/////////////////////////////////////
	function sexvalid($udata) {
		if($udata == "[Pick Sex]" || $udata == "")
		{
			$this->errval = '<font face="Verdana" size="1" color="#FF0000">No sex selected</font>';
			echo $this->errval;
			return false;
		}
		else
		{
			$this->errval = '';
			echo $this->errval;
			return $udata;
		}
	}
//////////////////////////////////////
	function checkagree ($chvalu) {
		if ( $chvalu != 'yes' )
		{
			$this->errval = '<font face="Verdana" size="1" color="#FF0000"><img src="../images/err.png" />You must agree with our TOS</font>';
			echo $this->errval;
			return false;
		}
		else
		{
			$this->errval = '<img src="../images/ok.png" />';
			echo $this->errval;
			return true;
		}
	}	
/////////////////////////////////////
function bday($urday, $urmonth, $uryr, $errmsg) {
if($urday == "DD" || $urmonth=="MM" || $uryr=="YYYY") {
	$this->errval = '<font face="Verdana" size="1" color="#FF0000">'. $errmsg .'</font>';
	echo $this->errval;
	return false;
}	
else {
	$this->errval = '';
	echo $this->errval;
	return true;
}	
}	
//////////////////////////////////////
// End of Validators Class
###########################################
}
?>