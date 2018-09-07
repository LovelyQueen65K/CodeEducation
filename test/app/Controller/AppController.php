<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	//Auth Component�̓ǂݍ���
	public $components = array(
		'Flash',
		'Auth' => array(
			//���O�C����̃y�[�W���w��
			/*
			 *�����F�R���g���[�����ƃ��\�b�h�Ŏw�肷��A
			 * ��������ƕK�R�I�Ƀr���[���I�o�����B
			 */
			'loginRedirect' => array(
				'controller' => 'posts',	//�R���g���[���̎w��
				'action' => 'index'			//�R���g���[�����̃��\�b�h���w��
			),
			'logoutRedirect' => array(
				'controller' => 'pages',	//�R���g���[���̎w��
				'action' => 'display',		//�R���g���[�����̃��\�b�h���w��
				'home'
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			)
		)
	);
	
	//�F�ؑO�ł��{���ł���y�[�W��ݒ�
	/*
	 *�����F�S�ẴR���g���[����index��biew��ΏۂƂ���
	 *�܂��A�R���g���[�����̓���A�N�V����(���܂ރr���[)�ɑ΂���
	 *���l��beforeFilter����ꍇ�́A�Y���̃R���g���[�����ɋL�q����
	 *�����UsersController���ɂ���add�ƌ����y�[�W(���[�U�[�ǉ��y�[�W)��
	 *�ʓr������^���Ă���B
	 */
	public function beforeFilter() {
		$this->Auth->allow('index','view','input');
	}

}
