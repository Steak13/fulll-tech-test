<?php

namespace Backend\Domain;

class Location
{
    /** @var string $lat */
    private string $lat;
    /** @var string $long */
    private string $long;

    /**
     * @param string $lat
     * @param string $long
     */
    public function __construct(string $lat, string $long)
    {
        $this->lat = $lat;
        $this->long = $long;
    }

    /**
     * @return string
     */
    public function getLat(): string
    {
        return $this->lat;
    }

    /**
     * @return string
     */
    public function getLong(): string
    {
        return $this->long;
    }
}
