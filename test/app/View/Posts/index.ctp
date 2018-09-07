<meta charset="utf-8"/>
<table>
	<tr>
		<th>Id
			<?=$this->Html->link(
			'▲',
			'?sort=id_asc',
			array('class' => 'button')
			);?>
			<?=$this->Html->link(
			'▼',
			'?sort=id_desc',
			array('class' => 'button')
			);?>
		<th>名前
			<?=$this->Html->link(
			'▲',
			'?sort=name_asc',
			array('class' => 'button')
			);?>
			<?=$this->Html->link(
			'▼',
			'?sort=name_desc',
			array('class' => 'button')
			);?>
		</th>
		<th>説明1
			<?=$this->Html->link(
			'▲',
			'?sort=desc_1_asc',
			array('class' => 'button')
			);?>
			<?=$this->Html->link(
			'▼',
			'?sort=desc_1_desc',
			array('class' => 'button')
			);?>
		</th>
		<th>説明2
			<?=$this->Html->link(
			'▲',
			'?sort=desc_2_asc',
			array('class' => 'button')
			);?>
			<?=$this->Html->link(
			'▼',
			'?sort=desc_2_desc',
			array('class' => 'button')
			);?>
		</th>
		<th>作成日
			<?=$this->Html->link(
			'▲',
			'?sort=created_asc',
			array('class' => 'button')
			);?>
			<?=$this->Html->link(
			'▼',
			'?sort=created_desc',
			array('class' => 'button')
			);?>
		</th>
		<th>更新日
			<?=$this->Html->link(
			'▲',
			'?sort=modified_asc',
			array('class' => 'button')
			);?>
			<?=$this->Html->link(
			'▼',
			'?sort=modified_desc',
			array('class' => 'button')
			);?>
		</th>
	</tr>

	<!-- ここから、$posts配列をループして、投稿記事の情報を表示 -->

	<?php foreach ($posts as $post): ?><!--postsの内容がpostに代入される-->
	<tr>
		<td><?php echo $post['Post']['id']; ?></td>
		<td><?php echo $this->Html->link($post['Post']['name'],
				array('controller' => 'posts',
					  'action' => 'edit',
					   $post['Post']['id']
					)
				);
			 ?>
		</td>
		<td><?php echo $post['Post']['description_1']; ?></td>
		<td><?php echo $post['Post']['description_2']; ?></td>
		<td><?php echo $post['Post']['created']; ?></td>
		<td><?php echo $post['Post']['modified']; ?></td>
	</tr>
	<?php endforeach; ?>
	<?php unset($post); ?>
</table>

<?php
echo $this->Html->link(
    'Add new',
    array(
        'controller' => 'posts',
        'action' => 'add',
        'full_base' => true,
        'class' => 'actions'
    )
);
?>

<?php echo $this->Form->create('Search');?>
<?php echo $this->Form->input('phrase',['label'=>'検索語句']); ?>
<?php echo $this->Form->end('検索'); ?>
