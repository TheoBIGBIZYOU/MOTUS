<?php

declare(strict_types=1);

namespace App\Controller;

use App\Infra\Memory\DbSelector;
use App\Infra\Memory\WordsJson;

class Homepage implements Controller
{
    public function render()
    {
        $WordJson = new WordsJson();
        echo 'LE JEU MOTUS <br><br><br>';
        echo '
            <form action="" method="POST">
                <label for="word">LE MOT :</label>
                <input type="text" name="word">
                <button type="submit">VALIDER</button>
            </form>
        ';
        $WordJson->chooseWord();

        if(isset($_POST['word'])) {
            $WordJson->checkWord($_POST['word']);
        }
    }
}
