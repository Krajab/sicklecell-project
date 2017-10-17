@extends("layout")
@section("content")
<div>
	<ol class="breadcrumb">
		<li><a href="{{{URL::route('user.home')}}}">{{ trans('messages.home') }}</a></li>
		<li class="active">{{ Lang::choice('messages.report',2) }}</li>
		<li class="active">HMIS 105</li>
	</ol>
</div>
<br />
<div class="panel panel-primary">
	<div class="panel-heading ">
		<span class="glyphicon glyphicon-stats"></span>
		HMIS 105 | 
		<a title="Previous Month"
			href="{{URL::to('/hmis105/'.date('Y-m',strtotime(date('Y-m',strtotime($month)).' -1 month')))}}">
			<span class="btn btn-default ion-android-arrow-back"></span></a>
		{{date('Y-M',strtotime($month))}}
		<a title="Next Month"
			href="{{URL::to('/hmis105/'.date('Y-m',strtotime(date('Y-m',strtotime($month)).' +1 month')))}}">
			<span class="btn btn-default ion-android-arrow-forward"></span></a>
	</div>
	<div class="panel-body">
	@if (Session::has('message'))
		<div class="alert alert-info">{{ trans(Session::get('message')) }}</div>
	@endif	
		<div class="table-responsive">
			<table class="table table-condensed report-table-border">
				<tbody>
					<tr>
						<th colspan="13" style="background-color: #cccccc;">7. LABORATORY TESTS</th>
					</tr>
					<tr>
						<td colspan="2">LABORATORY TESTS</td>
						<td colspan="2">NUMBER DONE</td>
						<td colspan="2">NUMBER POSITIVE</td>
						<td></td>
						<td colspan="2">LABORATORY TESTS</td>
						<td colspan="2">NUMBER DONE</td>
						<td colspan="2">NUMBER POSITIVE</td>
					</tr>
					<tr>
						<td colspan="6" style="background-color: #cccccc;">7.1 HEMATOLOGY (BLOOD)</td>
						<td></td>
						<td colspan="2">38. Hepatitis B</td>
						<td colspan="2">{{(isset($testTypeCountArray['hepatitis_b']))?$testTypeCountArray['hepatitis_b']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['hepatitis_b']))?$testTypeCountArray['hepatitis_b']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">01. Hb</td>
						<td colspan="2">
							@if(isset($testTypeCountArray['hb']))
							{{(isset($testTypeCountArray['hb']['hb']))?$testTypeCountArray['hb']['hb']['total']:''}}
							@endif
						</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">39. Brucella</td>
						<td colspan="2">{{(isset($testTypeCountArray['brucella']))?$testTypeCountArray['brucella']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['brucella']))?$testTypeCountArray['brucella']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">02. HBG<8</td>
						<td colspan="2">
							@if(isset($testTypeCountArray['cbc']))
								{{(isset($testTypeCountArray['cbc']['hgb']))?$testTypeCountArray['cbc']['hgb']['hbg_less_8']:''}}
							@endif
						</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">40. Pregnancy Test</td>
						<td colspan="2">{{(isset($testTypeCountArray['pregnancy_test']))?$testTypeCountArray['pregnancy_test']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['pregnancy_test']))?$testTypeCountArray['pregnancy_test']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">03. HBG≥8</td>
						<td colspan="2">
							@if(isset($testTypeCountArray['cbc']))
								{{(isset($testTypeCountArray['cbc']['hgb']))?$testTypeCountArray['cbc']['hgb']['hbg_equal_8']:''}}
							@endif
						</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">41. Rheumatoid Factor</td>
						<td colspan="2">{{(isset($testTypeCountArray['rheumatoid_factor']))?$testTypeCountArray['rheumatoid_factor']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['rheumatoid_factor']))?$testTypeCountArray['rheumatoid_factor']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">04. WBC Total</td>
						<td colspan="2">
							@if(isset($testTypeCountArray['cbc']))
								{{(isset($testTypeCountArray['cbc']['wbc_total']))?$testTypeCountArray['cbc']['wbc_total']['total']:''}}
							@endif
						</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2" rowspan="4">42. Others</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">05. WBC Differential</td>
						<td colspan="2">{{(isset($testTypeCountArray['wbc_differential']))?$testTypeCountArray['wbc_differential']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">06. Film Comment</td>
						<td colspan="2">{{(isset($testTypeCountArray['film_comment']))?$testTypeCountArray['film_comment']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">07. ESR</td>
						<td colspan="2">{{(isset($testTypeCountArray['esr']))?$testTypeCountArray['esr']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">08. RBC</td>
						<td colspan="2">
						@if(isset($testTypeCountArray['cbc']))
							{{(isset($testTypeCountArray['cbc']['rbc']))?$testTypeCountArray['cbc']['rbc']['total']:''}}
						@endif
						</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="6" style="background-color: #cccccc;">7.5 IMMUNOLOGY</td>
					</tr>
					<tr>
						<td colspan="2">09. Bleeding time</td>
						<td colspan="2">{{(isset($testTypeCountArray['bleeding_time']))?$testTypeCountArray['bleeding_time']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">43. CD4 tests</td>
						<td colspan="2">{{(isset($testTypeCountArray['cd4_tests']))?$testTypeCountArray['cd4_tests']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
					</tr>
					<tr>
						<td colspan="2">10 Prothrombin Time</td>
						<td colspan="2">{{(isset($testTypeCountArray['prothrombin_time']))?$testTypeCountArray['prothrombin_time']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">44. Viral Load Tests</td>
						<td colspan="2">{{(isset($testTypeCountArray['viral_load_tests']))?$testTypeCountArray['viral_load_tests']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
					</tr>
					<tr>
						<td colspan="2">11. Clotting Time</td>
						<td colspan="2">{{(isset($testTypeCountArray['clotting_time']))?$testTypeCountArray['clotting_time']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">45. Others</td>
						<td colspan="2"></td>
						<td colspan="2" style="background-color: #777777;"></td>
					</tr>
					<tr>
						<td colspan="2" rowspan="3">12. Others</td>
						<td colspan="2"></td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="6" style="background-color: #cccccc;">7.6 MICROBIOLOGY (CSF URINE, STOOL, BLOOD, SPUTUM, SWABS)</td>
					</tr>

					<tr>
						<td colspan="2"></td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">46. ZN for AFBs</td>
						<td colspan="2">{{(isset($testTypeCountArray['zn_for_afbs']))?$testTypeCountArray['zn_for_afbs']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['zn_for_afbs']))?$testTypeCountArray['zn_for_afbs']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2"></td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">47.Routine Cultures & Sensitivities</td>
						<td colspan="2">{{(isset($testTypeCountArray['routine_cultures_sensitivities']))?$testTypeCountArray['routine_cultures_sensitivities']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['routine_cultures_sensitivities']))?$testTypeCountArray['routine_cultures_sensitivities']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="6" style="background-color: #cccccc;">7.2 BLOOD TRANSFUSION</td>
						<td></td>
						<td colspan="2">48. Gram</td>
						<td colspan="2">{{(isset($testTypeCountArray['gram']))?$testTypeCountArray['gram']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['gram']))?$testTypeCountArray['gram']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">13. ABO Grouping</td>
						<td colspan="2">{{(isset($testTypeCountArray['abo_grouping']))?$testTypeCountArray['abo_grouping']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">49. India Ink</td>
						<td colspan="2">{{(isset($testTypeCountArray['india_ink']))?$testTypeCountArray['india_ink']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['india_ink']))?$testTypeCountArray['india_ink']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">14. Combs</td>
						<td colspan="2">{{(isset($testTypeCountArray['combs']))?$testTypeCountArray['combs']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['combs']))?$testTypeCountArray['combs']['total']:''}}</td>
						<td></td>
						<td colspan="2">50. Wet Preps</td>
						<td colspan="2">{{(isset($testTypeCountArray['wet_preps']))?$testTypeCountArray['wet_preps']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['wet_preps']))?$testTypeCountArray['wet_preps']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">15. Cross Matching</td>
						<td colspan="2">{{(isset($testTypeCountArray['cross_matching']))?$testTypeCountArray['cross_matching']['total']:''}}</td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">51. Urine Microscopy</td>
						<td colspan="2">{{(isset($testTypeCountArray['urine_microscopy']))?$testTypeCountArray['urine_microscopy']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['urine_microscopy']))?$testTypeCountArray['urine_microscopy']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">16. Blood Collected (Units)</td>
						<td colspan="2"></td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="6" style="background-color: #cccccc;">7.7 CLINICAL CHEMISTRY</td>
					</tr>
					<tr>
						<td colspan="2">17. Blood Transfusion(Lts)</td>
						<td colspan="2"></td>
						<td colspan="2" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="6">Renal Profile</td>
					</tr>
					<tr>
						<td colspan="6" style="background-color: #cccccc;">7.3 PARASITOLOGY</td>
						<td></td>
						<td colspan="2">52. Urea</td>
						<td colspan="2">{{(isset($testTypeCountArray['urea']))?$testTypeCountArray['urea']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['urea']))?$testTypeCountArray['urea']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">CATEGORY</td>
						<td colspan="1">0-4 years</td>
						<td colspan="1">5 and over</td>
						<td colspan="1">0-4 years</td>
						<td colspan="1">5 and over</td>
						<td></td>
						<td colspan="2">53. Calcium</td>
						<td colspan="2">{{(isset($testTypeCountArray['calcium']))?$testTypeCountArray['calcium']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['calcium']))?$testTypeCountArray['calcium']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">18. Malaria Microscopy</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_microscopy']))?$testTypeCountArray['malaria_microscopy']['total']['under_5']:''}}</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_microscopy']))?$testTypeCountArray['malaria_microscopy']['total']['above_5']:''}}</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_microscopy']))?$testTypeCountArray['malaria_microscopy']['positive']['under_5']:''}}</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_microscopy']))?$testTypeCountArray['malaria_microscopy']['positive']['above_5']:''}}</td>
						<td></td>
						<td colspan="2">54. Potassium</td>
						<td colspan="2">{{(isset($testTypeCountArray['potassium']))?$testTypeCountArray['potassium']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['potassium']))?$testTypeCountArray['potassium']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">19. Malaria RDTs</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_rdts']))?$testTypeCountArray['malaria_rdts']['total']['under_5']:''}}</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_rdts']))?$testTypeCountArray['malaria_rdts']['total']['above_5']:''}}</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_rdts']))?$testTypeCountArray['malaria_rdts']['positive']['under_5']:''}}</td>
						<td colspan="1">{{(isset($testTypeCountArray['malaria_rdts']))?$testTypeCountArray['malaria_rdts']['positive']['above_5']:''}}</td>
						<td></td>
						<td colspan="2">55. Sodium</td>
						<td colspan="2">{{(isset($testTypeCountArray['sodium']))?$testTypeCountArray['sodium']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['sodium']))?$testTypeCountArray['sodium']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">20. Trypanosoma</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">56. Creatinine</td>
						<td colspan="2">{{(isset($testTypeCountArray['creatinine']))?$testTypeCountArray['creatinine']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['creatinine']))?$testTypeCountArray['creatinine']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">21. Microfilaria</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="6">Liver Profile</td>
					</tr>
					<tr>
						<td colspan="2">22. Leishmania</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">57. ALT</td>
						<td colspan="2">{{(isset($testTypeCountArray['alt']))?$testTypeCountArray['alt']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['alt']))?$testTypeCountArray['alt']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">23. Trichinella</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">58. AST</td>
						<td colspan="2">{{(isset($testTypeCountArray['ast']))?$testTypeCountArray['ast']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['ast']))?$testTypeCountArray['ast']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">24. Borrella</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">59. Albumin</td>
						<td colspan="2">{{(isset($testTypeCountArray['albumin']))?$testTypeCountArray['albumin']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['albumin']))?$testTypeCountArray['albumin']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">Stool Microscopy</td>
						<td colspan="4" style="background-color: #777777;"></td>
						<td></td>
						<td colspan="2">60. Total Protein</td>
						<td colspan="2">{{(isset($testTypeCountArray['total_protein']))?$testTypeCountArray['total_protein']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['total_protein']))?$testTypeCountArray['total_protein']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">25. Entamoeba</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="6">Lipid/Cardiac Profile</td>
					</tr>
					<tr>
						<td colspan="2">26. Glardia Lamblia</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">61. Triglycerides</td>
						<td colspan="2">{{(isset($testTypeCountArray['triglycerides']))?$testTypeCountArray['triglycerides']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['triglycerides']))?$testTypeCountArray['triglycerides']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">27. Trichomonas</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">62. Cholesterol</td>
						<td colspan="2">{{(isset($testTypeCountArray['cholesterol']))?$testTypeCountArray['cholesterol']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['cholesterol']))?$testTypeCountArray['cholesterol']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">28. Stronyloides</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">63. CK</td>
						<td colspan="2">{{(isset($testTypeCountArray['ck']))?$testTypeCountArray['ck']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['ck']))?$testTypeCountArray['ck']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">29. Shistosoma</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">64. LDH</td>
						<td colspan="2">{{(isset($testTypeCountArray['ldh']))?$testTypeCountArray['ldh']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['ldh']))?$testTypeCountArray['ldh']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">30. Taenia</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">65. HDL</td>
						<td colspan="2">{{(isset($testTypeCountArray['hdl']))?$testTypeCountArray['hdl']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['hdl']))?$testTypeCountArray['hdl']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">31. Askaris</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="6">Other Clinical Chemistry Tests</td>
					</tr>
					<tr>
						<td colspan="2">32. Hookworm</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">66. Alkaline Phos</td>
						<td colspan="2">{{(isset($testTypeCountArray['alkaline_phosphates']))?$testTypeCountArray['alkaline_phosphates']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['alkaline_phosphates']))?$testTypeCountArray['alkaline_phosphates']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">33. Trichuris</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">67. Amylase</td>
						<td colspan="2">{{(isset($testTypeCountArray['amylase']))?$testTypeCountArray['amylase']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['amylase']))?$testTypeCountArray['amylase']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">34. Other Parasites</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
						<td></td>
						<td colspan="2">68. Glucose</td>
						<td colspan="2">
							@if(isset($testTypeCountArray['glucose']))
								{{(isset($testTypeCountArray['glucose']['glucose']))?$testTypeCountArray['glucose']['glucose']['total']:''}}
							@endif
						</td>
						<td colspan="2">
							@if(isset($testTypeCountArray['glucose']))
								{{(isset($testTypeCountArray['glucose']['glucose']))?$testTypeCountArray['glucose']['glucose']['total']:''}}
							@endif
						</td>
					</tr>
					<tr>
						<td colspan="6" style="background-color: #cccccc;">7.4 SEROLOGY</td>
						<td></td>
						<td colspan="2">69. Uric Acid</td>
						<td colspan="2">{{(isset($testTypeCountArray['uric_acid']))?$testTypeCountArray['uric_acid']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['uric_acid']))?$testTypeCountArray['uric_acid']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">35. VDRL/RPR</td>
						<td colspan="2">{{(isset($testTypeCountArray['vdrl_rpr']))?$testTypeCountArray['vdrl_rpr']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['vdrl_rpr']))?$testTypeCountArray['vdrl_rpr']['total']:''}}</td>
						<td></td>
						<td colspan="2">70. Lactate</td>
						<td colspan="2">{{(isset($testTypeCountArray['lactate']))?$testTypeCountArray['lactate']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['lactate']))?$testTypeCountArray['lactate']['total']:''}}</td>
					</tr>
					<tr>
						<td colspan="2">36. TPHA</td>
						<td colspan="2">{{(isset($testTypeCountArray['tpha']))?$testTypeCountArray['tpha']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['tpha']))?$testTypeCountArray['tpha']['total']:''}}</td>
						<td></td>
						<td colspan="2" rowspan="2">71. Others</td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
					<tr>
						<td colspan="2">37. Shigella Dysentery</td>
						<td colspan="2">{{(isset($testTypeCountArray['shigella_dysentery']))?$testTypeCountArray['shigella_dysentery']['total']:''}}</td>
						<td colspan="2">{{(isset($testTypeCountArray['shigella_dysentery']))?$testTypeCountArray['shigella_dysentery']['total']:''}}</td>
						<td></td>
						<td colspan="2"></td>
						<td colspan="2"></td>
					</tr>
				</tbody>
			</table>
			<br>
			<table  class="table table-condensed report-table-border">
				<tr>
					<td colspan="7" style="background-color: #cccccc;">7.8 SUMMARY OF HIV TEST BY PURPOSE</td>
				</tr>
				<tr>
					<td>CATEGORY</td>
					<td>HCT</td>
					<td>PMTCT</td>
					<td>CLINICAL DIAGNOSIS</td>
					<td>QUALITY CONTROL</td>
					<td>SMC</td>
					<td>TOTAL</td>
				</tr>
				<tr>
					<td>72. DETERMINE</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>73. STAT PAK</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td>74. UNIGOLD</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>
			</table>
		</div>
	</div>
</div>

@stop