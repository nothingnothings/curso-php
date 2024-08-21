<?php declare(strict_types=1);

namespace App;

class Monster extends NPC
{
    // Some properties

    // Additional method, not present in NPC (and questgiver):
    public function attack() {}
}
