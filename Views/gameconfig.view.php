<h1>Blintest - Configuration</h1>
<form action="" method="post" id="form-config">
    <div class="form-input">
        <legend>Genres:</legend>
        <?php if(isset($genres)) :?>
        <?php foreach($genres as $genre): ?>
            <input type="checkbox" name="genre" value="<?= $genre['idgenre'] ?>">
            <label for=""><?= $genre['libelle'] ?></label>
        <?php endforeach; endif; ?>
    </div>
</form>