<?php
namespace Stellar\Repositories\Contracts;

use Stellar\Exceptions\GalaxyException;
use Stellar\Models\Star;

/**
 * Class Galaxy
 * @package Stellar
 */
interface StarRepositoryInterface
{

    /**
     * @param Star $star
     *
     * @throws GalaxyException
     */
    public function addStar(Star $star);


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
     * @return Star
     */
    public static function getStartingStar();


    /**
     * @return void
     */
    public function save();
    
    public function createNew($size);
    public function deleteAllStars();
    
    
}
