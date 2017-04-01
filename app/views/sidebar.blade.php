@section("sidebar")
<?php
	$active = array("","","","","","", "", "", "");
	$key = explode("?",str_replace("/", "?", Request::path()));
	switch ($key[0]) {
		case 'home': $active[0] = "active"; break;
		case 'patient': $active[0] = "active"; break;
		case 'patient_unhls': $active[1] = "active"; break;
		case 'test': $active[2] = "active"; break;
		case 'labconfig': 
		case 'instrument':
		case 'reportconfig':
		case 'barcode':
		case 'blisclient':
		case 'facility': 
			$active[3] = "active"; break;
		case 'testcategory': 
		case 'testtype': 
		case 'measure': 
		case 'specimentype': 
		case 'specimenrejection': 
		case 'drug':
		case 'organism':
			$active[4] = "active"; break;
		case 'patientreport': 
		case 'dailylog': 
		case 'prevalence':
		case 'surveillance':
		case 'counts':
		case 'tat':
		case 'infection':
		case 'userstatistics':
		case 'moh706':
		case 'hmis105':
		case 'cd4':
		case 'qualitycontrol':
		case 'inventory':
			$active[5] = "active"; break;
		case 'permission': 
		case 'assign':
		case 'user': 
		case 'role': 
			$active[6] = "active"; break;
		case 'issue': 
		case 'receipt': 
		case 'topup': 
		case 'metric':
		case 'supplier':
		case 'commodity':
			$active[7] = "active"; break;
		case 'controlresults':
		case 'control':
		case 'lot': $active[8] = "active"; break;
	}
?>
	<ul class="nav nav-sidebar">
		<li>
			<div class="main-menu {{$active[0]}}">
				<a href="{{ URL::route('user.home')}}" title="{{trans('messages.home')}}">
					<span class="glyphicon glyphicon-home"></span> {{trans('messages.home')}}</a>
			</div>
		</li>
		<li>
			<div class="main-menu {{$active[0]}}">
				<a href="{{ URL::route('patient.index')}}">
					<span class="glyphicon glyphicon-download-alt"></span> {{ Lang::choice('messages.patient', 2)}}</a>
			</div>
		</li>
