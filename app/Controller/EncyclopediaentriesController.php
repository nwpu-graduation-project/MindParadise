<?php

include_once('WebcontentsController.php');
// CakePlugin::load('Vendor/pscws4');
App::uses('WordSegmenter', 'Vendor');
// 加入头文件
// require '../Vendor/pscws4.class.php';
class EncyclopediaentriesController extends AppController {

	public $helpers = array('Html');
	public $components = array('Session');
	public $uses = array('Category','EncyclopediaEntry');
	
	public function view() {
		
	}
	
	public function add() {
		if ($this->request->is('get')) {
			// verify the user
		}
		
		if ($this->request->is('post')) {
			$segmenter = new WordSegmenter();
			$segmenter->segment($this->request->data['plainText']);
			
			// WebcontentsController::_echoArray($this->request->data);
		}
		
	}
	
	protected function zh2en($str) {
		return urlencode($str);
	}
	
}