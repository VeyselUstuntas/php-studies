<?php
include __DIR__ . '/_layout.php';
if ($_SERVER['REQUEST_URI'] == "/php-calismasi/" || $_SERVER['REQUEST_URI'] == "/php-calismasi/index"): ?>

<?php endif; ?>
<div class="container mt-5">
    <div class="btn-group">
        <a class="btn btn-primary btn-sm" href="/php-calismasi/fibonacci/10">Fibonacci</a>
        <a class="btn btn-outline-primary btn-sm" href="/php-calismasi/prime-number/10">Prime Number</a>
    </div>
</div>