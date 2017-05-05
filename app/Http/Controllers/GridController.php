<?php

namespace App\Http\Controllers;
use App\Repositories\TireRepository;
use \App\Services\Ajax;

use Illuminate\Http\Request;

class GridController extends Controller
{

    private $trep;

    /**
     * GridController constructor.
     * @param $trep
     */
    public function __construct(TireRepository $trep)
    {
        $this->trep = $trep;
    }

    public function index()
    {
        $grid_data = $this->trep->getTires();
        return view('grid',compact('grid_data'));
    }

    public function search(Request $req)
    {
        $grid_data = $this->trep->getTires($req['searchinput'], $req['searchtype']);
        $ajax = \Ajax::instance();
        $ajax->redrawView('tbody');
        return $ajax->view('partials.tbody',compact('grid_data'));
    }

}
