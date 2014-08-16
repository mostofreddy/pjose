<?php
/**
 * Base64Url
 *
 * PHP version 5.4+
 *
 * Copyright (c) 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed
 * with this source code.
 *
 * @category  Pjose
 * @package   Pjose
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace mostofreddy\pjose;

/**
 * Base64Url
 *
 * @category  Pjose
 * @package   Pjose
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2014 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class Jwt
{
    protected $header = ['typ' => 'JWT', 'alg' => 'none'];
    protected $claims = [];
    protected $deps = [
        'base64url' => '\mostofreddy\pjose\Base64Url'
    ];
    protected $sign = '';
    /**
     * Construct
     */
    public function __construct()
    {
    }
    /**
     * Set payload data
     *
     * @param array $claims claims
     *
     * @return self
     */
    public function claims(array $claims)
    {
        $this->claims = $claims;

        return $this;
    }

    public function __toString()
    {
        return $this->encode();
    }
    /**
     * Generate token
     *
     * @return string
     */
    public function encode()
    {
        return implode(
            ".",
            [
                $this->compact($this->header),
                $this->compact($this->claims),
                $this->compact($this->sign)
            ]
        );
    }
    /**
     * Decode token
     *
     * @param  strign $token token
     * @return string
     */
    public function decode($token)
    {
        $segments = explode(".", $token);
        if (count($segments) != 3) {
            throw new \Exception('Wrong number of segments');
        }

        return [
            'header' => $this->uncompact($segments[0]),
            'claims' => $this->uncompact($segments[1]),
            'sign' => $segments[2]
        ];
    }
    /**
     * Utf8 & base64url encoding
     *
     * @param  array|string $data data to encode
     * @return string
     */
    protected function compact($data)
    {
        if (is_array($data)) {
            $data = json_encode($data);
        }
        $data = utf8_encode($data);
        $base64url = array($this->deps['base64url'], 'encode');

        return $base64url($data);
    }

    /**
     * Utf8 & base64url encoding
     *
     * @param  array|string $data data to encode
     * @return string
     */
    protected function uncompact($data)
    {
        $base64url = array($this->deps['base64url'], 'decode');
        $data = utf8_decode($base64url($data));
        $dataJson = json_decode($data, true);
        if ($dataJson !== null) {
            return $dataJson;
        } else {
            return $data;
        }
    }
}
