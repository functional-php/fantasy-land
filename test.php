<?php

require __DIR__ . '/vendor/autoload.php';

use FunctionalPHP\FantasyLand\Useful\Identity;
use FunctionalPHP\FantasyLand as f;

$f = function (int $a): int {
    return $a + 1;
};

/** @psalm-trace $result */
$result = f\applicator(2);
$result = f\applicator(2);


/** @psalm-trace $result2 */
$result2 = $result($f);
/** @psalm-var int $result2 */
$result2 = $result($f);

/** @psalm-trace $result */
$result = f\applicator(2, $f);
