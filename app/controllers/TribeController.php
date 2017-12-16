<?php

class TribeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//List all tribes
		$tribes = Tribe::orderBy('name', 'ASC')->get();
		//Load the view and pass the tribes
		return View::make('tribe.index')->with('tribes',$tribes);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('tribe.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Validation
		$rules = array('name' => 'required|unique:tribes,name');
		$validator = Validator::make(Input::all(), $rules);
	
		//process
		if($validator->fails()){
			return Redirect::back()->withErrors($validator);
		}else{
			//store
			$tribe = new Tribe;
			$tribe->name = Input::get('name');
			$tribe->save();

			// todo: put option to redirect to page to add antibiotic with zone diameters, save and add antibiotic
			return Redirect::to('tribe')
			->with('message', trans('successfully created a tribe'))->with('activetribe', $tribe->id);
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//show a organism
		$tribe = Tribe::find($id);
		//show the view and pass the $organism to it
		// todo: the loaded page should have add antibiotic
		return View::make('tribe.show')->with('tribe',$tribe);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Get the organism
		$tribe = Tribe::find($id);

		//Open the Edit View and pass to it the $organism
		return View::make('tribe.edit')->with('tribe', $tribe);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Validate
		$rules = array('name' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::back()->withErrors($validator);
		} else {
			// Update
			$tribe = Tribe::find($id);
			$tribe->name = Input::get('name');
			$tribe->save();
            return Redirect::to('tribe')
					->with('message', trans('successfully updated a tribe')) ->with('activetribe', $tribe->id);
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function destroy($id)
	// {
	// 	//
	// }
	/**
	 * Remove the specified resource from storage (soft delete).
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		//Soft delete the tribe
        $tribe = Tribe::find($id);
        $tribe->delete();
        // redirect

        $url = Session::get('SOURCE_URL');
			
		return Redirect::to($url)->with('message', trans('successfuly deleted a tribe'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	// public function destroy($id)
	// {
	// 	//
	// }


}