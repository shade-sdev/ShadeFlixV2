<?php

require_once($_SERVER['DOCUMENT_ROOT'] . "/includes/classes/Dotenv.php");




(new DotEnv($_SERVER['DOCUMENT_ROOT']  . '/.env'))->setEnvironmentValue("YGGTORRENT_USERNAME", "maxime_ducon1");
(new DotEnv($_SERVER['DOCUMENT_ROOT'] . '/.env'))->load();

echo getenv('YGGTORRENT_USERNAME');
