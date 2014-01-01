<?php

class EncyclopediaentriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry');
	
	public function view() {
		
	}
	
}