<?php

App::uses('AppController', 'Controller');
class LoginController extends AppController {
	public $uses = array('User');
	
	public function index() {
		//レイアウトのオートレンダを拒否
		$this->autoLayout = false;
	}
	
	//入力フォーム初期表示の処理
	public function input(){
		
		//オートレンダの解除
		$this->autoLayout  =false;
		
		//入力情報の取得
		//cake標準の方法を使う($this->request～)
/*********************************
		if(isset($_POST['id'])) {
			if(isset($_POST['password'])) {
				$id = $_POST['id'];
				$password = $_POST['password'];
			}
		}
		echo "Welcome ". $id ." !<br>";
		echo "Your password is ". $password;
		}
**********************************/
		
		$id = $this->request->data('id');
		//=>1
		$password = $this->request->data('password');
		var_dump($id);
		var_dump($password);
		$result = $this->User->find("first",array(
									    'conditions' => array('User.username' => $id), //検索条件の配列
									    'fields' => array('*'), //フィールド名の配列
									    'order' => array('User.id ASC') //並び順を文字列または配列で指定
									    //'group' => array('Model.field'), //GROUP BYのフィールド
									    //'limit' => 10, //int
									    //'page' => 10, //int
									    //'offset' => n, //int
									    //'callbacks' => true //falseの他に'before'、'after'を指定できます
									)
								);
		
		
		//var_dump($result ["User"]);
		
/********************************
		$test = array();
		$test["User"]["id"] = "100";
		$test["User"]["username"] = "aaaaaaaaaaaaaaa";
		$test["User"]["password"] = "aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa";
		$test["User"]["role"] =  "author";
		$test["User"]["created"]= "2018-08-22 20:03:17";
		$test["User"]["modified"]= "2018-08-22 20:03:17";
		
		$this->User->save($test);
	}
********************************/
	
/********************************
	//inputで入力したformデータを受信・処理の実施
	テキストの入力→validateを行い、validateのエラーを返す(modelのvalidationを使う)
	SAVEして→表示
	SQLを使った実行方法
	
	public function save() {
	
	}
*********************************/
	}
}
