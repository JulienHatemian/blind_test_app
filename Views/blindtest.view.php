<h1>BLINDTEST EN COURS</h1>
<div id="round"><span id="actualround"><?= $_SESSION['blindtest']['rounds']['actual'] . '</span> / ' . $_SESSION['blindtest']['rounds']['total']  ?></div>
<div id="timer"><?= $_SESSION['blindtest']['timer']['left'] ?></div>

<button data-params='quit' id="quit">Quit</button>
<button data-params='restart' id="restart">Restart</button>
<button data-params='previous' id="previous">Previous</button>
<!-- <button data-params='pause' id="pause">Pause</button> -->
<button data-params='play' id="play">Play</button>
<button data-params='next' id="next">Next</button>
<button data-params='result' id="result">Result</button>
<button data-params='start' id="start">Start</button>

<?php
    var_dump($_SESSION['blindtest']);
?>