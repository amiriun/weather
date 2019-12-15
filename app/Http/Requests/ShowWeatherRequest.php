<?php

namespace App\Http\Requests;

use App\Contracts\HTTP\FormRequestContract;
use App\DataContracts\HTTP\ShowWeatherDTO;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class ShowWeatherRequest extends FormRequest implements FormRequestContract
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date_format:Y-m-d|after_or_equal:today|before_or_equal:'.Carbon::now()->addDays(10),
            'degree_type' => 'required|in:celsius,fahrenheit',
        ];
    }

    /**
     * @return \App\DataContracts\HTTP\ShowWeatherDTO
     */
    public function getDTO(){
        $DTO = new ShowWeatherDTO();
        $DTO->date = Carbon::make($this->get('date'));
        $DTO->degreeType = $this->get('degree_type');

        return $DTO;
    }
}
