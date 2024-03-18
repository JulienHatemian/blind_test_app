<div id="configcontainer">
    <h2>Blintest - Configuration</h2>
    <form action="<?= URL; ?>blindtest" method="post" id="form-config">
        <div class="form-group">
            <legend>Genres:</legend>
            <?php if(isset($genres)) :?>
            <?php foreach($genres as $genre): ?>
                <input type="checkbox" name="genre[]" value="<?= $genre['idgenre'] ?>" id="checkGenre<?= $genre['libelle'] ?>">
                <label for="checkGenre<?= $genre['libelle'] ?>"><?= $genre['libelle'] ?></label>
            <?php endforeach; endif; ?>
        </div>
        
        <div class="form-group">
            <legend>Types:</legend>
            <?php if(isset($types)) :?>
            <?php foreach($types as $type): ?>
                <input type="checkbox" name="type[]" value="<?= $type['idtype'] ?>" id="checkType<?= $type['libelle'] ?>">
                <label for="checkType<?= $type['libelle'] ?>"><?= $type['libelle'] ?></label>
            <?php endforeach; endif; ?>
        </div>

        <div class="form-group">
            <!-- <div class="form-item"> -->
                <label for="timer">Timer:</label>
                <input type="number" value="10" id="timer" name="timer" min="1" max="30"> second(s)
                <small>Min.: 1 sec - Max.: 30 sec</small>
        </div>
        <div class="form-group">
            <!-- <div class="form-item"> -->
                <label for="rounds">Rounds:</label>
                <input type="number" value="10" id="rounds" name="rounds" min="1" max="30">
                <small>Min.: 1 round - Max.: 30 rounds</small>
            <!-- </div> -->
        </div>

        <div class="form-group">
            <legend>Game mode:</legend>
            <?php if(isset($gamemodes)) :?>
            <?php foreach($gamemodes as $gamemode): ?>
                <button type="submit" class="button-type" name="gamemode" value="<?= $gamemode['idgamemode'] ?>" <?php echo(($gamemode['active'] == 0) ? 'disabled' : '') ?>><?= $gamemode['libelle'] ?></button>
            <?php endforeach; endif; ?>
        </div>
    </form>
</div>