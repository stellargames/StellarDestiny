<?php namespace Stellar\Http\Controllers\Admin;

use DB;
use Illuminate\Routing\Controller;
use Response;
use Stellar\Models\Star;

class StarController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $starCount     = Star::all()->count();
        $starLinkCount = DB::table('star_links')->count('destination') / 2;

        return view('admin.star.index', compact('starCount', 'starLinkCount'));
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
                $name = $consonants[mt_rand(0, 16)] . $vowels[mt_rand(0, 4)] . $consonants[mt_rand(
                        0, 16
                    )] . '-' . str_pad(mt_rand(0, 999), 3, '7', STR_PAD_LEFT);
            } else {
                $name = $vowels[mt_rand(0, 4)] . $consonants[mt_rand(0, 16)] . $vowels[mt_rand(
                        0, 4
                    )] . '-' . str_pad(mt_rand(0, 999), 3, '2', STR_PAD_LEFT);
            }
        } while (Star::whereName($name)->exists());

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
        $starCount = 200;
        /**
         * @var Star[] $unvisitedStars
         * @var Star[] $visitedStars
         * @var Star[] $allStars
         */
        $unvisitedStars = [ ];
        $visitedStars   = [ ];
        $allStars       = [ ];
        for ($i = 0; $i < $starCount; $i++) {
            $star = new Star([ 'name' => $this->generateName() ]);
            $star->save();
            $unvisitedStars[$star->getKey()] = true;
            $allStars[$star->getKey()]       = $star;
        }

        // Create links between stars.
        $totalLinks            = 0;
        $starId                = array_rand($allStars);
        $visitedStars[$starId] = $allStars[$starId];
        unset($unvisitedStars[$starId]);

        // Random walk to generate a uniform spanning tree.
        while ( ! empty($unvisitedStars)) {
            $star        = $visitedStars[$starId];
            $otherStarId = array_rand($allStars);
            $otherStar   = $allStars[$otherStarId];
            if ( ! isset($visitedStars[$otherStarId])) {
                $star->exits()->attach($otherStar);
                $otherStar->exits()->attach($star);

                $visitedStars[$otherStarId] = $allStars[$otherStarId];
                unset($unvisitedStars[$otherStarId]);
                $totalLinks++;
            }
            $starId = $otherStarId;
        }

        // Add some extra links to create cycles.
        for ($i = 0; $i < $totalLinks / 10; $i++) {
            $star      = $allStars[array_rand($allStars)];
            $otherStar = $allStars[array_rand($allStars)];
            if ($star != $otherStar) {
                $star->exits()->attach($otherStar);
                $otherStar->exits()->attach($star);
                $totalLinks++;
            }
        }

        return redirect()->back()->with(
            'status', 'Generated ' . $starCount . ' stars and ' . $totalLinks . ' star links.'
        );
    }

}
