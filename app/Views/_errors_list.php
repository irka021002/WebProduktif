<?php if (! empty($errors)): ?>
    <div class="alert alert-danger" role="alert">
        <?php foreach ($errors as $error): ?>
            <p style="font-family: 'Poppins'; color: red;font-size: 12px;text-align:center;"><?= esc($error) ?></p>
        <?php endforeach ?>
    </div>
<?php endif ?>