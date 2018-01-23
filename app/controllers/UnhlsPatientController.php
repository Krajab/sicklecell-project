<?php

use Illuminate\Database\QueryException;

/**
 *Contains functions for managing patient records
 *
 */
class UnhlsPatientController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
		{
		$search = Input::get('search');

		$patients = UnhlsPatient::search($search)->orderBy('id', 'desc')->paginate(Config::get('kblis.page-items'))->appends(Input::except('_token'));

		if (count($patients) == 0) {
		 	Session::flash('message', trans('messages.no-match'));
		}
		$clinicianUI = AdhocConfig::where('name','Clinician_UI')->first()->activateClinicianUI();


		// Load the view and pass the patients
		return View::make('unhls_patient.index')
				->with('patients', $patients)
				->with('clinicianUI', $clinicianUI)
				->withInput(Input::all());
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//Create Patient
		$tribes = ['']+Tribe::orderBy('name','ASC')->lists('name', 'id');
		
		$ranges = Measure::find(2)->measureRanges;

		$measureRanges = [];
		$measureRanges[0] = 'Select Result';
        foreach ($ranges as $range) {
            $measureRanges[$range->alphanumeric] = $range->alphanumeric;
        }

		$districts_data = ['']+District::orderBy('name','ASC')->lists('name', 'id');
		return View::make('unhls_patient.create')
					->with('tribe', $tribes)
					->with('measureRanges',$measureRanges)
					->with('districts',$districts_data);

	}

		/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$rules = array(
			'name'       => 'required',
			'gender' => 'required',
			'dob' => 'required' ,
		);
		$validator = Validator::make(Input::all(), $rules);

		if ($validator->fails()) {

			return Redirect::back()->withErrors($validator)->withInput(Input::all());
		} else {
			$patient = new UnhlsPatient;
			$patient->patient_number = Input::get('patient_number');
			$patient->field_id = Input::get('field_id');
			$patient->name = Input::get('name');
			$patient->gender = Input::get('gender');
			$patient->dob = Input::get('dob');
			$patient->tribe_id = Input::get('tribe');
			$patient->district_id = Input::get('district');
			$patient->phone_number = Input::get('phone_number');
			$patient->results = Input::get('results');
			$patient->created_by = Auth::user()->id;
			$patient->save();

			$patient->ulin = $patient->getUlin();
			$patient->save();
			$uuid = new UuidGenerator; 
			$uuid->save();

			$visit = new UnhlsVisit;
			$visit->patient_id = $patient->id;
			$visit->visit_type = 'Out-patient';
			$visit->save();

            $specimen = new UnhlsSpecimen;
            $specimen->specimen_type_id = 1;
            $specimen->accepted_by = Auth::user()->id;
            $specimen->time_collected = date('Y-m-d H:i:s');
            $specimen->time_accepted = date('Y-m-d H:i:s');
            $specimen->save();

            $test = new UnhlsTest;
            $test->visit_id = $visit->id;
            $test->test_type_id = 1;
            $test->specimen_id = $specimen->id;
            $test->test_status_id = UnhlsTest::VERIFIED;
            $test->created_by = Auth::user()->id;
            $test->requested_by = Auth::user()->id;
			$test->time_completed = date('Y-m-d H:i:s');
			$test->tested_by = Auth::user()->id;
			$test->verified_by = Auth::user()->id;
            $test->save();

			foreach ($test->testType->measures as $measure) {
				$testResult = UnhlsTestResult::firstOrCreate(array('test_id' => $test->id, 'measure_id' => $measure->id));
				$testResult->result = Input::get('result');
				$testResult->save();
			}

			$url = Session::get('SOURCE_URL');
			return Redirect::to($url)
			->with('message', 'Record Successfully Saved with ULIN:  '.$patient->ulin.'!');
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
		//Show a patient
		$patient = UnhlsPatient::find($id);

		//Show the view and pass the $patient to it
		return View::make('unhls_patient.show')->with('patient', $patient);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//Get the patient
		$districts = ['']+District::orderBy('name','ASC')->lists('name', 'id');
		$tribe = ['']+Tribe::orderBy('name','ASC')->lists('name', 'id');
		$measureRanges = [];
		$patient = UnhlsPatient::find($id);

		//Open the Edit View and pass to it the $patient
		return View::make('unhls_patient.edit')->with('patient', $patient)
												->with('tribe', $tribe)
												->with('districts', $districts)
												->with('measureRanges',$measureRanges);
	
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
		$rules = array(
			'name'       => 'required',
			'gender' => 'required',
			'dob' => 'required'
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		if ($validator->fails()) {
			return Redirect::to('unhls_patient/' . $id . '/edit')
				->withErrors($validator)
				->withInput(Input::except('password'));
		} else {
			// Update
			$patient = UnhlsPatient::find($id);
			$patient->patient_number = Input::get('patient_number');
			$patient->field_id = Input::get('field_id');
			$patient->name = Input::get('name');
			$patient->gender = Input::get('gender');
			$patient->dob = Input::get('dob');
			$patient->tribe_id = Input::get('tribe_id');
			$patient->district_id = Input::get('district_id');
			$patient->phone_number = Input::get('phone_number');
			$patient->results = Input::get('results');
			$patient->created_by = Auth::user()->id;
			$patient->save();

			// redirect
			// $url = Session::get('unhls_patient.index');
			return Redirect::to('unhls_patient')
			->with('message', 'The patient details were successfully updated!') ->with('activepatient',$patient ->id);

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage (soft delete).
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		// if no visit made, soft delete
		$patient = UnhlsPatient::find($id);

		$patientInUse = UnhlsVisit::where('patient_id', '=', $id)->first();
		if (empty($patientInUse)) {
			// The has no visit
			$patient->delete();
		} else {
			// The has visit
			return Redirect::route('unhls_patient.index')
				->with('message', 'This Patient has visits, not Deleted!');
		}
		// redirect
		return Redirect::route('unhls_patient.index')
			->with('message', 'Patient Successfully Deleted!');
	}

	/**
	 * Return a Patients collection that meets the searched criteria as JSON.
	 *
	 * @return Response
	 */
	public function search()
	{
        return UnhlsPatient::search(Input::get('text'))->take(Config::get('kblis.limit-items'))->get()->toJson();
	}
	public function saveSicklecellTest()
	{
		//Create New Test
		$rules = array(
			'visit_type' => 'required',
			'testtypes' => 'required',
		);
		$validator = Validator::make(Input::all(), $rules);

		// process the login
		// if ($validator->fails()) {
		// 	return Redirect::route('unhls_test.create', 
		// 		array(Input::get('patient_id')))->withInput()->withErrors($validator);
		// } else {

		// 	$visitType = ['Out-patient','In-patient'];
		// 	$activeTest = array();

			/*
			 * - Create a visit
			 * - Fields required: visit_type, patient_id
			 */
			$visit = new UnhlsVisit;
			$visit->patient_id = Input::get('patient_id');
			// $visit->visit_type = $visitType[Input::get('visit_type')];
			$visit->save();

			$therapy = new Therapy;
			$therapy->patient_id = Input::get('patient_id');
			$therapy->visit_id = $visit->id;
			// $therapy->previous_therapy = Input::get('previous_therapy');
			// $therapy->current_therapy = Input::get('current_therapy');
			$therapy->save();

			/*
			 * - Create tests requested
			 * - Fields required: visit_id, test_type_id, specimen_id, test_status_id, created_by, requested_by
			 */
            $testLists = Input::get('test_list');
            if(is_array($testLists)){
                foreach ($testLists as $testList) {
                    // Create Specimen - specimen_type_id, accepted_by, referred_from, referred_to
                    $specimen = new UnhlsSpecimen;
                    $specimen->specimen_type_id = $testList['specimen_type_id'];
                    $specimen->accepted_by = Auth::user()->id;
                    $specimen->time_collected = Input::get('collection_date');
                    $specimen->time_accepted = Input::get('reception_date');
                    $specimen->save();
                    foreach ($testList['test_type_id'] as $id) {
                        $testTypeID = (int)$id;

                        $test = new UnhlsTest;
                        $test->visit_id = $visit->id;
                        $test->test_type_id = $testTypeID;
                        $test->specimen_id = $specimen->id;
                        $test->test_status_id = UnhlsTest::PENDING;
                        $test->created_by = Auth::user()->id;
                        $test->requested_by = Input::get('physician');
                        $test->purpose = Input::get('hiv_purpose');
                        $test->save();

                        $activeTest[] = $test->id;
                    }
                }
            }

			$url = Session::get('SOURCE_URL');
			
			return Redirect::to($url)->with('message', 'messages.success-creating-test')
					->with('activeTest', $activeTest);
		}
	}


	/**
	 * Display Collect page 
	 *
	 * @param
	 * @return
	 */
	// public function saveNewTest()
	// {
	// 	//Create New Test
	// 	$rules = array(
	// 		'visit_type' => 'required',
	// 		'testtypes' => 'required',
	// 	);
	// 	$validator = Validator::make(Input::all(), $rules);

	// 	// process the login
	// 	if ($validator->fails()) {
	// 		return Redirect::route('unhls_patient.create', 
	// 			array(Input::get('patient_id')))->withInput()->withErrors($validator);
	// 	} else {

	// 		$visitType = ['Out-patient','In-patient'];
	// 		$activeTest = array();

	// 		/*
	// 		 * - Create a visit
	// 		 * - Fields required: visit_type, patient_id
	// 		 */
	// 		$visit = new UnhlsVisit;
	// 		$visit->patient_id = Input::get('patient_id');
	// 		$visit->visit_type = $visitType[Input::get('visit_type')];
	// 		$visit->ward_id = Input::get('ward_id');
	// 		$visit->bed_no = Input::get('bed_no');
	// 		$visit->save();

	// 		$therapy = new Therapy;
	// 		$therapy->patient_id = Input::get('patient_id');
	// 		$therapy->visit_id = $visit->id;
	// 		$therapy->previous_therapy = Input::get('previous_therapy');
	// 		$therapy->current_therapy = Input::get('current_therapy');
	// 		$therapy->save();

	// 		/*
	// 		 * - Create tests requested
	// 		 * - Fields required: visit_id, test_type_id, specimen_id, test_status_id, created_by, requested_by
	// 		 */
 //            $testLists = Input::get('test_list');
 //            if(is_array($testLists)){
 //                foreach ($testLists as $testList) {
 //                    // Create Specimen - specimen_type_id, accepted_by, referred_from, referred_to
 //                    $specimen = new UnhlsSpecimen;
 //                    $specimen->specimen_type_id = $testList['specimen_type_id'];
 //                    $specimen->accepted_by = Auth::user()->id;
 //                    $specimen->time_collected = Input::get('collection_date');
 //                    $specimen->time_accepted = Input::get('reception_date');
 //                    $specimen->save();
 //                    foreach ($testList['test_type_id'] as $id) {
 //                        $testTypeID = (int)$id;

 //                        $test = new UnhlsTest;
 //                        $test->visit_id = $visit->id;
 //                        $test->test_type_id = $testTypeID;
 //                        $test->specimen_id = $specimen->id;
 //                        $test->test_status_id = UnhlsTest::PENDING;
 //                        $test->created_by = Auth::user()->id;
 //                        $test->requested_by = Input::get('physician');
 //                        $test->purpose = Input::get('hiv_purpose');
 //                        $test->save();

 //                        $activeTest[] = $test->id;
 //                    }
 //                }
 //            }

	// 		$url = Session::get('SOURCE_URL');
			
	// 		return Redirect::to($url)->with('message', 'messages.success-creating-test')
	// 				->with('activeTest', $activeTest);
	// 	}
	// }

// }


