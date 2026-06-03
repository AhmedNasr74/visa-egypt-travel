<?php

$locales = ['en', 'ru', 'fr', 'de', 'es', 'it', 'pt'];
$en = require __DIR__ . '/../lang/limo_ui/en.php';

foreach ($locales as $loc) {
    $uiPath = __DIR__ . "/../lang/limo_ui/{$loc}.php";
    $ui = is_file($uiPath) ? require $uiPath : $en;
    $sitePath = __DIR__ . "/../lang/{$loc}/site.php";
    $site = require $sitePath;
    $merged = array_merge($site, $ui);
    $lines = ["<?php\n", "\nreturn [\n"];
    foreach ($merged as $key => $value) {
        $exportedKey = var_export($key, true);
        $exportedVal = var_export($value, true);
        $lines[] = "    {$exportedKey} => {$exportedVal},\n";
    }
    $lines[] = "];\n";
    file_put_contents($sitePath, implode('', $lines));
    echo "Merged {$loc}: " . count($ui) . " limo_ui keys\n";
}
