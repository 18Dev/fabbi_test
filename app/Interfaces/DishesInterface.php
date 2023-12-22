<?php

namespace App\Interfaces;

/**
 * @DishesInterface
 */
interface DishesInterface
{
    public function stepOne($request);

    public function stepTwo($request);
    public function stepThree($request);
    public function validateStepThree($request);
}
