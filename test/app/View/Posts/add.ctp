<div class="posts form">
<?php echo $this->Form->create('Post'); ?>
    <fieldset>
        <legend><?php echo __('Add Post'); ?></legend>
        <?php echo $this->Form->input('name', ['label' => '名前']);
              echo $this->Form->input('description_1', ['label' => '説明1']);
              echo $this->Form->input('description_2',['label' => '説明2','rows' => '3']);
        ?>
    </fieldset>
<?=$this->Form->end(__('追加'))?>
</div>