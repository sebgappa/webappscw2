<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Dogs;

class AccountController extends Controller {

    public function view(Dogs $dogsAPI) 
    {
        $dogImageURL = $dogsAPI->getImage();

        return view('account', ['dogImageURL' => $dogImageURL]);
    }
}
