<?php

/**
* OpenTok PHP Library
* http://www.tokbox.com/
*
* Copyright (c) 2011, TokBox, Inc.
* Permission is hereby granted, free of charge, to any person obtaining
* a copy of this software and associated documentation files (the "Software"), 
* to deal in the Software without restriction, including without limitation 
* the rights to use, copy, modify, merge, publish, distribute, sublicense, 
* and/or sell copies of the Software, and to permit persons to whom the
* Software is furnished to do so, subject to the following conditions:
* 
* The above copyright notice and this permission notice shall be included
* in all copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS
* OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL 
* THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN 
* THE SOFTWARE.
*/

namespace OpenTok;

use OpenTok\Exception\InvalidArgumentException;

class Session
{
    protected $sessionId;
    protected $location;
    protected $p2p;

    function __construct($sessionId, $properties = array())
    {
        // unpack arguments
        $defaults = array('p2p' => false, 'location' => null);
        $properties = array_merge($defaults, array_intersect_key($properties, $defaults));
        list($p2p, $location) = array_values($properties);

        if (is_string($sessionId) && !empty($sessionId)) {
            $this->sessionId = $sessionId;
        } else {
            throw new InvalidArgumentException();
        }

        if (!empty($location)) { // leaving the location property empty is okay
            if (is_string($location) && self::isValidLocation($location)) {
                $this->location = $location;
            } else {
                throw new InvalidArgumentException();
            }
        }

        if (is_bool($p2p)) {
            $this->p2p = $p2p;
        } else {
            throw new InvalidArgumentException();
        }
    }

    public function getSessionId()
    {
        return $this->sessionId;
    }

    public function getLocation()
    {
        return $this->location;
    }

    public function getP2p()
    {
        return $this->p2p;
    }

    public static function isValidLocation($location)
    {
        return (bool)filter_var($location, FILTER_VALIDATE_IP);
    }

    public function __toString()
    {
        return $this->sessionId;
    }

}


class SessionPropertyConstants {
  const P2P_PREFERENCE = 'p2p.preference';
}

/* vim: set ts=4 sw=4 tw=100 sts=4 et :*/