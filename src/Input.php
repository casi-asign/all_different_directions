<?php

namespace App;


class Input
{
    protected $x;
    protected $y;
    protected $deg = 0.0;
    protected $actions = [];
    protected $points = [];

    public function __construct(string $rawData)
    {
        $parsed_command = $this->parsing($rawData);

        if($parsed_command != '')
        {
                $this->x = (float)array_shift($parsed_command);
                $this->y = (float)array_shift($parsed_command);

                $this->actions = $parsed_command;
        }
    }

    /**
     *  Get command parts as array
     *
     * @param string $rawData
     * @return array
     * @throws \InvalidArgumentException
     */
    protected function parsing(string $rawData) : array
    {
        $result = explode(' ', $rawData);

        return $result;
    }

    /**
     *  Calculate ent point coordinates
     * @return array
     * @throws \InvalidArgumentException
     */
    public function getEndPoint()
    {
        $action = trim(array_shift($this->actions));
        $value = array_shift($this->actions);

        $this->{$action}((float)$value);

        return [ 'x' => $this->x, 'y' => $this->y ];
    }

    /**
     *  Set moving direction
     * @param float $deg
     * @return Input
     */
    protected function start(float $deg) : Input
    {
        $this->deg = $deg;

        return $this;
    }

    /**
     *  Do action "walk"
     * @param float $distance
     * @return Input
     */
    protected function walk(float $distance) : Input
    {
        $this->x += $distance * cos(deg2rad($this->deg));
        $this->y += $distance * sin(deg2rad($this->deg));

        $this->points[] = [ 'x' => $this->points, 'y' => $this->y ];

        return $this;
    }

    /**
     *  Do action "turn"
     * @param float $deg
     * @return Input
     */
    protected function turn(float $deg) : Input
    {
        $this->deg += $deg;

        return $this;
    }
}