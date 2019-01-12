<?php

/*
* This class will work for session
*/
class Session
{
	
	public  function init()
	{
		if (version_compare(phpversion(),'5.4.0','<')) 
		{
			if (session_id() == '') 
			{
				session_start();
			}
		} 
		else 
		{
			if (session_status() == PHP_SESSION_NONE) 
			{
				session_start();
			}
		}
	}

public static function set($key,$val)
{
	$_SESSION[$key] = $val;
}

public static function get($key)
{
	if (isset($_SESSION[$key])) 
	{
		return $_SESSION[$key];
	} 
	else 
	{
		return false;
	}
}

public static function unset()
{
	//session_unset();

	self::set('msg', NULL);
}
 
 public function indexPageLoad(){
    if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        header('location:user/adminDashboard.php');
    }
    if(isset($_SESSION["is_User"]) && ($_SESSION["is_User"] == "IS_ACTIVE")){
        header('location:user/userDashboard.php');
    }
    if(isset($_SESSION["is_Client"]) && ($_SESSION["is_Client"] == "IS_ACTIVE")){
        header('location:client/Dashboard.php');
    }    
}

public function adminPageLoad(){
    if(isset($_SESSION["is_User"]) && ($_SESSION["is_User"] == "IS_ACTIVE")){
        header('location:../user/userDashboard.php');
    }
    if(isset($_SESSION["is_Client"]) && ($_SESSION["is_Client"] == "IS_ACTIVE")){
        header('location:../client/Dashboard.php');
    }    
}

public function userPageLoad(){
    if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        header('location:../user/adminDashboard.php');
    }
    if(isset($_SESSION["is_Client"]) && ($_SESSION["is_Client"] == "IS_ACTIVE")){
        header('location:../client/Dashboard.php');
    }    
}
public function clientPageLoad(){
    if(isset($_SESSION["is_Admin"]) && ($_SESSION["is_Admin"] == "IS_ACTIVE")){
        header('location:../user/adminDashboard.php');
    }
    if(isset($_SESSION["is_User"]) && ($_SESSION["is_User"] == "IS_ACTIVE")){
        header('location:../user/userDashboard.php');
    }    
}

}

?>