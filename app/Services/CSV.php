<?php

namespace App\Services;


class CSV
{
    private $data;

    public function __construct($string)
    {
        $this->data = $string;

        return $this;
    }

    /**
     * @return array
     * @throws \Exception
     */
    public function toArray()
    {
        if (is_null($this->data)) {
            throw new \Exception("Input data was null, first should fill input from one of getData methods.");
        }
        $rows = array_filter(explode(PHP_EOL, $this->data));
        $header = null;
        $data = [];
        foreach ($rows as $row) {
            $row = str_getcsv($row, ",", '"', "\\");
            if (! $header) {
                $header = $row;
            } else {
                $data[] = array_combine($header, $row);
            }
        }

        return $data;
    }
}