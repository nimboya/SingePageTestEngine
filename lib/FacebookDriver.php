<?php
include_once("config.php");
/**
 * Created by PhpStorm.
 * User: oluwasegunmatthew
 * Date: 7/8/15
 * Time: 7:46 AM
 */

//namespace models;

use Facebook\FacebookJavaScriptLoginHelper;
use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;
use Facebook\GraphUser;
//use libraries\Config;


class FacebookDriver {

    private $fb_app_id;
    private $fb_app_secret;

    private $fb_session = array();

    function __construct(){
        $this->fb_app_id = FB_APP_ID;
        $this->fb_app_secret = FB_APP_SECRET; 

        FacebookSession::setDefaultApplication($this->fb_app_id, $this->fb_app_secret);
        $this->set_session();
    }


    private function set_token(){

    }

    private function set_session(){
        if(empty($this->fb_session)) {
            $helper = new FacebookJavaScriptLoginHelper($this->fb_app_id);
            try {
                $this->fb_session = $helper->getSession();
            } catch (FacebookRequestException $ex) {
                //print_r($ex);
            } catch (\Exception $ex) {
                //print_r($ex);
            }
        }
    }


    public function in_session(){
        $status = false;
        if(!empty($this->fb_session))
            $status = true;
        return $status;
    }

    public function get_session(){
        return $this->fb_session;
    }

    public function get_profile(){
        $profile = array();
        $fb_session = $this->get_session();
        try {
            $profile = (new FacebookRequest(
                $fb_session, 'GET', '/me'
            ))->execute()->getGraphObject(GraphUser::className());
        } catch(FacebookRequestException $e) {
            //echo "Exception occured, code: " . $e->getCode();
            //echo " with message: " . $e->getMessage();
        }
        return $profile;
    }
}