<?php namespace Stellar\Http\Controllers\Admin;

use DB;
use Response;
use Stellar\Star;

class StarController extends AdminController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $star_count      = Star::all()->count();
        $star_link_count = DB::table('star_links')->count('destination') / 2;

        return view('star.index', compact('star_count', 'star_link_count'));
    }


    /**
     * Generate a star name.
     *
     * @return string
     */
    protected function generateName()
    {
        static $vowels = 'aeiuy';
        static $consonants = 'bcdfghkmnprstvwxz';

        do {
            if (mt_rand(0, 1)) {
                $name = $consonants[mt_rand(0, 16)] . $vowels[mt_rand(0, 4)] . $consonants[mt_rand(0,
                        16)] . '-' . str_pad(mt_rand(0, 999), 3, '7', STR_PAD_LEFT);
            } else {
                $name = $vowels[mt_rand(0, 4)] . $consonants[mt_rand(0, 16)] . $vowels[mt_rand(0,
                        4)] . '-' . str_pad(mt_rand(0, 999), 3, '2', STR_PAD_LEFT);
            }
        } while (Star::where('name', $name)->exists());

        return $name;
    }


    /**
     * Generate a new galaxy.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function generate()
    {
        // Start with a clean slate.
        DB::table('stars')->delete();
        DB::table('star_links')->delete();

        // Create new stars.
        $star_count      = 200;
        $unvisited_stars = [ ];
        $visited_stars   = [ ];
        $all_stars       = [ ];
        for ($i = 0; $i < $star_count; $i++) {
            $star       = new Star();
            $star->name = $this->generateName();
            $star->save();
            $unvisited_stars[$star->getKey()] = true;
            $all_stars[$star->getKey()]       = $star;
        }

        // Create links between stars.
        $total_links             = 0;
        $star_id                 = array_rand($all_stars);
        $visited_stars[$star_id] = $all_stars[$star_id];
        unset( $unvisited_stars[$star_id] );

        // Random walk to generate a uniform spanning tree.
        while ( ! empty( $unvisited_stars )) {
            $star          = $visited_stars[$star_id];
            $other_star_id = array_rand($all_stars);
            $other_star    = $all_stars[$other_star_id];
            if ( ! isset( $visited_stars[$other_star_id] )) {
                $star->exits()->attach($other_star);
                $other_star->exits()->attach($star);

                $visited_stars[$other_star_id] = $all_stars[$other_star_id];
                unset( $unvisited_stars[$other_star_id] );
                $total_links++;
            }
            $star_id = $other_star_id;
        }

        // Add some extra links to create cycles.
        for ($i = 0; $i < $total_links / 10; $i++) {
            $star       = $all_stars[array_rand($all_stars)];
            $other_star = $all_stars[array_rand($all_stars)];
            if ($star != $other_star) {
                $star->exits()->attach($other_star);
                $other_star->exits()->attach($star);
                $total_links++;
            }
        }

        return redirect()->back()->with('status',
            'Generated ' . $star_count . ' stars and ' . $total_links . ' star links.');
    }

}
