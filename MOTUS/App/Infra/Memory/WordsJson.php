<?php

declare(strict_types=1);

namespace App\Infra\Memory;

use App\Elo\Word;

class WordsJson
{
    private array $words = [];
    private string $currentWord = "";
    private const FILE_PATH = __DIR__ . '/../../../var/db.json';

    private function loadFile()
    {
        if (empty($this->words)) {
            $this->words = json_decode(file_get_contents(self::FILE_PATH), true);
        }
        return $this->words;
    }

    public function chooseWord()
    {
        $this->loadFile();
        shuffle($this->words);
        if(!array_key_exists("currentWord",$_COOKIE) || $_COOKIE['currentWord'] === "") {
            $this->currentWord = $this->words[0]['mot'];
            setcookie("currentWord", $this->currentWord);
            setcookie("nbTentative", "0");
        }
        return $this->currentWord;
    }

    public function checkWord($word){
        $this->chooseWord();
        $nbTentative = $_COOKIE['nbTentative'] + 1;
        setcookie("nbTentative", "$nbTentative");
        $currentWord = $_COOKIE['currentWord'];
        $strLen = strlen($currentWord);
        echo "Le mot contient : $strLen caractères <br><br>";
        if (strlen($word) === strlen($_COOKIE['currentWord'])) {
            if($nbTentative <= 6) {
                echo '<div class="word">';
                echo "Tentative n° $nbTentative ";
                $tabWord = str_split($word);
                $tabCurrentWord = str_split($currentWord);
                echo '<table style="border-spacing: 10px; width: 30%;height: 10%"><tr>';
                foreach ($tabCurrentWord as $keyCurrentWord => $value) {
                    if($currentWord === $word) echo header("Location: /victoire");
                    if ($value === $tabWord[$keyCurrentWord]) echo "<td style='color: green;border: 1px solid black;text-align: center'>$tabWord[$keyCurrentWord]</td>";
                    elseif ($value != $tabWord[$keyCurrentWord]) {
                        if (in_array($tabWord[$keyCurrentWord], $tabCurrentWord)) echo "<td style='color:yellow;border: 1px solid black;text-align: center'>$tabWord[$keyCurrentWord]</td>";
                        else {
                            echo "<td style='color:red;border: 1px solid black;text-align: center'>$tabWord[$keyCurrentWord]</td>";
                        }
                    }
                }
                echo '</table></tr>';
                echo '</div>';
            } else {
                header("Location: /retry");
                die();
            }
        }
        else{
            echo "<h2 style='color: red'>Pas le même nombre de caractères</h2>";
        }
    }
}
