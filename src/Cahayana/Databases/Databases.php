<?php
/**
 * @package     Cahayana\Databases - Databases
 * @author      singkek
 * @copyright   Copyright(c) 2021
 * @version     1
 * @created     2021-05-08
 * @updated     -
 **/
namespace Cahayana\Databases;

use Cahayana\Contracts\Databases\DatabasesInterface;
use Cahayana\Databases\Bus\Databases as DatabasesTrait;

class Databases implements DatabasesInterface
{
    use DatabasesTrait;
}
