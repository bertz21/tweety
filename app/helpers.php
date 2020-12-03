<?php

// this ufnction is manullay created and will be loadded in the composer.json file in the autoload section
// It is register like this in composer because it is a files
// "files": [
//     "app/helpers.php"
//  ]
//  after the psr-4
// you also need to dump composer autoload in order to make it work
// by using composer dump-autoload

function current_user() 
{
    return Auth()->user();
}


