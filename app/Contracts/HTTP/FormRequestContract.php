<?php
/**
 * Created by PhpStorm.
 * User: amir
 * Date: 12/15/19
 * Time: 1:42 PM
 */

namespace App\Contracts\HTTP;

interface FormRequestContract
{
    public function authorize();

    public function rules();

    public function getDTO();
}