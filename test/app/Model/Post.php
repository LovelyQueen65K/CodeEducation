<?php
/*
 * データの検索、保存、検証を行うユーザーモデル
 * 参照元:https://book.cakephp.org/2.0/ja/tutorials-and-examples/blog-auth-example/auth.html
 */

App::uses('AppModel','Model');

class Post extends AppModel {
	public $validate = array(
		'name' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter a name'
			)
		),
		'description_1' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter a Description'
			)
		),
		'description_2' => array(
			'required' => array(
				'rule' => 'notBlank',
				'message' => 'Please enter a Description'
			)
		),
	);
}
?>
