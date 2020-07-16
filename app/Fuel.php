<?php


namespace App;


class Fuel
{
    public const DIESEL = 'Diesel';
    public const GASOLINE = 'Gasoline';
    public const NATURAL_GAS = 'Natural gas';
    public const LPG = 'LPG';
    public const ETHANOL = 'Ethanol';
    public const ELECTRICITY = 'Electricity';
    public const HYDROGEN = 'Hydrogen';

    public const TYPES = [self::DIESEL, self::GASOLINE, self::NATURAL_GAS, self::LPG, self::ETHANOL, self::ELECTRICITY, self::HYDROGEN];

    public const UNITS = [
        self::DIESEL => ['long' => 'Liter', 'short' => 'L'],
        self::GASOLINE => ['long' => 'Liter', 'short' => 'L'],
        self::NATURAL_GAS => ['long' => 'Kilogram', 'short' => 'kg'],
        self::LPG => ['long' => 'Liter', 'short' => 'L'],
        self::ETHANOL => ['long' => 'Liter', 'short' => 'L'],
        self::ELECTRICITY => ['long' => 'Kilowatt-hour', 'short' => 'kWh'],
        self::HYDROGEN => ['long' => 'Kilogram', 'short' => 'kg'],
    ];
}
