<?php

namespace App\Enums;

enum TypeFuelEnumCast: string
{
    case TYPE_DIESEL = 'ДТ';
    case TYPE_BENZINE = 'Бензин';

    public function toString(): ?string
    {
        return match ($this) {
            self::TYPE_DIESEL => 'ДТ',
            self::TYPE_BENZINE => 'Бензин',
        };
    }

    public function getColor(): ?string
    {
        return match ($this) {
            self::TYPE_DIESEL => 'gray',
            self::TYPE_BENZINE => 'red',
            // self::NEW => 'info',
            // self::DRAFT => 'gray',
            // self::PUBLIC => 'success',
        };
    }
}
