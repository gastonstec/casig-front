<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Controller for managing end-user information.
 */
class EndUserController extends Controller
{
    /**
     * Retrieves user information based on the parameters provided in the URL.
     * 
     * This method simulates fetching user data by providing default values 
     * if parameters are not sent in the request.
     *
     * @param Request $request Object containing request parameters.
     * @return \Illuminate\Http\JsonResponse JSON response with user data.
     */
    public function getUserById(Request $request)
    {
        // Retrieve values from the URL, or set default placeholders if not provided
        $userId = $request->query('UserId', 'User ID goes here');
        $name = $request->query('Name', 'User name goes here');
        $email = $request->query('Email', 'User email goes here');

        // Dummy JSON response
        return response()->json([
            "UserId" => $userId,
            "Name" => $name,
            "Email" => $email,
            "Location" => "Location goes here",
            "CallCenter" => "Call center goes here",
            "Position" => "Position goes here",
            "Supervisor" => "Supervisor goes here"
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }
}
