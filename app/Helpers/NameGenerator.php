<?php
/**
 * Created by PhpStorm.
 * User: Kender
 * Date: 31-Jan-16
 * Time: 15:53
 */

namespace Stellar\Helpers;

class NameGenerator
{

    // No j,l,o,q,v,w to avoid look-alikes.
    const VOWELS = 'aeiuy';
    const CONSONANTS = 'bcdfghkmnprstxz';


    /**
     * Generate a star name.
     *
     * @return string
     */
    public function generateStarName() {

        $letterPart = mt_rand(0, 1) ? $this->generateThreePartName(
            self::CONSONANTS, self::VOWELS
        ) : $this->generateThreePartName(
            self::VOWELS, self::CONSONANTS
        );

        return $letterPart . '-' . $this->generateRandomNumber();
    }


    /**
     * @param string $firstSet  Letters to use for first and last letter.
     * @param string $secondSet Letters to use for middle letter.
     *
     * @return string
     */
    protected function generateThreePartName($firstSet, $secondSet) {
        return $this->generateRandomLetter($firstSet) . $this->generateRandomLetter(
            $secondSet
        ) . $this->generateRandomLetter($firstSet);
    }


    /**
     * @param string $letters
     *
     * @return string
     */
    protected function generateRandomLetter($letters) {
        return $letters[array_rand(str_split($letters))];
    }


    /**
     * @return string
     */
    protected function generateRandomNumber() {
        return sprintf('%03d', mt_rand(0, 999));
    }
}
