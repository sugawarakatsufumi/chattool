<div class="users index">
	<h2><?php //echo __('Users'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('username'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<tr>
		<td><?php echo h($auth['id']); ?>&nbsp;</td>
		<td><?php echo h($auth['username']); ?>&nbsp;</td>
		<td><?php echo h($auth['email']); ?>&nbsp;</td>
		<td><?php echo h($auth['created']); ?>&nbsp;</td>
		<td><?php echo h($auth['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $auth['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $auth['id'])); ?>
			<?php echo $this->Form->postLink(__('Logout'), array('action' => 'logout', $auth['id']), array('confirm' => __('Are you sure you want to logout # %s?', $auth['id']))); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $auth['id']), array('confirm' => __('Are you sure you want to delete # %s?', $auth['id']))); ?>
		</td>
	</tr>
	</tbody>
	</table>
  <br>
  <br>
  <h2>あなたの投稿</h2>
	<?php //foreach ($auth_posts as $auth_post): ?>
  <table>
    <tr><td><h3><?php //echo $auth_post['Posts']['title']; ?></h3><p><?php //echo $auth_post['Posts']['content']; ?></p></td></tr>
  </table>
  <?php //endforeach; ?>

	<p>
	<?php
	#echo $this->Paginator->counter(array(
	#	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	#));
	#?>	</p>
	<div class="paging">
	<?php
	#	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
	#	echo $this->Paginator->numbers(array('separator' => ''));
	#	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('All User'), array('action' => 'users')); ?></li>
	</ul>
</div>
