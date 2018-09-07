<?php

App::uses('AppController','Controller');
class MemberController extends AppController {
	public function index() {
	//オートレンダOFF
	$this->autoLayout=false;
	}
}
