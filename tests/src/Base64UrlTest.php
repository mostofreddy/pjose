<?php
/**
 * Base64UrlTest
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @category  StandardComponent
 * @package   StandardComponent\Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace mostofreddy\pjose\tests;

/**
 * Base64UrlTest
 *
 * Copyright (c) 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @category  StandardComponent
 * @package   StandardComponent\Tests
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class Base64UrlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test encode method
     * 
     * @return void
     */
    public function testEncode()
    {
        $result = \mostofreddy\pjose\Base64Url::encode('url string');
        $expected = 'dXJsIHN0cmluZw';
        $this->assertEquals($expected, $result);
    }

    /**
     * Test decode method
     *
     * @depends testEncode
     * @return void
     */
    public function testDencode()
    {
        $encodeString = \mostofreddy\pjose\Base64Url::encode('url string');
        $result = \mostofreddy\pjose\Base64Url::decode($encodeString);
        $expected = 'url string';
        $this->assertEquals($expected, $result);
    }
}
