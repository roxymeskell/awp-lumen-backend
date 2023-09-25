<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class EmployeeHappiness extends Model
{

    protected $table = 'employee_happiness';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'very_happy', 'happy', 'content', 'unhappy', 'very_unhappy',
    ];

    protected $appends = [
        'very_happy_percent', 'happy_percent', 'content_percent', 'unhappy_percent', 'very_unhappy_percent',
        'very_happy_and_happy_percent', 'not_happy_percent'
    ];

    protected function veryHappyPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['very_happy']
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }

    protected function happyPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['happy']
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }

    protected function contentPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['content']
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }

    protected function unhappyPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['unhappy']
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }

    protected function veryUnhappyPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => $attributes['very_unhappy']
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }

    protected function veryHappyAndHappyPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ($attributes['very_happy'] + $attributes['happy'])
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }

    protected function notHappyPercent(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => ($attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy'])
                / ($attributes['very_happy'] + $attributes['happy'] + $attributes['content'] + $attributes['unhappy'] + $attributes['very_unhappy']),
        );
    }
}
