<?php
App::uses('AppController','Controller');
class SampleViewController extends AppController {
	public function index() {
	
	//���C�A�E�g�̃I�[�g�����_������
	//$this->autoLayout=false;

	//���C�A�E�g��sample.ctp�Ɏw��
	$this->layout="sample";

	//�ϐ��̎󂯓n��
	$this->set("name","test name");
	}
}