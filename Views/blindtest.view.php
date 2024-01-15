<h1>BLINDTEST EN COURS</h1>
<div id="round"><?= $_SESSION['blindtest']['rounds']['actual'] . '/' . $_SESSION['blindtest']['rounds']['total']  ?></div>
<div id="timer"><?= $_SESSION['blindtest']['timer']['left'] ?></div>

<button data-params='quit'>Quit</button>
<button data-params='restart'>Restart</button>
<button data-params='pause'>Pause</button>
<button data-params='result'>Result</button>
<button data-params='start'>Timer</button>

<?php
    var_dump($_SESSION);
?>