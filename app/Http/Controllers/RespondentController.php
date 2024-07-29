<?php

namespace App\Http\Controllers;

use App\Models\Respondent;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class RespondentController extends Controller
{
    public function generate(): JsonResponse
    {
        // getting data for each age group
        $lowerAges = Respondent::eiCount()->ages18To24()->get();
        $youngAges = Respondent::eiCount()->ages24To32()->get();
        $mediumAges = Respondent::eiCount()->ages32To40()->get();
        $fortiesAges = Respondent::eiCount()->ages40To45()->get();
        $olderAges = Respondent::eiCount()->ageMoreThan45()->get();

        // getting data grouped by city
        $cities = Respondent::eiCount()->byCity()->get()->mapToGroups(function ($item) {
            $key = $item['city_name'];
            unset($item['city_name']);

            return [$key => $item];
        });

        // getting data grouped by gender
        $genders = Respondent::eiCount()->byGender()->get()->mapToGroups(function ($item) {
            $key = $item['sex'] === 'f' ? 'Женщины' : 'Мужчины';
            unset($item['sex']);

            return [$key => $item];
        });

        // getting data for the chart of best respondents
        $best = Respondent::select(['name', 'ei'])->best()->limit(3)->get();

        return Response::json([
            [
                'label' => 'По городам',
                'data' => $cities,
            ],
            [
                'label' => 'По возрасту',
                'data' => [
                    '18-24' => $lowerAges,
                    '24-32' => $youngAges,
                    '32-40' => $mediumAges,
                    '40-45' => $fortiesAges,
                    '45+' => $olderAges,
                ]
            ],
            [
                'label' => 'По полу',
                'data' => $genders,
            ],
            [
                'label' => 'Лучшие показатели',
                'data' => $best,
            ],
        ]);
    }
}
