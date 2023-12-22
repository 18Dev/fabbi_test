<?php

namespace App\Http\Controllers;

use App\Http\Requests\StepOneRequest;
use App\Http\Requests\StepTwoRequest;
use App\Interfaces\DishesInterface;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

/**
 * @DishesController
 */
class DishesController extends Controller
{
    protected $dishes;

    public function __construct(DishesInterface $dishes)
    {
        $this->dishes = $dishes;
    }

    /**
     * @param StepOneRequest $request
     *
     * @return JsonResponse
     */
    public function stepOne(StepOneRequest $request)
    {
        [$result, $data] = $this->dishes->stepOne($request);

        return $result ? $this->responseSuccess(message: __('response.next_step', ['step' => 2]),
            data: [
                'step'    => 'step-2',
                'data'    => $data,
                'elm'     => 'restaurant',
                'urlStep' => route('step-2'),
            ]
        ) : $this->responseFailed(message: __('response.failed', ['step' => 1]));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function stepTwo(StepTwoRequest $request)
    {
        [$result, $data] = $this->dishes->stepTwo($request);

        return $result ? $this->responseSuccess(message: __('response.next_step', ['step' => 3]),
            data: [
                'step'    => 'step-3',
                'data'    => $data,
                'elm'     => 'dish_1',
                'urlStep' => route('step-3'),
            ]
        ) : $this->responseFailed(message: __('response.failed', ['step' => 2]));
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function stepThree(Request $request)
    {
        $dataRequest = $this->dishes->validateStepThree($request->all());

        $result = $this->dishes->stepThree($dataRequest);

        return $result ? $this->responseSuccess(message: __('response.next_step', ['step' => 4]),
            data: [
                'step'    => 'step-4',
                'data'    => $result,
                'urlStep' => route('step-4'),
            ]
        ) : $this->responseFailed(message: __('The total number of dishes should be greater or equal to the number of people selected in the first step and a maximum of 10 is allowed.'));
    }
}
