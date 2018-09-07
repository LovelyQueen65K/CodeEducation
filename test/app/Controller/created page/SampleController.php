<?php
App::uses('AppController','Controller');
	class SampleController extends AppController{
		public function index(){
 			$this->autoRender=false;
 			echo"<h1>this is sample page";
 			echo"<p>this is sample page (without Auto Render)</p>";
 		}
 	}