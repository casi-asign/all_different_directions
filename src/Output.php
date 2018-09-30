<?php

namespace App;


class Output
{
    protected $input;

    public function __construct(string $input = '')
    {
        $this->input = $input;
    }

    /**
     *  Make instance statically
     * @param string $input
     * @return Output
     */
    public static function make(string $input) : Output
    {
        $self = new static($input);

        return $self;
    }

    /**
     *  Add input
     *
     * @param string $command_input
     * @return Output
     */
    public function addInput(string $command_input) : Output
    {
        $this->input .= $this->input ? PHP_EOL . $command_input : $command_input;

        return $this;
    }

    /**
     *  Calculate result
     * @return string
     */
    public function calculate() : string
    {
        $points = [];
        $x_summary = 0.0;
        $y_summary = 0.0;
        $rawData = explode(PHP_EOL, $this->input);
        $persons = array();
        $output = '';
        $i = 0;

        foreach($rawData as $results)
        {
            if(strpos($results,'start') === false) $i++;
            else $persons[$i][] = $results;
        }

        foreach($persons as $raws)
        {
            foreach($raws as $raw)
            {
                $directions = new Input($raw);
                $end_point = $directions->getEndPoint();
                $points[] = $end_point;
                $x_summary += $end_point['x'];
                $y_summary += $end_point['y'];
            }
            $average = [ 'x' => $x_summary / count($points), 'y' => $y_summary / count($points)];
            $distance = 0;

            foreach ($points as $point)
            {
                $command_distance = $this->squaredDistance($point, $average);

                if ($command_distance > $distance) $distance = $command_distance;
            }
            $distance = sqrt($distance);
            $output.= sprintf("%.5f %.5f %.5f", $average['x'], $average['y'], $distance).'<br>';
        }

        return $output;
    }

    /**
     *  Squared distance between two points
     * @param array $start
     * @param array $end
     * @return float
     */
    protected function squaredDistance(array $start, array $end) : float
    {
        return (($start['x'] - $end['x']) ** 2) + (($start['y'] - $end['y']) ** 2);
    }

}