<nav id="side_nav">
			<ul>

				<li>
					<a href="{{ URL::route('user.home')}}"><span class="ion-home"></span> <span class="nav_title">Main Menu</span></a>
				</li>
				
				<li class="nav_trigger">
					<a href="#">
						<span class="ion-stats-bars"></span>
						<span class="nav_title">Reports</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first">{{trans('messages.daily-reports')}}</h4>
							<ul>
								<li>
									<div>
										<a href="{{ URL::route('reports.patient.index')}}">
											<span class="glyphicon glyphicon-tag"></span>
											{{trans('messages.patient-report')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.daily.log')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.daily-log')}}</a>
									</div>
								</li>
							</ul>
							<h4 class="panel_heading panel_heading_first">{{trans('messages.aggregate-reports')}}</h4>
							<ul>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.prevalence')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.prevalence-rates')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.surveillance')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.surveillance')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.counts')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.counts')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.tat')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.turnaround-time')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.infection')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.infection-report')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.userStatistics')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.user-statistics-report')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.moh706')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.moh-706')}}</a>
									</div>
								</li>
								<li>
									<div><a href="#">
										<span class="glyphicon glyphicon-tag"></span>
										HMIS 105</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.aggregate.cd4')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.cd4-report')}}</a>
									</div>
								</li>
								<li>
									<div><a href="{{ URL::route('reports.qualityControl')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{Lang::choice('messages.quality-control', 2)}}</a>
									</div>
								</li>
							</ul>
							<h4 class="panel_heading panel_heading_first">{{trans('messages.inventory-reports')}}</h4>
							<ul>
								<li>
									<div><a href="{{ URL::route('reports.inventory')}}">
										<span class="glyphicon glyphicon-tag"></span>
										{{trans('messages.stock-levels')}}</a>
									</div>
								</li>
							</ul>
							<h4 class="panel_heading panel_heading_first">Dashboard</h4>
							<ul>
								<li>
									<div><a href="{{ URL::route('user.dashboard')}}">
										<span class="glyphicon glyphicon-tag"></span>
										Dashboard</a>
									</div>
								</li>
							</ul>

						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>
				
				<li class="nav_trigger">
					<a href="#"><span class="ion-person"></span><span class="nav_title">Patient Information</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first">{{ Lang::choice('messages.patient-unhls', 1)}}</h4>
							<ul>
								<li>
									<div>
										<a href="{{ URL::route('unhls_patient.create')}}">
											<span class="glyphicon glyphicon-tag"></span> {{Lang::choice('messages.register-new-patient', 1)}}</a>
									</div>
								</li>
								<li>
									<div>
										<a href="{{ URL::route('unhls_patient.index') }}">
											<span class="glyphicon glyphicon-tag"></span> {{Lang::choice('messages.view-patients', 1)}}</a>
									</div>
								</li>

							</ul>

						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>
				<li class="nav_trigger">
					<a href="#">
						<span class="ion-erlenmeyer-flask"></span>
						<span class="nav_title">Tests</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first"> Tests</h4>
							<ul>
								<li>
									<div>
										<a href="javascript:void(0)" data-toggle="modal" data-target="#new-test-modal-unhls">
											<!--<span class="glyphicon glyphicon-plus-sign"></span>{{trans('messages.new-test')}}-->
											<span class="glyphicon glyphicon-plus-sign"></span> Make Test Request
										</a>
									</div>
								</li>

								<li>
									<div>
										<a href="{{ URL::route('unhls_test.index')}}">
											<!--<span class="glyphicon glyphicon-tag"></span> {{Lang::choice('messages.test-unhls', 2)}}</a>-->
											<span class="glyphicon glyphicon-tag"></span> List of All Tests</a>
									</div>
								</li> 
								<li>
									<div>
										<a href="{{URL::route('unhls_test.completed')}}">
											<span class="glyphicon glyphicon-tag" ></span>{{trans('Completed Tests')}}
										</a>
									</div>
								</li>
																<li>
									<div>
										<a href="{{URL::route('unhls_test.notrecieved')}}">
											<span class="glyphicon glyphicon-tag" ></span>{{trans('Samples Not Recieved')}}
										</a>
									</div>
								</li>
																<li>
									<div>
										<a href="{{URL::route('unhls_test.pending')}}">
											<span class="glyphicon glyphicon-tag" ></span>{{trans('Pending Tests')}}
										</a>
									</div>
								</li>
																<li>
									<div>
										<a href="{{URL::route('unhls_test.started')}}">
											<span class="glyphicon glyphicon-tag" ></span>{{trans('Tests Started')}}
										</a>
									</div>
								</li>
																<li>
									<div>
										<a href="{{URL::route('unhls_test.verified')}}">
											<span class="glyphicon glyphicon-tag" ></span>{{trans('Verified Tests')}}
										</a>
									</div>
								</li>

							</ul>

						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>
				<li class="nav_trigger">
					<a href="#">
					<span class="ion-wrench"></span>
						<span class="nav_title">Lab Configuration</>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height:620px;">
							<h4 class="panel_heading panel_heading_first">Lab Configuration</h4>
							<ul>
								<li>
									<a href="{{URL::route("instrument.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.instrument')}}</a>
								</li>
								<li>
									<a href="{{URL::route("reportconfig.surveillance")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.surveillance')}}</a>
								</li>
								<li>
									<a href="{{URL::route("barcode.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.barcode-settings')}}</a>
								</li>
								<li>
									<a href="{{ URL::route("blisclient.index") }}">
									<span class="glyphicon glyphicon-tag"></span>{{ trans('messages.interfaced-equipment')}}</a>
								</li>
							</ul>
						</div>
					</div>
				</li>

				<li class="nav_trigger">
					<a href="#">
					<span class="ion-gear-a"></span>
						<span class="nav_title">Test Catalog</>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height:620px;">
							<h4 class="panel_heading panel_heading_first">Test Catalog</h4>
							<ul>
								<li>
									<a href="{{URL::route("testcategory.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.test-category')}}</a>
								</li>
								<li>
									<a href="{{URL::route("specimentype.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.specimen-type')}}</a>
								</li>
								<li>
									<a href="{{URL::route("specimenrejection.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.specimen-rejection')}}</a>
								</li>
								<li>
									<a href="{{URL::route("testtype.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.test-type')}}</a>
								</li>
								<li>
									<a href="{{URL::route("drug.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.drug')}}</a>
								</li>
								<li>
									<a href="{{URL::route("organism.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.organism')}}</a>
								</li>
							</ul>
						</div>
					</div>
				</li>


				<li class="nav_trigger">
					<a href="#">
					<span class="ion-ios-cart"></span>
						<span class="nav_title">Inventory & Equipment</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first">Inventory</h4>
							<ul>
								<li>
									<a href="{{ URL::route("stockcard.index")}}">
									<span class="glyphicon glyphicon-tag"></span> {{trans('messages.stock-card')}}</a>
								</li>
							<li>
								<a href="{{ URL::route("stockrequisition.index")}}">
								<span class="glyphicon glyphicon-tag"></span> Stockbook</a>
							</li>
							<li>
								<a href="{{ URL::route("commodity.index")}}">
								<span class="glyphicon glyphicon-tag"></span> {{trans('messages.commodities')}}</a>
							</li>
							<li>
								<a href="{{ URL::route("supplier.index")}}">
								<span class="glyphicon glyphicon-tag"></span> {{Lang::choice('messages.suppliers',2)}}</a>
							</li>
							<li>
								<a href="{{ URL::route("metric.index")}}">
								<span class="glyphicon glyphicon-tag"></span> {{trans('messages.metrics')}}</a>
							</li>
							</ul>
							<h4 class="panel_heading">Equipment</h4>
							<ul>
								<li><a href="{{ URL::route("equipmentinventory.index")}}"><span class="glyphicon glyphicon-tag"></span> Inventory</a></li>
								<li><a href="{{ URL::route("equipmentmaintenance.index")}}"><span class="glyphicon glyphicon-tag"></span> Maintenance log</a></li>
								<li><a href="{{ URL::route("equipmentbreakdown.index")}}"><span class="glyphicon glyphicon-tag"></span> Breakdown</a></li>
								<li><a href="{{ URL::route("equipmentsupplier.index")}}"><span class="glyphicon glyphicon-tag"></span> Supplier</a></li>
							</ul>
						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>


				<li class="nav_trigger">
					<a href="#">
						<span class="ion-nuclear"></span>
						<span class="nav_title">Biosafety & Biosecurity</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first">Bio-safety / Bio-security</h4>
							<ul>
							<li>
								<a href="{{ URL::route('bbincidence.index')}}">
								<span class="glyphicon glyphicon-list"></span> Summary Log</a>
							</li>
							<li>
							<a href="{{ URL::route('bbincidence.create')}}">
								<span class="glyphicon glyphicon-plus-sign"></span> Register Incident</a>
							</li>
							<li>
							<a href="{{ URL::route('bbincidence.bbfacilityreport')}}">
								<span class="glyphicon glyphicon-stats"></span> Facility Report</a>
							</li>
							</ul>

						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>


				<li class="nav_trigger">
					<a href="#">
						<span class="ion-key"></span>
						<span class="nav_title">Access Control</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first">Access Control</h4>
							<ul>
					<li>
						<div>
							<a href="{{ (Entrust::can('manage_users')) ? URL::route('user.index') : URL::to('user/'.Auth::user()->id.'/edit') }}">
								<span class="glyphicon glyphicon-tag"></span> {{trans('messages.user-accounts')}}</a>
						</div>
					</li>
					<li>
						<div>
							<a href="{{ URL::route("permission.index")}}">
								<span class="glyphicon glyphicon-tag"></span> {{ Lang::choice('messages.permission', 2)}}</a>
						</div>
					</li>
					<li>
						<div>
							<a href="{{ URL::route("role.index")}}">
								<span class="glyphicon glyphicon-tag"></span> {{ Lang::choice('messages.role', 2)}}</a>
						</div>
					</li>
					<li>
						<div>
							<a href="{{ URL::route("role.assign")}}">
								<span class="glyphicon glyphicon-tag"></span> {{trans('messages.assign-roles')}}</a>
						</div>
					</li>
							</ul>

						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>
				
				<li class="nav_trigger">
					<a href="#">
						<span class="ion-ios-folder"></span>
						<span class="nav_title">Other Resouces</span>
					</a>
					<div class="sub_panel" style="left: -220px;">
						<div class="side_inner ps-ready ps-container" style="height: 620px;">
							<h4 class="panel_heading panel_heading_first">Other Resources</h4>
							<ul>
							<li>
								<a href="http://www.cphluganda.org/" target="_blank">
								<span class=""></span> EID Dashboard</a>
							</li>
							<li>
							<a href="http://vldash.cphluganda.org/" target="_blank">
								<span class=""></span> Viral Load Dashboard</a>
							</li>
							<li>
							<a href="http://cphl.go.ug/" target="_blank">
								<span class=""></span> CPHL/UNHLS Website</a>
							</li>
							<li>
							<a href="http://health.go.ug/" target="_blank">
								<span class=""></span> MoH Website</a>
							</li>
							</ul>

						<div class="ps-scrollbar-x-rail" style="left: 0px; bottom: 3px; width: 215px; display: none;"><div class="ps-scrollbar-x" style="left: 0px; width: 0px;"></div></div><div class="ps-scrollbar-y-rail" style="top: 0px; right: 3px; height: 620px; display: none;"><div class="ps-scrollbar-y" style="top: 0px; height: 0px;"></div></div></div>
					</div>
				</li>

			</ul>
		</nav>
@show
