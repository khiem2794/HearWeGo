<?php
/**
 * Created by PhpStorm.
 * User: khiem
 * Date: 21/07/2015
 * Time: 14:25
 */

namespace HearWeGo\HearWeGoBundle\Util;



class LatLongUtil {
    private $lat;
    private $long;

    public function __construct($lat = 0, $long = 0)
    {
        $this->lat = $lat;
        $this->long = $long;
    }


    /**
     * @return mixed
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @return mixed
     */
    public function getLong()
    {
        return $this->long;
    }

    /**
     * @param mixed $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @param mixed $long
     */
    public function setLong($long)
    {
        $this->long = $long;
    }

    public function decimalToLoc( $number ){
        list($lat, $long) = explode('.', $number);
        $this->setLat($lat);
        $this->setLong($long);
    }

    public function locToDecimal(){
        $number = implode('.', array($this->getLat(),$this->getLong()));
        return $number;
    }
}
