<?php

namespace Stellar\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Stellar\Models\Ship
 *
 * @property integer                                                                    $id
 * @property integer                                                                    $user_id
 * @property integer                                                                    $star_id
 * @property integer                                                                    $ship_type_id
 * @property integer                                                                    $energy
 * @property integer                                                                    $structure
 * @property integer                                                                    $credits
 * @property string                                                                     $name
 * @property \Carbon\Carbon                                                             $created_at
 * @property \Carbon\Carbon                                                             $updated_at
 * @property-read \Stellar\Models\User                                                  $owner
 * @property-read \Stellar\Models\Star                                                  $location
 * @property-read \Stellar\Models\ShipType                                              $type
 * @property-read \Illuminate\Database\Eloquent\Collection|\Stellar\Models\Items\Item[] $items
 * @property-read int                                                                   $energy_capacity
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereUserId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStarId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereShipTypeId( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereEnergy( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereStructure( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereCredits( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereName( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereCreatedAt( $value )
 * @method static \Illuminate\Database\Query\Builder|\Stellar\Models\Ship whereUpdatedAt( $value )
 */
class Ship extends Model
{

    protected $table = 'ships';

    public $timestamps = true;

    protected $fillable = [ 'name' ];

    protected $hidden = [ 'user_id', 'star_id', 'ship_type_id', 'created_at', 'updated_at' ];


    /**
     * The player that owns the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner()
    {
        return $this->belongsTo('Stellar\Models\User', 'user_id');
    }


    /**
     * The star the ship is currently at.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function location()
    {
        return $this->belongsTo('Stellar\Models\Star', 'star_id');
    }


    /**
     * The type or class of ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('Stellar\Models\ShipType', 'ship_type_id');
    }


    /**
     * The items installed on the ship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function items()
    {
        return $this->belongsToMany('Stellar\Models\Items\Item')->withPivot('amount', 'paid');
    }


    /**
     * Calculate the total energy storage from the available jumpstores.
     *
     * @return int
     */
    public function getEnergyCapacityAttribute()
    {
        $capacity   = 10;
        $jumpStores = $this->items()->whereType('Jumpstore')->get();
        foreach ($jumpStores as $jumpstore) {
            $capacity += 10 * $jumpstore->value;
        }

        return $capacity;
    }


    /**
     * Get a random ship name.
     *
     * @return mixed
     */
    public static function randomName()
    {
        // @todo: replace with a proper generator. Possibly a Faker provider.
        $names = [
            'Adamant',
            'Adventurer of Barka',
            'Adventurer of Landri',
            'Adversary',
            'Agincourt',
            'Alacrity',
            'Alan Bond',
            'Alan Shepard',
            'Alfan Zephyr',
            'Allid Zephyr',
            'Amuel\'s Venture',
            'Amy Jacobs',
            'Anint Nomad',
            'Archimedes',
            'Arer\'s Freedom',
            'Ares Clipper',
            'Ares Courier',
            'Ares Envoy',
            'Ares Express',
            'Ares Nomad',
            'Ares Zephyr',
            'Ariel Carrier',
            'Ariel Courier',
            'Ariel Drifter',
            'Ariel Envoy',
            'Ariel Express',
            'Ariel Heavy',
            'Ariel Swift',
            'Ariel Trekker',
            'Ariel Zephyr',
            'Aristarchus',
            'Arrow of Angel',
            'Arrow of Baxu',
            'Arrow of Kanthua',
            'Arrow of Sartai',
            'Arrow of Thenta',
            'Arscan Trekker',
            'Artuz Wanderer',
            'Ascalon',
            'Astral Alacrity',
            'Astral Endeavour',
            'Astral Enterprise',
            'Astral Explorer',
            'Astral Flame',
            'Astral Horizon',
            'Astral Jewel',
            'Astral Lady',
            'Astral Light',
            'Astral Maiden',
            'Astral Monarch',
            'Astral Orchid',
            'Astral Pathfinder',
            'Astral Pioneer',
            'Astral Princess',
            'Astral Queen',
            'Astral Shuixian',
            'Astral Sovereign',
            'Astral Spirit',
            'Astral Star',
            'Astral Taohua',
            'Astute',
            'Athas\' Escape',
            'Atthes\' Escape',
            'Avip\'s Escape',
            'Bai Ban',
            'Balhua Swift',
            'Balme Gypsy',
            'Bani Carrier',
            'Bani Heavy',
            'Bani Nomad',
            'Bari Express',
            'Baxu Carrier',
            'Beaumonde Voyager',
            'Bellerophon Carrier',
            'Bellerophon Sprinter',
            'Bellerophon Swift',
            'Benni Cruiser',
            'Bernadette Carrier',
            'Bernadette Drifter',
            'Bernadette Envoy',
            'Bernadette Express',
            'Bernadette Nomad',
            'Bernadette Traveler',
            'Bernadette Voyager',
            'Bernadette Wayfarer',
            'Bernadette Zephyr',
            'Bgztlucri Voyager',
            'Blade of Glokyo',
            'Blade of Perth',
            'Bolo',
            'Borga Carrier',
            'Borga Sprinter',
            'Boros Express',
            'Boros Sprinter',
            'Boros Traveler',
            'Boudicca',
            'Braki Swift',
            'Brapa Express',
            'Briga Envoy',
            'Brose Zephyr',
            'Brunhilde',
            'Brusse\'s Venture',
            'Buzz Aldrin',
            'Byotai Wanderer',
            'Cacia Zephyr',
            'Caleb Priest',
            'Campa Voyager',
            'Cardo Zephyr',
            'Carl Sagan',
            'Carlie\'s Venture',
            'Celestial Alacrity',
            'Celestial Destiny',
            'Celestial Empress',
            'Celestial Endeavour',
            'Celestial Enterprise',
            'Celestial Explorer',
            'Celestial Flame',
            'Celestial Horizon',
            'Celestial Lady',
            'Celestial Maiden',
            'Celestial Monarch',
            'Celestial Orchid',
            'Celestial Pathfinder',
            'Celestial Pioneer',
            'Celestial Princess',
            'Celestial Queen',
            'Celestial Spirit',
            'Celestial Star',
            'Celestial Xiuqiu',
            'Celestial Zhuhua',
            'Centro Express',
            'Chanaii Swift',
            'Chani Wanderer',
            'Charles Messier',
            'Chrickenn\'s Escape',
            'Chydri Wanderer',
            'Chykri Express',
            'Cicada',
            'Cizo Envoy',
            'Coly Envoy',
            'Conquest',
            'Cora Clipper',
            'Corporal Rutland',
            'Corsair of Gorno',
            'Corsair of Leeni',
            'Corsair of Minbi',
            'Cotterr\'s Escape',
            'Courageous',
            'Crence\'s Freedom',
            'Darjy Swift',
            'Dauntless',
            'Dave Dixon',
            'Democritus',
            'Destiny of Ariel',
            'Destiny of Bandi',
            'Destiny of Bernadette',
            'Destiny of Boole',
            'Destiny of Cancia',
            'Destiny of Heri',
            'Destiny of Kaza',
            'Destiny of Liann Jiun',
            'Destiny of Niocia',
            'Destiny of Roggi',
            'Destiny of Sisi',
            'Destiny of Vongi',
            'Destiny of Wrani',
            'Devastator',
            'Dominion',
            'Done\'s Venture',
            'Donio\'s Escape',
            'Dori Sprinter',
            'Dragonfly',
            'Eddie Buck',
            'Edwin Hubble',
            'Ehan Nomad',
            'Ejnar Hertzsprung',
            'Elgan Courier',
            'Empress of Fura',
            'Empress of Liann Jiun',
            'Empress of Zentra',
            'Endeavour',
            'Enrymo\'s Venture',
            'Enterprise',
            'Eran Courier',
            'Eratosthenes',
            'Erid Clipper',
            'Errant of Bani',
            'Errant of Churi',
            'Errant of Owax',
            'Errant of Tani',
            'Excalibur',
            'Explorer',
            'Falcon',
            'Fame Zephyr',
            'Fencer',
            'Ferri Wayfarer',
            'Fisher\'s Bluff',
            'Flame of Bernadette',
            'Flame of Difa',
            'Flame of Doru',
            'Flame of Feri',
            'Flame of Krani',
            'Flame of Minbo',
            'Flame of New Melbourne',
            'Flame of Paklou',
            'Flame of Rata',
            'Flame of Santo',
            'Flame of Spara',
            'Flame of Squarkiee',
            'Flame of Trani',
            'Flame of Vile',
            'Fotta Nomad',
            'Frank Drake',
            'Fred Saberhagen',
            'Friedrich Zander',
            'Fura Cruiser',
            'Gabriel\'s Break',
            'Gallantry',
            'Gani Express',
            'Gary\'s Venture',
            'Gema Sprinter',
            'Glani Nomad',
            'Glory',
            'Gole Clipper',
            'Gonii Gypsy',
            'Gotha Envoy',
            'Grona Wanderer',
            'Guardian',
            'Gypsy Moth',
            'Halberd',
            'Hally Trekker',
            'Hammer of Aberdeen',
            'Hammer of Parth',
            'Hammer of Reeni',
            'Hammer of Tari',
            'Hane\'s Freedom',
            'Hani Express',
            'Hardy\'s Venture',
            'Haven',
            'Hawk',
            'Henrietta\'s Vexation',
            'Hera Courier',
            'Hera Nomad',
            'Hera Trekker',
            'Hera Voyager',
            'Hera Wanderer',
            'Hermann Oberth',
            'Highlander of Akon',
            'Highlander of Hundo',
            'Hipparchus',
            'Hizo Courier',
            'Horizon',
            'Hornet',
            'Hummingbird',
            'Hunter',
            'Hurquiz Gypsy',
            'Husni Clipper',
            'Iden Swift',
            'Inban Swift',
            'Indim Express',
            'Intrepid',
            'Invincible',
            'Jackeith\'s Freedom',
            'Jan Hendrik Oort',
            'Jase\'s Escape',
            'Jase\'s Freedom',
            'Jeffry\'s Opportunity',
            'Jeroy\'s Freedom',
            'Jewel of Beaumonde',
            'Jewel of Boros',
            'Jewel of Lazarus',
            'Jewel of Nasi',
            'Jewel of Sheri',
            'Jewel of Tani',
            'Jewel of Taxxu',
            'Jewel of Yrid',
            'Jezza Carrier',
            'Jocelyn Bell',
            'Joe Haldeman',
            'Johannes Kepler',
            'John Glenn',
            'Jone\'s Escape',
            'Jony\'s Escape',
            'Joseph\'s Folly',
            'Joshua\'s Escape',
            'Joshua\'s Freedom',
            'Justeph\'s Venture',
            'Kale Wayfarer',
            'Kani Courier',
            'Kani Swift',
            'Karl Jansky',
            'Karl Schwarzchild',
            'Keri Carrier',
            'Kerry Drifter',
            'Kerry Gypsy',
            'Kerry Swift',
            'Kerry Wayfarer',
            'Kestrel',
            'Kite',
            'Kizo Carrier',
            'Konstantin Tsiolkovsky',
            'Kralfa Nomad',
            'Krille Galivant',
            'Kusanagi',
            'Lady of Anan',
            'Lady of Furi',
            'Lady of Keni',
            'Lady of Sani',
            'Lance of Deani',
            'Lance of Gorda',
            'Lance of Marka',
            'Lance of Triumph',
            'Lancelot',
            'Lani Clipper',
            'Leni Sprinter',
            'Liann Jiun Courier',
            'Liann Jiun Drifter',
            'Liann Jiun Envoy',
            'Liann Jiun Galivant',
            'Liann Jiun Nomad',
            'Liann Jiun Sprinter',
            'Liann Jiun Swift',
            'Liann Jiun Wanderer',
            'Liann Jiun Zephyr',
            'Light of Alhoon',
            'Light of Carra',
            'Light of Forme',
            'Light of Gowan',
            'Light of Hate',
            'Light of Hupa',
            'Light of Liann Jiun',
            'Light of Mani',
            'Light of Newhall',
            'Light of Tarne',
            'Light of Verbena',
            'Loly Swift',
            'Lorraine\'s Providence',
            'Luna Moth',
            'Lynn Potter',
            'Maiden of Foro',
            'Maiden of Golou',
            'Maiden of Liann Jiun',
            'Maiden of Tani',
            'Maiden of Vorcia',
            'Maiden of Zona',
            'Mani Express',
            'Mani Swift',
            'Marauder of Colou',
            'Marauder of Hera',
            'Marauder of Kani',
            'Marauder of Macri',
            'Marauder of Mara',
            'Marauder of Nebe',
            'Marauder of Taxxu',
            'Marauder of Three Hills',
            'Marauder of Venti',
            'Marauder of Xame',
            'Masamune Shirow',
            'Matthua\'s Escape',
            'Mazo Clipper',
            'Meni Clipper',
            'Meni Wanderer',
            'Meta Traveler',
            'Michael Collins',
            'Mickey Crespo',
            'Monarch of New Melbourne',
            'Monarch of Scaani',
            'Monarch of Tily',
            'Mondi Envoy',
            'Morke Zephyr',
            'Muloo Courier',
            'Muly Zephyr',
            'Muuha Carrier',
            'Naldy\'s Venture',
            'Name Courier',
            'Name Express',
            'Nara Express',
            'Narsil',
            'Neil Armstrong',
            'Nemesis',
            'Nesu Voyager',
            'New Melbourne Voyager',
            'New Melbourne Wayfarer',
            'Newhall Clipper',
            'Newhall Galivant',
            'Newhall Swift',
            'Newhall Traveler',
            'Nicolaus Copernicus',
            'Nikyo Swift',
            'Nino Trekker',
            'Nione Envoy',
            'Noptra Zephyr',
            'Nosi Heavy',
            'Noxu Courier',
            'Ogron Carrier',
            'Optran Envoy',
            'Osiris Clipper',
            'Osiris Cruiser',
            'Osiris Express',
            'Osiris Gypsy',
            'Osiris Heavy',
            'Osiris Sprinter',
            'Osiris Traveler',
            'Osiris Trekker',
            'Osiris Voyager',
            'Osiris Wanderer',
            'Osprey',
            'Paane Voyager',
            'Paladin',
            'Palmer\'s Freedom',
            'Paquin Envoy',
            'Paquin Sprinter',
            'Paquin Swift',
            'Parth Courier',
            'Parth Sprinter',
            'Parth Wayfarer',
            'Partisan',
            'Pathfinder',
            'Pathi Courier',
            'Pelorum Heavy',
            'Pelorum Wayfarer',
            'Peregrine',
            'Persephone Carrier',
            'Persephone Express',
            'Persephone Galivant',
            'Persephone Gypsy',
            'Phoenix of Deadwood',
            'Phooly Courier',
            'Pioneer',
            'Princess of Alan',
            'Princess of Gono',
            'Princess of Khero',
            'Princess of Meskli',
            'Princess of Persephone',
            'Ptolemy',
            'Pythagoras',
            'Queen of Parth',
            'Queen of Thogga',
            'Raige\'s Opportunity',
            'Randi Sprinter',
            'Raven',
            'Redoubt',
            'Renegade of Cheedi',
            'Renegade of Deme',
            'Renegade of Ferri',
            'Renegade of Hely',
            'Renegade of Meko',
            'Renegade of Pakli',
            'Renegade of Vani',
            'Renegade of Velly',
            'Resolute',
            'Revenge',
            'Riposte',
            'Robert Goddard',
            'Robert Heinlein',
            'Robert Zubrin',
            'Roida Courier',
            'Roni Voyager',
            'Ronin of Boros',
            'Ronin of Newhall',
            'Ronio\'s Opportunity',
            'Sally Ride',
            'Samurai',
            'San Suo',
            'Sanctuary',
            'Sano Heavy',
            'Sceptre of Athil',
            'Sceptre of Keri',
            'Sceptre of Moni',
            'Sceptre of Oaknaan',
            'Sceptre of Shrelga',
            'Sceptre of Vini',
            'Seburo',
            'Seclusion',
            'Sergeant Bennett',
            'Sergeant Lowell',
            'Sergey Korolyov',
            'Shorti Sprinter',
            'Shorward Swift',
            'Si Suo',
            'Si Xiangjiao',
            'Silverhold Wayfarer',
            'Skani Nomad',
            'Skirmisher',
            'Solar Alacrity',
            'Solar Destiny',
            'Solar Empress',
            'Solar Endeavour',
            'Solar Enterprise',
            'Solar Explorer',
            'Solar Flame',
            'Solar Lady',
            'Solar Maiden',
            'Solar Monarch',
            'Solar Orchid',
            'Solar Pathfinder',
            'Solar Pioneer',
            'Solar Princess',
            'Solar Queen',
            'Solar Sovereign',
            'Solar Spirit',
            'Solar Star',
            'Solitude',
            'Sovereign of Ctani',
            'Sovereign of Ignif',
            'Sovereign of Kaly',
            'Sovereign of Ovoopp',
            'Sovereign of Sisu',
            'Spartan',
            'Spirit of Arren',
            'Spirit of Arrer',
            'Spirit of Chame',
            'Spirit of Fixti',
            'Spirit of Kerry',
            'Spirit of Mani',
            'Spirit of Mule',
            'Spirit of Newhall',
            'Spirit of Osiris',
            'Spirit of Three Hills',
            'Spirit of Uzhan',
            'Squizo Sprinter',
            'Stalwart',
            'Star of Arid',
            'Star of Ariel',
            'Star of Auran',
            'Star of Bera',
            'Star of Bernadette',
            'Star of Drondo',
            'Star of Kantha',
            'Star of Keda',
            'Star of Liann Jiun',
            'Star of Libe',
            'Star of Osiris',
            'Star of Santo',
            'Steadfast',
            'Stellar Alacrity',
            'Stellar Chrysanthemum',
            'Stellar Destiny',
            'Stellar Empress',
            'Stellar Endeavour',
            'Stellar Enterprise',
            'Stellar Explorer',
            'Stellar Flame',
            'Stellar Horizon',
            'Stellar Iris',
            'Stellar Jewel',
            'Stellar Lady',
            'Stellar Lotus',
            'Stellar Maiden',
            'Stellar Monarch',
            'Stellar Pathfinder',
            'Stellar Pioneer',
            'Stellar Princess',
            'Stellar Queen',
            'Stellar Sovereign',
            'Stormbringer',
            'Swallow',
            'Swallowtail',
            'Swift',
            'Tali Express',
            'Tanndo Gypsy',
            'Tari Drifter',
            'Tarka Sprinter',
            'Taxu Clipper',
            'Teni Sprinter',
            'Tess Doerner',
            'Tetri Zephyr',
            'Thomas Henderson',
            'Thrush',
            'Ticia Courier',
            'Tiger of Ariel',
            'Tisi Sprinter',
            'Tleki Wayfarer',
            'Tortoise of Ariel',
            'Tortoise of Liann Jiun',
            'Traakni Sprinter',
            'Tranquility',
            'Traskiee Heavy',
            'Trilli Traveler',
            'Triumph',
            'Triumph of Jiangyin',
            'Triumphant',
            'Tycho Brahe',
            'Ugen Swift',
            'Vada Envoy',
            'Valentin Glushko',
            'Valentina Tereshkova',
            'Vani Wanderer',
            'Vanni Zephyr',
            'Vengeance',
            'Verbena Nomad',
            'Verbena Trekker',
            'Verbena Wayfarer',
            'Verbena Zephyr',
            'Victory',
            'Victory of Ares',
            'Victory of Salisbury',
            'Vidi Swift',
            'Vigilant',
            'Vili Envoy',
            'Viltro Clipper',
            'Vonga Zephyr',
            'Vonge Sprinter',
            'Vorcia Wayfarer',
            'Vorte Envoy',
            'Votha Gypsy',
            'Vothi Cruiser',
            'Wachi Nomad',
            'Wanaii Envoy',
            'Wardy\'s Opportunity',
            'Wasp',
            'Wernher von Braun',
            'William Herschel',
            'Wookyo Courier',
            'Wren',
            'Xama Courier',
            'Yamato',
            'Yangot Express',
            'Yoshiyuki Tomino',
            'Yuri Gagarin',
            'Yuutol Swift',
            'Zalde Courier',
            'Zalde Heavy',
            'Zebulon\'s Freedom',
            'Zeda Swift',
            'Zedi Clipper',
            'Zerza Clipper',
            'Zini Clipper',
            'Zoni Voyager',
            'Zuloo Courier',
        ];

        return $names[array_rand($names)];
    }

}