<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateMicrobiologyFunctionalities extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('culture_observations', function(Blueprint $table)
		{
            $table->dropForeign('culture_observations_culture_duration_id_foreign');
			$table->dropColumn('culture_duration_id');
		});

		Schema::table('drug_susceptibility', function(Blueprint $table)
		{
			$table->dropColumn('zone');
		});

		Schema::table('drug_susceptibility', function(Blueprint $table)
		{
            $table->integer('zone_diameter')->unsigned()->nullable()->after('drug_susceptibility_measure_id');
		});

        Schema::create('gram_stain_ranges', function($table)
        {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('gram_stain_results', function($table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('test_id')->unsigned();
            $table->integer('gram_stain_range_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('test_id')->references('id')->on('unhls_tests');
            $table->foreign('gram_stain_range_id')->references('id')->on('gram_stain_ranges');
        });

        Schema::create('gram_break_points', function($table)
        {
            $table->increments('id');
            $table->integer('drug_id')->unsigned();
            $table->integer('gram_stain_range_id')->unsigned();
            $table->decimal('resistant_max', 4, 1)->nullable();
            $table->decimal('intermediate_min', 4, 1)->nullable();
            $table->decimal('intermediate_max', 4, 1)->nullable();
            $table->decimal('sensitive_min', 4, 1)->nullable();

            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->foreign('gram_stain_range_id')->references('id')->on('gram_stain_ranges');
        });

        /* gram drug susceptibility table */
        Schema::create('gram_drug_susceptibility', function(Blueprint $table)
        {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('drug_id')->unsigned();
            $table->integer('gram_stain_result_id')->unsigned();
            $table->integer('drug_susceptibility_measure_id')->unsigned();
            $table->integer('zone_diameter')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->foreign('gram_stain_result_id')->references('id')->on('gram_stain_results');
            $table->foreign('drug_susceptibility_measure_id')->references('id')->on('drug_susceptibility_measures');
        });

        Schema::create('zone_diameters', function($table)
        {
            $table->increments('id');
            $table->integer('drug_id')->unsigned();
            $table->integer('organism_id')->unsigned();
            $table->decimal('resistant_max', 4, 1)->nullable();
            $table->decimal('intermediate_min', 4, 1)->nullable();
            $table->decimal('intermediate_max', 4, 1)->nullable();
            $table->decimal('sensitive_min', 4, 1)->nullable();

            $table->foreign('drug_id')->references('id')->on('drugs');
            $table->foreign('organism_id')->references('id')->on('organisms');
        });

        // seeding on the go! STARTS HERE

        Eloquent::unguard();


        DB::disableQueryLog();
        DB::unprepared(file_get_contents(base_path() . "/app/database/seeds/districts.sql"));
        DB::enableQueryLog();


        /* Facility Ownership table */
        $facilityownershipsData = array(
            array("owner" => "Public"),
            array("owner" => "PFP"),
            array("owner" => "PNFP"),
            array("owner" => "Other"),

        );

        foreach ($facilityownershipsData as $facilityownership)
        {
            $facilityownerships[] = UNHLSFacilityOwnership::create($facilityownership);
        }
        echo "Facility Ownerships seeded\n";


        /* Facility Levels table */
        $facilitylevelsData = array(
            array("level" => "Public NRH"),
            array("level" => "Public RRH"),
            array("level" => "Public GH"),
            array("level" => "Public HCIV"),
            array("level" => "Public HCIII"),
            array("level" => "Hospital"),
        );

        foreach ($facilitylevelsData as $facilitylevel)
        {
            $facilitylevels[] = UNHLSFacilityLevel::create($facilitylevel);
        }
        echo "Facility Levels seeded\n";


        /* Facility table */
        $facilitysData = array(
            array("id" => \Config::get('constants.FACILITY_ID'),
                'name' => \Config::get('constants.FACILITY_NAME'),
                'district_id' => \Config::get('constants.DISTRICT_ID'),
                'code' => \Config::get('constants.FACILITY_CODE'),
                'level_id' => \Config::get('constants.FACILITY_LEVEL_ID'),
                'ownership_id' => \Config::get('constants.FACILITY_OWNERSHIP_ID')
                ),
        );

        foreach ($facilitysData as $facility)
        {
            $facilitys[] = UNHLSFacility::create($facility);
        }
        echo "Facility seeded\n";


        /* Users table */
        $usersData = array(
            array(
                "username" => "administrator", "password" => Hash::make("password"),
                "email" => "", "name" => "A-LIS Admin", "designation" => "Systems Administrator",
                "facility_id" => \Config::get('constants.FACILITY_ID')
            ),
        );

        foreach ($usersData as $user)
        {
            $users[] = User::create($user);
        }
        echo "users seeded\n";



        /* BB Actions table */
        $bbactionsData = array(
            array("actionname" => "Reported to administration for further action"),
            array("actionname" => "Referred to mental department"),
            array("actionname" => "Gave first aid (e.g. arrested bleeding)"),
            array("actionname" => "Referred to clinician for further management"),
            array("actionname" => "Conducted risk assessment"),
            array("actionname" => "Intervened to interrupt/arrest progress of incident (e.g. Used neutralizing agent, stopping a fight)"),
            array("actionname" => "Disposed off broken container to designated waste bin/sharps"),
            array("actionname" => "Patient sample taken & referred to testing lab Isolated suspected patient"),
            array("actionname" => "Reported to or engaged national level BRM for intervention"),
            array("actionname" => "Victim counseled"),
            array("actionname" => "Contacted Police"),
            array("actionname" => "Used spill kit"),
            array("actionname" => "Administered PEP"),
            array("actionname" => "Referred to disciplinary committee"),
            array("actionname" => "Contained the spillage"),
            array("actionname" => "Disinfected the place"),
            array("actionname" => "Switched off the Electricity Mains"),
            array("actionname" => "Washed punctured area"),
            array("actionname" => "Others"),
        );

        foreach ($bbactionsData as $bbaction)
        {
            $bbactions[] = BbincidenceAction::create($bbaction);
        }
        echo "BB Actions seeded\n";


        /* BB Causes table */
        $bbcausesData = array(
            array("causename" => "Defective Equipment"),
            array("causename" => "Hazardous Chemicals"),
            array("causename" => "Unsafe Procedure"),
            array("causename" => "Psychological causes (e.g. emotional condition, depression, mental confusion)"),
            array("causename" => "Unsafe storage of laboratory chemicals"),
            array("causename" => "Lack of Skill or Knowledge"),
            array("causename" => "Lack of Personal Protective Equipment"),
            array("causename" => "Unsafe Working Environment"),
            array("causename" => "Lack of Adequate Physical Security"),
            array("causename" => "Unsafe location of laboratory equipment"),
            array("causename" => "Other"),
        );

        foreach ($bbcausesData as $bbcause)
        {
            $bbcauses[] = BbincidenceCause::create($bbcause);
        }
        echo "BB Causes seeded\n";

        /* BB Natures table */
        $bbnaturesData = array(
            array("name"=>"Assault/Fight among staff","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Fainting","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Roof leakages","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Machine cuts/bruises","class"=>"Mechanical","priority"=>"Minor"),
            array("name"=>"Electric shock/burn","class"=>"Mechanical","priority"=>"Major"),
            array("name"=>"Death within lab","class"=>"Ergonometric and Medical","priority"=>"Major"),
            array("name"=>"Slip or fall","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Unnecessary destruction of lab material","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Theft of laboratory consumables","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Breakage of sample container","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Prick/cut by unused sharps","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Injury caused by laboratory objects","class"=>"Physical","priority"=>"Minor"),
            array("name"=>"Chemical burn","class"=>"Chemical","priority"=>"Minor"),
            array("name"=>"Theft of chemical","class"=>"Chemical","priority"=>"Minor"),
            array("name"=>"Chemical spillage","class"=>"Chemical","priority"=>"Major"),
            array("name"=>"Theft of equipment","class"=>"Physical","priority"=>"Major"),
            array("name"=>"Attack on the Lab","class"=>"Physical","priority"=>"Major"),
            array("name"=>"Collapsing building","class"=>"Physical","priority"=>"Major"),
            array("name"=>"Bike rider accident","class"=>"Physical","priority"=>"Major"),
            array("name"=>"Fire","class"=>"Physical","priority"=>"Major"),
            array("name"=>"Needle prick or cuts by used sharps","class"=>"Biological","priority"=>"Minor"),
            array("name"=>"Sample spillage","class"=>"Biological","priority"=>"Minor"),
            array("name"=>"Theft of samples","class"=>"Biological","priority"=>"Major"),
            array("name"=>"Contact with VHF suspect","class"=>"Biological","priority"=>"Major"),
            array("name"=>"Contact with radiological materials","class"=>"Radiological","priority"=>"Major"),
            array("name"=>"Theft of radiological materials","class"=>"Radiological","priority"=>"Major"),
            array("name"=>"Poor disposal of radiological materials","class"=>"Radiological","priority"=>"Major"),
            array("name"=>"Poor vision from inadequate light","class"=>"Ergonometric and Medical","priority"=>"Minor"),
            array("name"=>"Back pain from posture effects","class"=>"Ergonometric and Medical","priority"=>"Minor"),
            array("name"=>"Other occupational hazard","class"=>"Ergonometric and Medical","priority"=>"Minor"),
            array("name"=>"Other","class"=>"Other","priority"=>"Other"),
        );

        foreach ($bbnaturesData as $bbnature)
        {
            $bbnatures[] = BbincidenceNature::create($bbnature);
        }
        echo "BB Natures seeded\n";


        /* Test Phase table */
        $test_phases = array(
          array("id" => "1", "name" => "Pre-Analytical"),
          array("id" => "2", "name" => "Analytical"),
          array("id" => "3", "name" => "Post-Analytical")
        );
        foreach ($test_phases as $test_phase)
        {
            TestPhase::create($test_phase);
        }
        echo "test_phases seeded\n";

        /* Test Status table */
        $test_statuses = array(
          array("id" => "1","name" => "not-received","test_phase_id" => "1"),//Pre-Analytical
          array("id" => "2","name" => "pending","test_phase_id" => "1"),//Pre-Analytical
          array("id" => "3","name" => "started","test_phase_id" => "2"),//Analytical
          array("id" => "4","name" => "completed","test_phase_id" => "3"),//Post-Analytical
          array("id" => "5","name" => "verified","test_phase_id" => "3"),//Post-Analytical
          array("id" => "6","name" => "specimen-rejected-at-analysis","test_phase_id" => "3")//Analytical
        );
        foreach ($test_statuses as $test_status)
        {
            TestStatus::create($test_status);
        }
        echo "test_statuses seeded\n";

        /* Specimen Status table */
        $specimen_statuses = array(
          array("id" => "1", "name" => "specimen-not-collected"),//Pre-Analytical
          array("id" => "2", "name" => "specimen-accepted"),//Pre-Analytical
          array("id" => "3", "name" => "specimen-rejected")//Pre-Analytical
        );
        foreach ($specimen_statuses as $specimen_status)
        {
            SpecimenStatus::create($specimen_status);
        }
        echo "specimen_statuses seeded\n";

        /* Rejection Reasons table */
        $rejection_reasons_array = array(
          array("reason" => "Inadequate sample volume"),
          array("reason" => "Haemolysed sample"),
          array("reason" => "Specimen without lab request form"),
          array("reason" => "No test ordered on  lab request form of sample"),
          array("reason" => "No sample label or identifier"),
          array("reason" => "Wrong sample label"),
          array("reason" => "Unclear sample label"),
          array("reason" => "Sample in wrong container"),
          array("reason" => "Damaged/broken/leaking sample container"),
          array("reason" => "Too old sample"),
          array("reason" => "Date of sample collection not specified"),
          array("reason" => "Time of sample collection not specified"),
          array("reason" => "Improper transport media"),
          array("reason" => "Sample type unacceptable for required test"),
          array("reason" => "Other"),

        );
        foreach ($rejection_reasons_array as $rejection_reason)
        {
            $rejection_reasons[] = RejectionReason::create($rejection_reason);
        }
        echo "rejection_reasons seeded\n";

        /* Permissions table */
        $permissions = array(

          array("name" => "manage_incidents", "display_name" => "Can Manage Biorisk & Biosecurity Incidents"),

            array("name" => "view_names", "display_name" => "Can view patient names"),
            array("name" => "manage_patients", "display_name" => "Can add patients"),

            array("name" => "receive_external_test", "display_name" => "Can receive test requests"),
            array("name" => "request_test", "display_name" => "Can request new test"),
            array("name" => "accept_test_specimen", "display_name" => "Can accept test specimen"),
            array("name" => "reject_test_specimen", "display_name" => "Can reject test specimen"),
            array("name" => "change_test_specimen", "display_name" => "Can change test specimen"),
            array("name" => "start_test", "display_name" => "Can start tests"),
            array("name" => "enter_test_results", "display_name" => "Can enter tests results"),
            array("name" => "edit_test_results", "display_name" => "Can edit test results"),
            array("name" => "verify_test_results", "display_name" => "Can verify test results"),
            array("name" => "send_results_to_external_system", "display_name" => "Can send test results to external systems"),
            array("name" => "refer_specimens", "display_name" => "Can refer specimens"),

            array("name" => "manage_users", "display_name" => "Can manage users"),
            array("name" => "manage_test_catalog", "display_name" => "Can manage test catalog"),
            array("name" => "manage_lab_configurations", "display_name" => "Can manage lab configurations"),
            array("name" => "view_reports", "display_name" => "Can view reports"),
            array("name" => "manage_inventory", "display_name" => "Can manage inventory"),
            array("name" => "request_topup", "display_name" => "Can request top-up"),
            array("name" => "manage_qc", "display_name" => "Can manage Quality Control")
        );

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
        echo "Permissions table seeded\n";

        /* Roles table */
        $roles = array(
            array("name" => "Superadmin"),
            array("name" => "Technologist"),
            array("name" => "Receptionist")
        );
        foreach ($roles as $role) {
            Role::create($role);
        }
        echo "Roles table seeded\n";

        $user1 = User::find(1);
        $role1 = Role::find(1);
        $permissions = Permission::all();

        //Assign all permissions to role administrator
        foreach ($permissions as $permission) {
            $role1->attachPermission($permission);
        }
        //Assign role Administrator to user 1 administrator
        $user1->attachRole($role1);

        $barcode = array("encoding_format" => 'code39', "barcode_width" => '2', "barcode_height" => '30', "text_size" => '11');
        Barcode::create($barcode);
        echo "Barcode table seeded\n";

        $specimenTypeBlood = SpecimenType::create(["name" => "Blood"]);
        echo "specimen_types seeded\n";

        /* Test Categories table - These map on to the lab sections */
        $testTypeCategoryHematology = TestCategory::create(array("name" => "HEMATOLOGY","description" => ""));
        echo "Lab Sections seeded\n";


        /* Measure Types */
        $measureTypes = array(
            array("id" => "1", "name" => "Numeric Range"),
            array("id" => "2", "name" => "Alphanumeric Values"),
            array("id" => "3", "name" => "Autocomplete"),
            array("id" => "4", "name" => "Free Text")
        );

        foreach ($measureTypes as $measureType)
        {
            MeasureType::create($measureType);
        }
        echo "measure_types seeded\n";

        echo "testtype_specimentypes seeded\n";

        /* Instruments table */
        $instrumentsData = array(
            "name" => "Celltac F Mek 8222",
            "description" => "Automatic analyzer with 22 parameters and WBC 5 part diff Hematology Analyzer",
            "driver_name" => "KBLIS\\Plugins\\CelltacFMachine",
            "ip" => "192.168.1.12",
            "hostname" => "HEMASERVER"
        );

        $instrument = Instrument::create($instrumentsData);

        echo "Instruments table seeded\n";

        /* Test Types for prevalence */
        $test_types_sickling = TestType::create(array("name" => "Sickling Test", "test_category_id" => $testTypeCategoryHematology->id));
        
        echo "Test Types seeded\n";

        /* Test Types and specimen types relationship for prevalence */
       
         DB::insert('INSERT INTO testtype_specimentypes (test_type_id, specimen_type_id) VALUES (?, ?)',
            array($test_types_sickling->id, $specimenTypeBlood->id));
        

        /*New measures for prevalence*/
        $measure_sickling = Measure::create(array("measure_type_id" => "2", "name" => "Sickling Test", "unit" => ""));

        // MeasureRange::create(array("measure_id" => $measure_sickling->id, "alphanumeric" => "AA"));
        // MeasureRange::create(array("measure_id" => $measure_sickling->id, "alphanumeric" => "AS"));
        // MeasureRange::create(array("measure_id" => $measure_sickling->id, "alphanumeric" => "Missing"));
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
