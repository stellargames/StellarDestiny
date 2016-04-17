<?php
namespace Stellar\Api\Contracts;

interface PlayerInterface
{

    /**
     * Get the name of the player.
     *
     * @return string
     */
    public function getName();


    /**
     * Get the reputation of the player.
     *
     * This represents the "level" or status of the player.
     *
     * @return int
     */
    public function getReputation();


    /**
     * Get the alignment of the player.
     *
     * An alignment of 0 is neutral, a positive alignment represents good, a negative alignment evil.
     * This is adjusted based on the actions of the player and can affect reactions of others.
     *
     * @return int
     */
    public function getAlignment();


    /**
     * Get the affiliation of the player.
     *
     * This represents the balance between nature and technology.
     * Negative is associated with technology and positive with nature.
     *
     * @return int
     */
    public function getAffiliation();


    /**
     * Get the ship the player is currently using.
     *
     * @return \Stellar\Api\Contracts\ShipInterface
     */
    public function getShip();


    /**
     * Get all the ships the player owns.
     *
     * @return array
     */
    public function getShips();


    /**
     * Attach a basic starter ship to the player.
     *
     * @param \Stellar\Api\Contracts\ShipInterface $ship
     *
     * @return PlayerInterface
     */
    public function setShip(ShipInterface $ship);
}
