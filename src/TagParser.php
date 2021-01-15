<?php

namespace App;

class TagParser
{
    
    public function parse(string $tags): array
    {
        // set the second param optional, in this case is the wide space.
        // expcet a comma or a pipe, one of them.
        // add optional wide space at the begining too.
        return preg_split('/ ?[,|!] ?/', $tags);
    }
}