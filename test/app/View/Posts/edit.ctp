<h1><?php echo h($post['Post']['name']); ?></h1>

<p>
	<small>
		作成日: <?php echo $post['Post']['created']; ?>
		編集日: <?php echo $post['Post']['modified']; ?>
	</small>
</p>

<p>
	<?php echo h($post['Post']['description_1']); ?>
<br>
	<?php echo h($post['Post']['description_2']); ?>
</p>

<!--メモ:formヘルパーでcreate宣言するのはModelと同じ名前を宣言する-->
<!--ここからフォーム-->
<?php echo $this->Form->create('Post'); ?>
	<fieldset>
		<legend><?php echo __('Edit Post'); ?></legend>
		<?php
		/*
		 * メモ:それぞれ入力の初期値としてdefaultを指定しているが、
		 * valueとしての指定も可能、ただし更新などを行うと消えてしまうので注意
		 */

			echo $this->Form->input(
				'name',
				 ['label' => '名前',
				  'default' => $post['Post']['name']]
				);
			echo $this->Form->input(
				'description_1',
				 ['label' => '説明1',
				  'default' => $post['Post']['description_1']]
				);
			echo $this->Form->input(
				'description_2',
				['label' => '説明2',
				 'rows' => '3',//入力列3行
				  'default' => $post['Post']['description_2']]
				);
		?>
	</fieldset>
<?=$this->Form->end(__('変更'))?>

<!--削除ボタン-->
<?php
	echo $this->Form->postLink(
		'Delete',
		array('action' => 'delete',$post['Post']['id']),
		array('confirm' => '本当に削除しますか？')
	);
?>

<!--戻るボタン-->
<?php
	echo $this->Html->link(
		'戻る',
		array(
			'controller' => 'Posts',
			'action' => 'index'
		)
	);
?>