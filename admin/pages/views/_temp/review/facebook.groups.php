<h2>My groups <?php echo $config->me['name'] ?></h2>

<?php foreach ($groups as $gO) { ?>
<div class="one-book-row" data-id="<?php $gO['id'] ?>">
    <div class="col-lg-1 one-book-actions center">
    </div>
    <div class="col-lg-2 one-book-title">
        <?php echo $gO['id'] ?>
    </div>
    <div class="col-lg-4 one-book-title">
        <a title="<?php echo $gO['name'] ?>" href="?type=facebook&id=<?php echo $gO['id'] ?>">
            <?php echo $gO['name'] ?>
        </a>
    </div>
    <div class="clearfix"></div>
</div>
<?php } ?>
