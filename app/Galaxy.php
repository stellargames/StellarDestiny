<?php
/**
 * Created by PhpStorm.
 * User: Kender
 * Date: 26-Jan-16
 * Time: 19:31
 */

namespace Stellar;

class Galaxy
{

    const GALAXY_SMALL = 50;
    const GALAXY_MEDIUM = 150;
    const GALAXY_LARGE = 500;

    /**
     * @var array
     */
    protected $stars;


    /**
     * Galaxy constructor.
     */
    public function __construct() {
    }


    public function addStar($star) {
    }


    public function getSize() {
        return count($this->stars) ?: null;
    }


    public function generateStars($size) {
        for ($i = 0; $i < $size; $i++) {
            $this->stars[] = new Star();
        }
    }


    /**
     * @return Star
     */
    public function getAStar() {
        return reset($this->stars);
    }
}
