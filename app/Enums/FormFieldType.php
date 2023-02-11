<?php

namespace App\Enums;

enum FormFieldType: string
{
    case TEXT = 'text';
    case PASSWORD = 'password';
    case EMAIL = 'email';
    case CHECKBOX = 'checkbox';
    case RADIO = 'radio';
    case SELECT = 'select';
    case FILE = 'file';
    case NUMBER = 'number';

    public static function values(): array
    {
        return array_map(fn (FormFieldType $item) => $item->value, self::cases());
    }
}