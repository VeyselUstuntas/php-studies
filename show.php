<?php include __DIR__ . '/_layout.php'; ?>

<div class="container">
    <p class="h4"><?php echo $title ?></p>
    <p>
        <?php
        foreach ($result as $number) {
            echo "$number  ";
        }
        ?>
    </p>
        <a class="btn btn-success" href="/php-calismasi/home/">Home</a>
</div>