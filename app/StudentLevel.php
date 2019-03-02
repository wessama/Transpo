<?php

namespace App;

use Konekt\Enum\Enum;

class StudentLevel extends Enum
{
    const __default = self::REGULAR;

    const REGULAR = 'Regular';
    const FRESHMAN   = 'Freshman';
    const SOPHOMORE = 'Sophomore';
    const JUNIOR = 'Junior';
    const SENIOR = 'Senior';

}