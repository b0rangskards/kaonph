<?php  namespace Acme\Helpers; 

use Symfony\Component\HttpFoundation\Response as ResponseErrors;
use Illuminate\Support\Facades\Response;

class ResponseHelper {

    public static function message($message)
    {
        return Response::json($message);
    }

    public static function successMessage($message)
    {
        return Response::json(['message' => $message]);
    }

    public static function errorMessage($errors)
    {
        return Response::json($errors, ResponseErrors::HTTP_BAD_REQUEST);
    }
} 