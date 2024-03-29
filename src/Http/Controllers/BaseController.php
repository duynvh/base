<?php

namespace Si6\Base\Http\Controllers;

use Illuminate\Http\Request;
use Si6\Base\Traits\ResponseTrait;
use Laravel\Lumen\Routing\Controller;
use Si6\Base\Validators\BaseValidator;

class BaseController extends Controller
{
    use ResponseTrait;

    public function validateWith(Request $request, string $make)
    {
        /** @var BaseValidator $instance */
        $instance = app($make);

        $instance->setRequest($request);

        $rules      = $instance->rules();
        $messages   = $instance->messages();
        $attributes = $instance->attributes();

        $validator = $this->getValidationFactory()->make($request->all(), $rules, $messages, $attributes);

        if ($validator->fails()) {
            $this->throwValidationException($request, $validator);
        }

        return $this->extractInputFromRules($request, $rules);
    }
}
