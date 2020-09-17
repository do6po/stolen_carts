<?php

$envFileName = ".env";

if (php_sapi_name() == 'cli') {
    $input = new Symfony\Component\Console\Input\ArgvInput();
    $environment = env('APP_ENV');
    $envParameterOption = $input->getParameterOption('--env') ?: $environment;
    if (
        $envParameterOption
        && file_exists(__DIR__ . '/../' . $envFileName . '.' . $envParameterOption)
    ) {
        $envFileName .= '.' . $envParameterOption;
    }
}

return $envFileName;
