<h1>Blog posts</h1>

<?php echo $this->element('view_tags'); ?>

<table>
    <tr>
        <th>Id</th>
        <th>Tag</th>
        <th>Action</th>
    </tr>
    
    <!-- Here is where we loop through our $posts array, printing out post info -->
    <?php foreach ($tags as $tag): ?>
    <tr>
        <td><?php echo $tag['Tag']['id']; ?></td>
        <td><?php echo $tag['Tag']['tag']; ?></td>
        <td>
        <?php
        echo $this->Form->postLink('Delete',
            array('action' => 'delete', $tag['Tag']['id']), array('confirm' => 'Are you sure?'));
        ?>
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($tag);?>
    
</table>

<h1>
    <?php
    echo $this->Html->link('Add Tag', array('controller' => 'tags', 'action' => 'add'));
    ?>
</h1>