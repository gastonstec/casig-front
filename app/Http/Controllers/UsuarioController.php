<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EndUser;

/**
 * Controller for managing end users.
 */
class EndUserController extends Controller
{
    /**
     * Retrieves user information based on their ID.
     *
     * This method searches for a user in the database and returns their data in JSON format.
     * 
     * @param int $id The ID of the user to retrieve.
     * @return \Illuminate\Http\JsonResponse JSON response with user information,
     *                                      or `null` if the user does not exist.
     */
    public function getUser($id) 
    {
        $user = EndUser::find($id);

        return response()->json($user);
    }
}
