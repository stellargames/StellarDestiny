<?php namespace Stellar\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Stellar\Repositories\Contracts\StarRepositoryInterface;

class StarController extends Controller
{

    /**
     * @var StarRepositoryInterface
     */
    private $galaxy;


    /**
     * StarController constructor.
     *
     * @param StarRepositoryInterface $galaxy
     */
    public function __construct(StarRepositoryInterface $galaxy) {
        $this->galaxy = $galaxy;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $starCount = $this->galaxy->getSize();

        return view('admin.star.index', compact('starCount'));
    }    
    
    /**
     * Display the galaxy create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getGenerate() {
        return view('admin.star.generate');
    }


    /**
     * Generate a new galaxy.
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postGenerate(Request $request) {
        $size = $request->input('amount');
        $this->galaxy->createNew($size);

        return redirect(action('Admin\StarController@index'))->with(
            'status', 'Generated ' . $size . ' stars.'
        );
    }

}
