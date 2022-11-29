<?php

namespace MamaOmida\Dns\Test\Unit\Records\Types;

use MamaOmida\Dns\Records\Types\A;
use MamaOmida\Dns\Records\Types\AAAA;
use MamaOmida\Dns\Test\Unit\Records\AbstractRecordTestClass;

/**
 * @property AAAA $subject
 */
class AAAATest extends AbstractRecordTestClass
{
    public function setUp(): void
    {
        $this->subject = new AAAA([]);
        parent::setUp();
    }

    public function testGetIp()
    {
        $this->assertNull($this->subject->getIPV6());
    }

    public function testGetIPV6Value()
    {
        $value = '::ffff:1451:6f55';
        $this->subject->setData(['ipv6' => $value]);
        $this->assertSame($value, $this->subject->getIPV6());
    }

}