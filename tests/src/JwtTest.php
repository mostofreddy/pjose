<?php
/**
 * JwtTest
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
 * JwtTest
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
class JwtTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test claims method
     *
     * @return void
     */
    public function testClaims()
    {
        $expected = ['name' => 'pjose'];
        $o = new \mostofreddy\pjose\Jwt();
        $o->claims($expected);
        $this->assertAttributeEquals($expected, 'claims', $o);
    }

    /**
     * Test compact method
     *
     * @return void
     */
    public function testCompact()
    {
        $expected = 'YnV1dQ';

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jwt', 'compact');
        $ref->setAccessible(true);

        $o = new \mostofreddy\pjose\Jwt();

        $result = $ref->invokeArgs($o, ['buuu']);

        $this->assertEquals($expected, $result);
    }

     /**
     * Test uncompact method
     *
     * @depends testCompact
     * @return void
     */
    public function testUncompactString()
    {
        $expected = 'pjose';
        $o = new \mostofreddy\pjose\Jwt();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jwt', 'compact');
        $ref->setAccessible(true);
        $token = $ref->invokeArgs($o, [$expected]);

        $ref2 = new \ReflectionMethod('\mostofreddy\pjose\Jwt', 'uncompact');
        $ref2->setAccessible(true);
        $result = $ref2->invokeArgs($o, [$token]);

        $this->assertEquals($expected, $result);
    }

     /**
     * Test uncompact method
     *
     * @depends testCompact
     * @return void
     */
    public function testUncompactArray()
    {
        $expected = ['pjose'];
        $o = new \mostofreddy\pjose\Jwt();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jwt', 'compact');
        $ref->setAccessible(true);
        $token = $ref->invokeArgs($o, [$expected]);

        $ref2 = new \ReflectionMethod('\mostofreddy\pjose\Jwt', 'uncompact');
        $ref2->setAccessible(true);
        $result = $ref2->invokeArgs($o, [$token]);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test tostring method
     *
     * @return void
     */
    public function testToSting()
    {
        $expected = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJub25lIn0.eyJuYW1lIjoicGpvc2UifQ.';

        $o = new \mostofreddy\pjose\Jwt();
        $o->claims(['name' => 'pjose']);
        $result = (string) $o;

        $this->assertEquals($expected, $result);
    }
}
