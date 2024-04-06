<div id="configcontainer">
    <h2>Blintest - Configuration</h2>
    <form action="<?= URL; ?>blindtest" method="post" id="form-config">
        <div class="form-group">
            <?php if(isset($genres)) :?>
                <legend>Genres:</legend>
                <div class="checkbox-container d-flex flex-row">
                    <?php foreach($genres as $genre): ?>
                        <div class="checkbox">
                            <input type="checkbox" name="genre[]" value="<?= $genre['idgenre'] ?>" id="checkGenre<?= $genre['libelle'] ?>">
                            <label for="checkGenre<?= $genre['libelle'] ?>"><?= $genre['libelle'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="form-group">
            <?php if(isset($types)) :?>
                <legend>Types:</legend>
                <div class="checkbox-container d-flex flex-row">
                    <?php foreach($types as $type): ?>
                        <div class="checkbox">
                            <input type="checkbox" name="type[]" value="<?= $type['idtype'] ?>" id="checkType<?= $type['libelle'] ?>">
                            <label for="checkType<?= $type['libelle'] ?>"><?= $type['libelle'] ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <!-- <div class="form-item"> -->
                <legend>Timer:</legend>
                <input type="number" value="10" id="timer" name="timer" min="1" max="30"> second(s)
                <br>
                <small>Min.: 1 sec - Max.: 30 sec</small>
        </div>
        <div class="form-group">
            <!-- <div class="form-item"> -->
                <legend>Rounds:</legend>
                <input type="number" value="10" id="rounds" name="rounds" min="1" max="30">
                <br>
                <small>Min.: 1 round - Max.: 30 rounds</small>
            <!-- </div> -->
        </div>

        <div class="form-group">
            <?php if(isset($gamemodes)) :?>
                <legend>Game mode:</legend>
                <?php foreach($gamemodes as $gamemode): ?>
                    <button type="submit" class="button-type" name="gamemode" value="<?= $gamemode['idgamemode'] ?>" <?php echo(($gamemode['active'] == 0) ? 'disabled' : '') ?>><?= $gamemode['libelle'] ?></button>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </form>
</div>