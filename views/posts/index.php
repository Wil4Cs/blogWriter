<p>Here is a list of all posts:</p>

<?php foreach($chapters as $chapter) { ?>
  <p>
    <?php echo $chapter->getAuthor(); ?>
    <a href='?controller=posts&action=show&id=<?php echo $chapter->getId(); ?>'>See content</a>
  </p>
<?php } ?>