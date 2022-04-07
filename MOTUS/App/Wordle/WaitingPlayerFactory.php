<?php

declare(strict_types=1);

namespace App\Elo;

class WaitingPlayerFactory
{
    public static function createFromPlayer(Word $word): WaitingWord
    {
        return new WaitingWord($word->word);
    }
}
