<?php include_once "header.php" ?>

<h1>
<?php echo $excp->getMessage() ?> in file <?php echo $excp->getFile() ?> in line <?php echo $excp->getLine() ?>
</h1>

<?php include_once "footer.php" ?>