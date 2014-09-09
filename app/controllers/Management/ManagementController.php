<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Service\Form\Organization\UpdateOrganizationForm;

class ManagementController extends \BaseController {

	private $org;
	private $updateOrgForm;

	/**
	 * [__construct The Constructor]
	 * @param OrganizationInterface  $org                    [The Organization Interface]
	 * @param UpdateOrganizationForm $updateOrganizationForm [The Update Organization Form Class]
	 */
	public function __construct(OrganizationInterface $org, UpdateOrganizationForm $updateOrganizationForm) {
		//Set the objects
		$this -> org = $org;
		$this -> updateOrgForm = $updateOrganizationForm;
	}

	/**
	 * Redirect to the Dashboard
	 */
	public function index(){
		return Redirect::to(URL::route('management.dashboard'));
	}

	/**
	 * Display a listing of the resource.
	 * GET /management
	 *
	 * @return Response
	 */
	public function dashboard() {
		$pageTitle = "Dashboard";
		return View::make('management.dashboard', compact('pageTitle'));
	}

}
