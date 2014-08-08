<?php
use MetaQuiz\Repositories\Organization\OrganizationInterface;
class OrganizationsController extends \BaseController {

	//The Org Object
	private $org;

	//The Constructor
	public function __construct(OrganizationInterface $org) {
		$this -> org = $org;
		$this -> beforeFilter('auth', array('except' => ''));
		$this -> beforeFilter('admin', array('except' => ''));
		$this -> beforeFilter('csrf', array('on' => array('store', 'update')));
	}

	/**
	 * Display a listing of the resource.
	 * GET /organizations
	 *
	 * @return Response
	 */
	public function index() {
		$org = Auth::user() -> organization;
		return View::make('management.organization.index');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /organizations/create
	 *
	 * @return Response
	 */
	public function create() {
		return View::make('management.organization.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /organizations
	 *
	 * @return Response
	 */
	public function store() {
		//
	}

	/**
	 * Display the specified resource.
	 * GET /organizations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id) {
		return Redirect::to(URL::route('organization.index'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /organizations/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id) {
		$org = $this -> org -> byID($id);
		return $org;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /organizations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /organizations/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id) {
		//
	}

}
