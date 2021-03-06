<?php

class MeasureNameMappingController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($test_name_mapping_id)
	{
		$testNameMapping = TestNameMapping::find($test_name_mapping_id);
		$measures = ($testNameMapping->test_type_id != '') ? $testNameMapping->testType->measures->lists('name', 'id') : [] ;
		return View::make('testnamemapping.measurenamemapping.create')
				->with('measures', $measures)
				->with('testNameMapping', $testNameMapping);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//Validation
		$rules = array('system_name' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('measurenamemapping.index')->withErrors($validator)->withInput();
		} else {
			// Add
			$measureNameMapping = new MeasureNameMapping;
			$measureNameMapping->test_name_mapping_id = Input::get('test_name_mapping_id');
			$measureNameMapping->measure_id = Input::get('measure_id');
			$measureNameMapping->standard_name = Input::get('standard_name');
			$measureNameMapping->system_name = Input::get('system_name');
			// redirect
			try{
				$measureNameMapping->save();
				return Redirect::route('testnamemapping.show', [Input::get('test_name_mapping_id')])
					->with('message', 'Successfully Created Measure Name Mapping');
			} catch(QueryException $e){
				Log::error($e);
			}
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
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$measureNameMapping = MeasureNameMapping::find($id);
		$measures = ($measureNameMapping->testNameMapping->test_type_id != '') ? $measureNameMapping->testNameMapping->testType->measures->lists('name', 'id') : [] ;

		return View::make('testnamemapping.measurenamemapping.edit')
				->with('measureNameMapping', $measureNameMapping)
				->with('measures', $measures);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//Validate and check
		$rules = array('system_name' => 'required');
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {
			return Redirect::route('measurenamemapping.index')->withErrors($validator)->withInput();
		} else {
			// Update
			$measureNameMapping = MeasureNameMapping::find($id);
			$measureNameMapping->measure_id = Input::get('measure_id');
			$measureNameMapping->standard_name = Input::get('standard_name');
			$measureNameMapping->system_name = Input::get('system_name');
			$measureNameMapping->save();
			// redirect
				return Redirect::route('testnamemapping.show', [$measureNameMapping->test_name_mapping_id])
				->with('message', 'Successfully Updated Measure Name Mapping');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		//Deleting the Item
		$testNameMapping = MeasureNameMapping::find($id);

		//Soft delete
		$testNameMapping->delete();

		// redirect
		return Redirect::route('testnamemapping.show', [Input::get('test_name_mapping_id')])
			->with('message', 'Successfully Deleted Measure Name Mapping');
	}


}
