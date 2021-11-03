<?php

namespace OpenTokTest\Validators;

use OpenTok\Exception\InvalidArgumentException;
use OpenTok\Util\Validators;
use PHPUnit\Framework\TestCase;

class ValidatorsTest extends TestCase
{
    public function testWillPassCorrectPayload(): void
    {
        $this->expectNotToPerformAssertions();

        $options = [
            'excludedStreamIds' => [
                'streamId1',
                'streamId2'
            ],
            'active' => true
        ];

        Validators::validateForceMuteAllOptions($options);
    }

    public function testWillFailWhenStreamIdsAreNotCorrect(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $options = [
            'excludedStreamIds' => [
                3536,
                'streamId2'
            ],
            'active' => true
        ];

        Validators::validateForceMuteAllOptions($options);
    }

    public function testWillFailWhenActiveIsNotBool(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $options = [
            'excludedStreamIds' => [
                'streamId1',
                'streamId2'
            ],
            'active' => 'true'
        ];

        Validators::validateForceMuteAllOptions($options);
    }

    public function testWillFailWhenStreamIdsIsNotArray(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $options = [
            'excludedStreamIds' => 'streamIdOne',
            'active' => false
        ];

        Validators::validateForceMuteAllOptions($options);
    }
}
