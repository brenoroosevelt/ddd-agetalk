<?php
require 'vendor/autoload.php';

use AgetalkDDD\Academico\Infrastructure\Console\Menu;
use League\CLImate\CLImate;

$menu = new Menu(new CLImate());
$menu->execute();
