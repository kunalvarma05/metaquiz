<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
use MetaQuiz\Service\Form\Organization\CreateOrganizationForm;
use MetaQuiz\Service\Form\Organization\UpdateOrganizationForm;

class AdminOrganizationsController extends \BaseController {

	private $org;

	private $createOrgForm;

	private $updateOrgForm;

	/**
	 * [__construct The Constructor]
	 * @param OrganizationInterface  $org                    [The Organization Interface]
	 * @param CreateOrganizationForm $createOrganizationForm [The Create Organization Form Class]
	 * @param UpdateOrganizationForm $updateOrganizationForm [The Update Organization Form Class]
	 */
	public function __construct(OrganizationInterface $org, CreateOrganizationForm $createOrganizationForm, UpdateOrganizationForm $updateOrganizationForm) {
		//Set the objects
		$this -> org = $org;
		$this -> createOrgForm = $createOrganizationForm;
		$this -> updateOrgForm = $updateOrganizationForm;		
	}

	/**
	 * Display a listing of the resource.
	 * GET /organizations
	 *
	 * @return Response
	 */
	public function index() {
		$organizations = $this -> org -> all();
		$pageTitle = "Organizations";
		return View::make('admin.organizations.index') -> with(compact('pageTitle','organizations'));		
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /organizations/create
	 *
	 * @return Response
	 */
	public function create() {
		$pageTitle = "Create Organization";
		return View::make('admin.organizations.create') -> with(compact('pageTitle'));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /organizations
	 *
	 * @return Response
	 */
	public function store() {
		$input = Input::only(array('name', 'description', 'picture'));
		$organization = $this -> createOrgForm -> create($input);
		if ($organization) {
			return Redirect::to(URL::route('admin.organizations.index'));
		} else {
			return Redirect::back() -> withErrors($this -> createOrgForm -> errors())->withInput();
		}
	}

	/**
	 * Display the specified resource.
	 * GET /organizations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		$organization = $this -> org -> requireByID($id, array('courses','faculties','manager'));
		$pageTitle = $organization->name;
		return View::make('admin.organizations.show', compact('pageTitle', 'organization'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /organizations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$organization = $this -> org -> requireByID($id);		
		$pageTitle = "Edit " . $organization->name;
		return View::make('admin.organizations.edit') -> with(compact('pageTitle', "organization"));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /organizations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		$input = Input::only(array('name', 'description', 'picture'));
		$organization = $this -> updateOrgForm -> update($id, $input);
		if ($organization) {
			return Redirect::to(URL::route('admin.organizations.show', $id));
		} else {
			return Redirect::back() -> withErrors($this -> updateOrgForm -> errors())->withInput();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /organizations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		$delete = $this->org->requireByID($id)->delete();
		if($delete){
			return Redirect::to(URL::route('admin.organizations.index'));
		}else{
			return Redirect::back();
		}
	}

}
