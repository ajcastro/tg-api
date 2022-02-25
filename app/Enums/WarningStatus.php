<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class WarningStatus extends Enum
{
    const NoWarning =   0;
    const Suspend =   1;
    const Blacklist = 2;
}
