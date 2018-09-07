<?php
App::uses('AppController','Controller');
class SampleViewController extends AppController {
	public function index() {
	
	//レイアウトのオートレンダを拒否
	//$this->autoLayout=false;

	//レイアウトをsample.ctpに指定
	$this->layout="sample";

	//変数の受け渡し
	$this->set("name","test name");
	}
}