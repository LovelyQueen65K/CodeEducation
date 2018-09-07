<?php
/*
 * ユーザーデータの検索、保存、検証を行うユーザーモデル
 * 参照元:https://book.cakephp.org/2.0/ja/tutorials-and-examples/blog-auth-example/auth.html
 */

App::uses('AppModel','Model');
App::uses('BlowfishPasswordHasher','Controller/Component/Auth');
/*
 * 引用：BlowfishPasswordHasher は SimplePasswordHasher より強いハッシュアルゴリズム(bcrypt) を使い、
 * ユーザーソルトごとに提供します。SimplePasswordHasher は CakePHP version 3.0 で削除されます。
 */

class User extends AppModel {
	public $validate = array(
		'username' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'A username is required'
			)
		),
		'password' => array(
			'rule' => 'notBlank',
			'message' => 'A password is required'
		),
		'role' => array(
			'valid' => array(
				'rule' => array('inList',array('admin','author')),
				'message' => 'Please enter a valid role',
				'allowEmpty' => false
			)
		)
	);

	public function beforeSave($options = array()) {
		if(isset($this->data[$this->alias]['password'])) {
			$passwordHasher = new BlowfishPasswordHasher();
			$this->data[$this->alias]['password'] = $passwordHasher->hash(
				$this->data[$this->alias]['password']
			);
		}
		return true;
	}
}
?>
