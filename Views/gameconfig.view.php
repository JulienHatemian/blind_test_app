<h1>Blintest - Configuration</h1>
<form action="#" method="post" id="form-config">
    <div class="form-group">
        <legend>Genres:</legend>
        <?php if(isset($genres)) :?>
        <?php foreach($genres as $genre): ?>
            <input type="checkbox" name="genre" value="<?= $genre['idgenre'] ?>">
            <label for=""><?= $genre['libelle'] ?></label>
        <?php endforeach; endif; ?>
    </div>
    
    <div class="form-group">
        <legend>Types:</legend>
        <?php if(isset($types)) :?>
        <?php foreach($types as $type): ?>
            <input type="checkbox" name="type" value="<?= $type['idtype'] ?>">
            <label for=""><?= $type['libelle'] ?></label>
        <?php endforeach; endif; ?>
    </div>

    <div class="form-group">
        <div class="form-item">
            <label for="timer">Timer:</label>
            <input type="number" value="10" id="timer" name="timer"> second(s)
            <small>Min.: 1 sec - Max.: 30 sec</small>
        </div>
        <div class="form-item">
            <label for="rounds">Rounds:</label>
            <input type="number" value="10" id="rounds" name="rounds">
            <small>Min.: 1 round - Max.: 30 rounds</small>
        </div>
    </div>

    <div class="form-group">
        <legend>Game mode:</legend>
        <?php if(isset($gamemodes)) :?>
        <?php foreach($gamemodes as $gamemode): ?>
            <button type="submit" class="button-type" href="#"><?= $gamemode['libelle'] ?></button>
        <?php endforeach; endif; ?>
    </div>
</form>