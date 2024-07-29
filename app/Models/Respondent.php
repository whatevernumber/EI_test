<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Respondent extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * Scope for getting EI counts
     *
     * @param Builder $query
     * @return void
     */
    public function scopeEiCount(Builder $query): void
    {
        $query->selectRaw("COUNT(CASE WHEN ei < 85 THEN 1 END) as low,
                COUNT(CASE WHEN ei BETWEEN 85 AND 95 THEN 1 END) as premiddle,
                    COUNT(CASE WHEN ei BETWEEN 95 AND 105 THEN 1 END) as middle,
                        COUNT(CASE WHEN ei BETWEEN 105 AND 115 THEN 1 END) as high,
                            COUNT(CASE WHEN ei > 115 THEN 1 END) as ultra");
    }

    /**
     * Select data grouped by city
     *
     * @param Builder $query
     * @return void
     */
    public function scopeByCity(Builder $query): void {
        $query->addSelect('city_name')
            ->join('cities', 'city_id', '=', 'cities.id')
            ->groupBy('city_name');
    }

    /**
     * Select data grouped by gender
     *
     * @param Builder $query
     * @return void
     */
    public function scopeByGender(Builder $query): void {
        $query->addSelect('sex')->groupBy('sex');
    }

    /**
     * Select random respondents with highest EI
     *
     * @param Builder $query
     * @return void
     */
    public function scopeBest(Builder $query): void
    {
        $query->orderByRaw('ei DESC, RAND()');
    }

    /**
     * Select data for females only.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeFemale(Builder $query): void
    {
        $query->where(['sex' => 'f']);
    }

    /**
     * Select data for males only.
     *
     * @param Builder $query
     * @return void
     */
    public function scopeMale(Builder $query): void
    {
        $query->where(['sex' => 'm']);
    }

    /**
     * Select data for ages 18 to 24
     *
     * @param Builder $query
     * @return void
     */
    public function scopeAges18To24(Builder $query): void
    {
        $query->whereRaw('age BETWEEN 18 AND 24');
    }

    /**
     * Select data for ages 24 to 32
     *
     * @param Builder $query
     * @return void
     */
    public function scopeAges24To32(Builder $query): void
    {
        $query->whereRaw('age BETWEEN 24 AND 32');
    }

    /**
     * Select data for ages 32 to 40
     *
     * @param Builder $query
     * @return void
     */
    public function scopeAges32To40(Builder $query): void
    {
        $query->whereRaw('age BETWEEN 32 AND 40');
    }

    /**
     * Select data for ages 40 to 45
     *
     * @param Builder $query
     * @return void
     */
    public function scopeAges40To45(Builder $query): void
    {
        $query->whereRaw('age BETWEEN 40 AND 45');
    }

    /**
     * Select data for ages more than 45
     *
     * @param Builder $query
     * @return void
     */
    public function scopeAgeMoreThan45(Builder $query): void
    {
        $query->where('age', '>', 45);
    }


    /**
     * Select data for Moscow only
     *
     * @param Builder $query
     * @return void
     */
    public function scopeMoscow(Builder $query): void
    {
        $query->whereHas('city', function ($query) {
            $query->where(['city_name' => 'Москва']);
        });
    }

    /**
     * Select data for Krasnodar only
     *
     * @param Builder $query
     * @return void
     */
    public function scopeKrasnodar(Builder $query): void
    {
        $query->whereHas('city', function ($query) {
            $query->where(['city_name' => 'Краснодар']);
        });
    }

    /**
     * Select data for Vladivostok only
     *
     * @param Builder $query
     * @return void
     */
    public function scopeVladivostok(Builder $query): void
    {
        $query->whereHas('city', function ($query) {
            $query->where(['city_name' => 'Владивосток']);
        });
    }

    /**
     * Select data for SPB only
     *
     * @param Builder $query
     * @return void
     */
    public function scopeSPB(Builder $query): void
    {
        $query->whereHas('city', function ($query) {
            $query->where(['city_name' => 'Санкт-Петербург']);
        });
    }
}
