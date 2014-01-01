<?php

class PersonalCenterController extends AppController
{
	//public uses = array("User");

	function index()
	{
		$currentUser = parent::currentUser();

		if(!$currentUser)
		{
			// erro 
			// set flash
			// redirect to login

		}

		switch($currentUser['User']['role'])
		{

			// case 1: // tourist
			// 	this->render("tourist_index");
			// 	break;
			case 2: // normal user
				$this->render("user_index");
				break;
			case 3: // consultant
				$this->render("consultant_index");
				break;
			case 4: // administrator
				$this->render("admin_index");
			default: // error
		}
	}
}

?>