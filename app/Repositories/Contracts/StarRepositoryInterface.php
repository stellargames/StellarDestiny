<?php
namespace Stellar\Repositories\Contracts;

use Stellar\Exceptions\GalaxyException;

/**
 * Class Galaxy
 * @package Stellar
 */
interface StarRepositoryInterface
{

    /**
     * @return StarInterface
     */
    public static function getStartingStar();


    /**
     * @param StarInterface $star
     *
     * @throws GalaxyException
     */
    public function addStar(StarInterface $star);


    /**
     * @return int
     */
    public function getSize();


    /**
     * @param int $amount
     */
    public function generateStars($amount);


    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAllStars();


    /**
     * @return void
     */
    public function save();


    /**
     * @param $size
     *
     * @return StarRepositoryInterface
     */
    public function createNew($size);


    /**
     * @return StarRepositoryInterface
     */
    public function deleteAllStars();


    /**
     * @param string $name
     *
     * @return StarInterface
     */
    public function getStarByName($name);


    /**
     * @param $name
     *
     * @return StarInterface
     */
    public function createStar($name);

}
