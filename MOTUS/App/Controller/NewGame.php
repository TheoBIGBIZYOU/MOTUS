<?php

declare(strict_types=1);

namespace App\Controller;

class NewGame implements Controller
{
    public function render(): void
    {
        $mot = $_COOKIE['currentWord'];
        echo "<h1 style='color: red'>LA REPONSE ÉTAIT : $mot </h1>";
        setcookie('nbTentative', '0');
        setcookie('currentWord', '');
        echo "<h2 style='color: red'>PERDU, PLUS DE TENTATIVE</h2>";
        echo '<br><a href="/">RETRY</a>';
    }
}
