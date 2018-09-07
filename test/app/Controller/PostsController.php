<?php
App::uses('AppController', 'Controller');

class PostsController extends AppController {
    public $helpers = array('Html', 'Form');

    /****
     * Index
     * テーブル形式の一覧でデータベースPostの中身を表示する
     * 検索フォームを設置したい
     ****/

    public function index() {
    	//$this->autoLayout = false;
        if($this->request->is('post')){
        	//フォームデータの取得
        	$search_phrase = $this->request->data('Search.phrase');

        	//検索してviewへ渡す
			$this->set('posts',
					$this->Post->find('all',
							array(
								'conditions'=>array(
											/*
											 * 検索語句から入力情報すべてを検索するためにorの条件で
											 * 並列してあいまい検索する
											 */
											'or' => array(
													array('name like' => '%'.$search_phrase.'%'),
													array('description_1 like' => '%'.$search_phrase.'%'),
													array('description_2 like' => '%'.$search_phrase.'%')
													)
								)
							)
					)
			);
		//postがなかった場合の表示(全表示)
		/*
		 * viewにて直接getへのリンクを作成、それぞれの場合においてsortという変数にgetした値を格納
		 * 格納されたsortから列挙順を判断する
		 * 仮の配列を用意しておいて
		 * 全分岐の最後でsetすればもっと効率的かも？
		 */
        } else {
        	//並べ替えフィールド判断
        	$sort = $this->request->query('sort');

        	//ID昇順
        	if($sort=="id_asc"){
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.id ASC'))
        			)
        		);
        	} else if ($sort=="id_desc"){
        		//ID降順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.id DESC'))
        			)
        		);
        	} else if ($sort=="name_asc"){
        		//名前昇順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.name ASC'))
        			)
        		);
        	} else if ($sort=="name_desc"){
        		//名前降順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.name DESC'))
        			)
        		);
        	} else if ($sort=="desc_1_asc"){
        		//説明1昇順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.description_1 ASC'))
        			)
        		);
        	} else if ($sort=="desc_1_desc"){
        		//説明1降順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.description_1 DESC'))
        			)
        		);
        	} else if ($sort=="desc_2_asc"){
        		//説明2昇順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.description_2 ASC'))
        			)
        		);
        	} else if ($sort=="desc_2_desc"){
        		//説明2降順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.description_2 DESC'))
        			)
        		);
        	} else if ($sort=="created_asc"){
        		//追加日昇順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.created ASC'))
        			)
        		);
        	} else if ($sort=="created_desc"){
        		//追加日降順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.created DESC'))
        			)
        		);
        	} else if ($sort=="modified_asc"){
        		//編集日昇順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.modified ASC'))
        			)
        		);
        	} else if ($sort=="modified_desc"){
        		//編集日降順
        		$this->set('posts',
        			$this->Post->find('all',
        			array('order' => array('Post.modified DESC'))
        			)
        		);
        	} else {
        		$this->set('posts', $this->Post->find('all'));
        	}
        }
    }

    /*****
     * Add
     * フォームデータで取得した新規情報を
     * Postへ新規追加する
     ****/

    public function add() {
		if($this->request->is('post')){
		    //フォームデータの取得
		    $name = $this->request->data('Post.name');
		    $description_1 = $this->request->data('Post.description_1');
		    $description_2 = $this->request->data('Post.description_2');

			//取得したデータを一時的に配列に格納する
		    $test = array();
			$test["Post"]["name"] = "$name";
			$test["Post"]["description_1"] = "$description_1";
			$test["Post"]["description_2"] =  "$description_2";
			//作成日時を格納
			$test["Post"]["created"]= date("Y/m/d H:i:s");

			var_dump($name);
			var_dump($description_1);
			var_dump($description_2);
			var_dump($test["Post"]["created"]);

			//一時配列からデータベースへセーブを行う
			if($this->Post->save($test)){
				$this->Flash->success(__('保存されました'));
				return $this->redirect(array('action'=>'index'));
			}
			//失敗時のエラー
			$this->Flash->error(
				__('正常に保存されませんでした。もう一度お試しください')
			);
		}
    }

    /****
     * Edit
     * Post内から選択された情報を編集する
     ****/

	public function edit($id = null) {
		//idの指定がない場合のエラー
		if (!$id) {
			throw new NotFoundException(__('Invalid post'));
		}
		$post = $this->Post->findById($id);
		if (!$post) {
			throw new NotFoundException(__('Invalid post'));
		}

		//viewへの配列受け渡し
		$this->set('post', $post);

		//post取得時の処理
		if($this->request->is(array('post','put'))){
		/*
		 * メモ:postまたはputがあるかの確認をしている
		 */
			$this->Post->id = $id;

			/*
			 * 以下、手動で配列を用意して変更しようとしたところ、
			 * NULLのレコードが無限に生成される状態になってしまいました。
			 * 結果的にpostされたデータをそのまま格納したところ、
			 * 更新は可能になったので、そのままにしています。
			 */

			//フォームデータの取得
			$name = $this->request->data('Post.name');
			$description_1 = $this->request->data('Post.description_1');
			$description_2 = $this->request->data('Post.description_2');

			//取得したデータを一時的に配列に格納する
			$test = array();
			$test["Post"]["id"] = $id;
			$test["Post"]["name"] = $name;
			$test["Post"]["description_1"] = $description_1;
			$test["Post"]["description_2"] = $description_2;
			$test["Post"]["created"] = $this->Post->created;
			$test["Post"]["modified"]= date("Y/m/d H:i:s");

			//入力チェック
			var_dump($id);
			var_dump($name);
			var_dump($description_1);
			var_dump($description_2);
			var_dump($test["Post"]["created"]);
			var_dump($test["Post"]["modified"]);

			//一時配列からデータベースへセーブを行う
			if($this->Post->save($test)){
				$this->Flash->success(__('保存されました'));
				return $this->redirect(array('action'=>'index'));
			}
			//失敗時のエラー
			$this->Flash->error(
					__('正常に保存されませんでした。もう一度お試しください')
					);

			//↓単独で動作するパターン
			/*
			//一時配列からデータベースへセーブを行う
			if($this->Post->save($this->request->data)){
				$this->Flash->success(__('保存されました'));
				return $this->redirect(array('action'=>'index'));
			}
			//失敗時のエラー
			$this->Flash->error(
				__('正常に保存されませんでした。もう一度お試しください')
			);
			*/
		}
	}

	/*******
	 * Delete
	 * 編集ページから特定のデータを削除する
	 * postLinkを使うと便利らしい
	 * Viewは用意せず、削除のみのメソッド
	 *******/

	public function delete($id) {
    if ($this->request->is('get')) {
        throw new MethodNotAllowedException();
    }
	$this->Post->id = $id;
    if ($this->Post->delete($id)) {
        $this->Flash->success(
            __('The post with id: %s has been deleted.', h($id))
        );
    } else {
        $this->Flash->error(
            __('The post with id: %s could not be deleted.', h($id))
        );
    }

    return $this->redirect(array('action' => 'index'));
	}
}
?>