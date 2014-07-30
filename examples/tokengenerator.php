<?php
/**
 * Base64Url
 *
 * PHP version 5.3+
 *
 * Copyright (c) 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed 
 * with this source code.
 *
 * @category  Pjose
 * @package   Pjose\Examples
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace mostofreddy\pjose\examples;

$path = realpath(__DIR__.'/../');
require_once $path."/vendor/autoload.php";

try {

    $jwt = new \mostofreddy\pjose\Jws();
    $claims = array('name' => "mosto");
    $jwt->claims($claims);
    $jwt->sign('secret');
    $token = (string) $jwt;

    echo $token.PHP_EOL;

    $result = $jwt->verify('secret', $token);
    var_dump($result);


} catch (\Exception $e) {
    echo "ERROR: ".$e->getMessage().PHP_EOL;
}
