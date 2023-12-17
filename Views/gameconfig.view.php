<h1>Blintest - Configuration</h1>
<form action="#" method="post" id="form-config">
    <div class="form-input">
        <legend>Genres:</legend>
        <?php if(isset($genres)) :?>
        <?php foreach($genres as $genre): ?>
            <input type="checkbox" name="genre" value="<?= $genre['idgenre'] ?>">
            <label for=""><?= $genre['libelle'] ?></label>
        <?php endforeach; endif; ?>
    </div>
    
    <div class="form-input">
        <legend>Types:</legend>
        <?php if(isset($types)) :?>
        <?php foreach($types as $type): ?>
            <input type="checkbox" name="type" value="<?= $type['idtype'] ?>">
            <label for=""><?= $type['libelle'] ?></label>
        <?php endforeach; endif; ?>
    </div>

    <div class="form-input">
        <legend>Mode de jeu:</legend>
        <?php if(isset($gamemodes)) :?>
        <?php foreach($gamemodes as $gamemode): ?>
            <button type="submit" class="button-type" href="#"><?= $gamemode['libelle'] ?></button>
        <?php endforeach; endif; ?>
    </div>
</form>