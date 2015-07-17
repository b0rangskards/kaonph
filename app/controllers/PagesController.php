<?php

class PagesController extends \BaseController {

    public function index()
    {
        return View::make('public.index');
    }

	public function home()
    {
        return View::make('members.index');
    }

}