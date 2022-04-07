<?php

declare(strict_types=1);

namespace App\Controller;

class Victoire implements Controller
{
    public function render()
    {
        setcookie("nbTentative", "0");
        setcookie("currentWord", "");
        echo "<h2 style='color: red'>Félicitation tu as gagné !</h2>";
        echo '<br><a href="/">REJOUER</a>';
    }
}
