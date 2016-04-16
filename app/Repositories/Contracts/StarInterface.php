<?php
namespace Stellar\Repositories\Contracts;

interface StarInterface
{

    /**
     * @param StarInterface $star
     */
    public function linkTo(StarInterface $star);


    /**
     * The stars that can be jumped to from this star.
     *
     * @return array
     */
    public function getJumpPoints();


    public function getName();


    public function getTraders();
}
