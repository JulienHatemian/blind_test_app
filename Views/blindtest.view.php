<h1>BLINDTEST EN COURS</h1>
<div id="round"><?= $_SESSION['round'] . '/' . $_SESSION['totalround']  ?></div>
<div id="timer"><?= $_SESSION['timer'] ?></div>

<button data-params='quit'>Quit</button>
<button data-params='restart'>Restart</button>
<button data-params='pause'>Pause</button>
<button data-params='response'>Response</button>

<?php
    var_dump($_SESSION);
?>