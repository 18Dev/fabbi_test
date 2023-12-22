<?php

namespace App\Services;

use App\Interfaces\DishesInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * @DishesService
 */
class DishesService implements DishesInterface
{
    /**
     * @param $request
     *
     * @return array
     */
    public function stepOne($request)
    {
        // Data request
        $meal = strtolower($request->meal);

        // Get data fake
        $data = $this->fakeData();

        //Get the list of restaurants that serve meals in step 1
        $listDishes = $data->where(function ($item) use ($meal) {
            if (array_search($meal, $item['availableMeals']) !== false) {
                return $item;
            }
        })->pluck('restaurant')->unique(); // Eliminate repeated restaurant names

        return [!$listDishes->isEmpty(), $listDishes];
    }

    /**
     * @param $request
     *
     * @return array
     */
    public function stepTwo($request)
    {
        // Data request
        $restaurant = $request->restaurant;

        // Get data fake
        $data = $this->fakeData();

        // Get the list of dishes from the restaurant selected in step 2
        $listDishName = $data->where('restaurant', $restaurant)
            ->pluck('name')->unique(); // Eliminate repetitive dish names

        return [!$listDishName->isEmpty(), $listDishName];
    }

    /**
     * @param $request
     *
     * @return false
     */
    public function stepThree($request)
    {
        /**
         * The total number of dishes (i.e Number of dishes * respective serving) should be greater or equal
         * to the number of people selected in the first step and a maximum of 10 is allowed.
         */
        $totalNumberOfDishes = collect($request['options'])->sum('number_servings') * count($request['options']);
        if ($request['number_people'] <= $totalNumberOfDishes && $totalNumberOfDishes < 10) {
            $request['meal'] = ucfirst(strtolower($request['meal']));

            return $request;
        }

        return false;
    }

    /**
     * @param $dataRequest
     * @return void
     *
     * @throws ValidationException
     */
    public function validateStepThree($dataRequest)
    {
        $dataRequest["options"] = [];

        // Transform request to have distinct validation
        foreach ($dataRequest as $key => $value) {
            static $flag = [];
            if (strpos($key, 'dish_') !== false) {
                $flag['dish'] = $value;
                unset($dataRequest[$key]);
            }

            if (strpos($key, 'number_servings_') !== false) {
                $flag['number_servings'] = $value;
                array_push($dataRequest["options"], $flag);
                unset($flag);
                unset($dataRequest[$key]);
            }
        }

        Validator::make(
            $dataRequest,
            [ // rule
                'options.*.dish'            => 'bail|required|distinct',
                'options.*.number_servings' => 'bail|required|numeric'
            ],
            [ // message
                'options.*.dish.required' => __('validation.required', ['attribute' => 'dish']),
                'options.*.dish.distinct' => __('validation.distinct', ['attribute' => 'dish']),
                'options.*.dish.number_servings' => __('validation.required', ['attribute' => 'number servings']),
                'options.*.dish.number_servings' => __('validation.numeric', ['attribute' => 'number servings']),
            ]
        )->validate();

        return $dataRequest;
    }

    /**
     * @return Collection
     */
    private function fakeData()
    {
        // Get data file json
        $dishes = File::json(storage_path('data/dishes.json'), JSON_THROW_ON_ERROR);
        // Convert data into collection
        return collect($dishes['dishes']);
    }
}
