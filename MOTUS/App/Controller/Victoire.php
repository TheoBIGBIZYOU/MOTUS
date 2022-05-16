<?php

declare(strict_types=1);

namespace App\Controller;

class Victoire implements Controller
{
    public function render(): void
    {
        setcookie('nbTentative', '0');
        setcookie('currentWord', '');
        echo "<h2 style='color: red'>Félicitation tu as gagné !</h2>"; // ah bah j'ai pire que moi en design x)
        echo '<br><a href="/">REJOUER</a>';
    }
}
