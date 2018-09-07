<?php
/**
 * Application level Controlleraaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
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

	//Auth Componentの読み込み
	public $components = array(
		'Flash',
		'Auth' => array(
			//ログイン後のページを指定
			/*
			 *メモ：コントローラ名とメソッドで指定する、
			 * そうすると必然的にビューが選出される。
			 */
			'loginRedirect' => array(
				'controller' => 'posts',	//コントローラの指定
				'action' => 'index'			//コントローラ内のメソッドを指定
			),
			'logoutRedirect' => array(
				'controller' => 'pages',	//コントローラの指定
				'action' => 'display',		//コントローラ内のメソッドを指定
				'home'
			),
			'authenticate' => array(
				'Form' => array(
					'passwordHasher' => 'Blowfish'
				)
			)
		)
	);
	
	//認証前でも閲覧できるページを設定
	/*
	 *メモ：全てのコントローラのindexとbiewを対象とする
	 *また、コントローラ内の特定アクション(を含むビュー)に対して
	 *同様にbeforeFilterする場合は、該当のコントローラ内に記述する
	 *今回はUsersController内にあるaddと言うページ(ユーザー追加ページ)に
	 *別途権限を与えている。
	 */
	public function beforeFilter() {
		$this->Auth->allow('index','view','input');
	}

}
