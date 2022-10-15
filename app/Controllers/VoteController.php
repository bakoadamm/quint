<?php


namespace Quint\App\Controllers;


use Quint\App\Models\Vote;
use Quint\IDatabase;

class VoteController extends Controller {

    /**
     * AuthController constructor.
     * @param IDatabase $dbh
     */
    public function __construct(IDatabase $dbh, $loader, $twig) {
        parent::__construct($dbh, $loader, $twig);
    }

    public function votes() {
        $votes = Vote::orderBy('datum', 'desc')->get()->toArray();
        $this->view('vote/list', ['votes' => $votes]);
    }

    public function create() {
        $this->view('vote/edit-add');
    }
}
