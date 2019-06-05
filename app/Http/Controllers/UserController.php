<?php
/**
 * Created by PhpStorm.
 * User: kristina
 * Date: 6/1/19
 * Time: 4:52 PM
 */

namespace App\Http\Controllers;


class UserController  extends Controller
{

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {

        return view('auth.profile');
    }
}
