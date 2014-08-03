<?php
/**
 * JwsTest
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
 * JwsTest
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
class JwsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test isvalidalg method
     *
     * @expectedException \DomainException
     * @return void
     */
    public function testIsValidAlg()
    {
        $o = new \mostofreddy\pjose\Jws();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jws', 'isValidAlg');
        $ref->setAccessible(true);
        $result = $ref->invokeArgs($o, ['invalidalg']);
    }
    /**
     * Test isvalidalg method
     *
     * @return void
     */
    public function testIsValidAlgHS256()
    {
        $o = new \mostofreddy\pjose\Jws();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jws', 'isValidAlg');
        $ref->setAccessible(true);
        $result = $ref->invokeArgs($o, ['HS256']);

        $this->assertTrue($result);
    }

    /**
     * Test isvalidalg method
     *
     * @return void
     */
    public function testIsValidAlgHS384()
    {
        $o = new \mostofreddy\pjose\Jws();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jws', 'isValidAlg');
        $ref->setAccessible(true);
        $result = $ref->invokeArgs($o, ['HS384']);

        $this->assertTrue($result);
    }

    /**
     * Test isvalidalg method
     *
     * @return void
     */
    public function testIsValidAlgHS512()
    {
        $o = new \mostofreddy\pjose\Jws();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jws', 'isValidAlg');
        $ref->setAccessible(true);
        $result = $ref->invokeArgs($o, ['HS512']);

        $this->assertTrue($result);
    }

    /**
     * Test _sign method
     *
     * @return void
     */
    public function testSignHS256()
    {
        $expected = 'ZdZWH/nOjMT3G9APGptiLuAQuM27kpWhW5Az7H0BbNM=';

        $o = new \mostofreddy\pjose\Jws();
        $o->claims(['name' => 'pjose']);
        $o->sign('secret');

        $ref = new \ReflectionProperty('\mostofreddy\pjose\Jwt', 'sign');
        $ref->setAccessible(true);

        $this->assertEquals($expected, base64_encode($ref->getValue($o)));
    }

    /**
     * Test _sign method
     *
     * @return void
     */
    public function testSignHS384()
    {
        $expected = '+zpbm0ZfC395COdF43fl9x/biwEm3yGXIrpGpuVrwyevbb1vitjmfqDs9/euCUqV';

        $o = new \mostofreddy\pjose\Jws();
        $o->claims(['name' => 'pjose']);
        $o->sign('secret', 'HS384');

        $ref = new \ReflectionProperty('\mostofreddy\pjose\Jwt', 'sign');
        $ref->setAccessible(true);

        $this->assertEquals($expected, base64_encode($ref->getValue($o)));
    }

    /**
     * Test _sign method
     *
     * @return void
     */
    public function testSignHS512()
    {
        $expected = '7k+ahHRy/OzDddXdwEiB7L6wlNsyuMsjloLOPXMf0fXKYpVxbzwe92MYdz40oH3OLivbp/JdRiuQ11uqjf6vbg==';

        $o = new \mostofreddy\pjose\Jws();
        $o->claims(['name' => 'pjose']);
        $o->sign('secret', 'HS512');

        $ref = new \ReflectionProperty('\mostofreddy\pjose\Jwt', 'sign');
        $ref->setAccessible(true);

        $this->assertEquals($expected, base64_encode($ref->getValue($o)));
    }

    /**
     * Test isvalidalg method
     *
     * @expectedException \DomainException
     * @return void
     */
    public function testPrivateSign()
    {
        $o = new \mostofreddy\pjose\Jws();

        $ref = new \ReflectionMethod('\mostofreddy\pjose\Jws', 'signedToken');
        $ref->setAccessible(true);
        $result = $ref->invokeArgs($o, ['secret']);

        $this->assertTrue($result);
    }

    /**
     * Test verify method
     *
     * @return void
     */
    public function testVerifyOk()
    {

        $o = new \mostofreddy\pjose\Jws();
        $o->claims(['name' => 'pjose']);
        $o->sign('secret');
        $token = (string) $o;

        $this->assertTrue($o->verify('secret', $token));

    }

    /**
     * Test verify method
     *
     * @return void
     */
    public function testVerifyNOk()
    {
        $o = new \mostofreddy\pjose\Jws();
        $o->claims(['name' => 'pjose']);
        $o->sign('secret');
        $token = (string) $o;

        $this->assertFalse($o->verify('secret', substr($token, 0, -1)));
    }

    /**
     * Test verify method
     *
     * @expectedException \Exception
     * @return void
     */
    public function testVerifyException()
    {
        $o = new \mostofreddy\pjose\Jws();
        $token = "dummy";

        $this->assertFalse($o->verify('secret', $token));

    }
}
