<?php

namespace App\Enums;

enum AwardLevel: string
{
    case School = 'school';
    case District = 'district';
    case Province = 'province';
    case Region = 'region';
    case National = 'national';
    case International = 'international';

    public function label(): string
    {
        return match ($this) {
            self::School => 'โรงเรียน',
            self::District => 'เขตพื้นที่',
            self::Province => 'จังหวัด',
            self::Region => 'ภาค',
            self::National => 'ชาติ',
            self::International => 'นานาชาติ',
        };
    }

    /** @return array<string, string> */
    public static function options(): array
    {
        $options = [];

        foreach (self::cases() as $case) {
            $options[$case->value] = $case->label();
        }

        return $options;
    }
}
