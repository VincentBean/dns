<?php

namespace MamaOmida\Dns\Test\Unit\Records\Types;

use MamaOmida\Dns\Records\Types\NS;
use MamaOmida\Dns\Test\Unit\Records\AbstractRecordTestClass;

/**
 * @property NS $subject
 */
class NSTest extends AbstractRecordTestClass
{
    public function setUp(): void
    {
        $this->subject = new NS([]);
        parent::setUp();
    }

    public function testGetTarget()
    {
        $this->assertNull($this->subject->getTarget());
    }

    public function testGetTargetValue()
    {
        $value = 'test.target.com';
        $this->subject->setData(['target' => $value]);
        $this->assertSame($value, $this->subject->getTarget());
    }

}