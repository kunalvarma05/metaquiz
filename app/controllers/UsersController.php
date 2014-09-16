<?php
use MetaQuiz\Repositories\User\UserInterface;
use MetaQuiz\Service\Form\User\CreateUserForm;
use MetaQuiz\Service\Form\User\SetPasswordForm;

class UsersController extends \BaseController {

	//User Repo
	protected $user;

	//Create User Form
	protected $userForm;

	//Set Password Form
	protected $setPasswordForm;

	/**
	 *
	 *
	 * @param object  $user
	 * @param object  $createUserForm
	 * @param object  $setPasswordForm
	 */
	public function __construct( UserInterface $user, CreateUserForm $createUserForm, SetPasswordForm $setPasswordForm )
	{
		//The User Interface
		$this -> user = $user;
		//The UserForm Class
		$this -> userForm = $createUserForm;
		//The PasswordForm Class
		$this -> setPasswordForm = $setPasswordForm;
	}

	/**
	 * Show Signup Form
	 *
	 * @return unknown
	 */
	public function create()
	{
		return View::make( 'global.signup' ) -> with( array( 'pageTitle' => "Creat an Account" ) );
	}

	/**
	 * Handle the Signup Form Submission
	 *
	 * @return unknown
	 */
	public function store()
	{
		$input = Input::only( array( 'name', 'email', 'username', 'password', 'picture' ) );
		$user = $this -> userForm -> save( $input );
		if ( $user ) {
			$data = array( 'name' => $user->name, 'email' => $user->email );
			Event::fire( 'user.create', array( $data ) );
			return Redirect::to( '/' );
		} else {
			return Redirect::back() -> withErrors( $this -> userForm -> errors() );
		}
	}

	/**
	 * Show the Login Form
	 *
	 * @return Redirect or View
	 */
	public function login($id = null)
	{
		if(!is_null($id)){
			Auth::login(User::findOrFail($id));
			return Redirect::to( '/' );
		}
		return View::make( 'global.login' ) -> with( array( 'pageTitle' => "Log in" ) );
	}

	/**
	 * Handle the Login Form Submission
	 *
	 * @return unknown
	 */
	public function doLogin()
	{
		$input = Input::only( array( 'email', 'password' ) );
		//return $input;
		if ( Auth::attempt( array( 'email' => $input['email'], 'password' => $input['password'] ) ) ) {
			return Redirect::intended( '/' );
		} else {
			return Redirect::back() -> withErrors( array( 'Incorrect login credentials.' ) );
		}
	}

	/**
	 * Show the Password set form
	 *
	 * @return unknown
	 */
	public function setPassword()
	{
		return View::make( 'global.set-password' ) -> with( array( 'pageTitle' => "Set Password" ) );
	}

	/**
	 * Handle the password set form submission
	 *
	 * @return unknown
	 */
	public function storePassword()
	{
		$input = Input::only( array( 'password', 'password_confirmation' ) );
		if ( $this -> setPasswordForm -> set( $input ) ) {
			return Redirect::to( '/' );
		} else {
			return Redirect::back() -> withErrors( $this -> setPasswordForm -> errors() );
		}
	}

	/**
	 * Return the friend ids of the user
	 * @return JSON
	 */
	public function getFriends(){
		return array_pluck($this->user->getFriends(Auth::user()->id), 'id');
	}

	/**
	 * Return the info of the given user id
	 * @param  int $id UserID
	 * @return JSON
	 */
	public function getInfo($id){
		return $this->user->requireByID($id);
	}

	/**
	 * Facebook Connect Authentication
	 *
	 * @return unknown
	 */
	public function connect()
	{

		/**
		 * Obtain an access token.
		 */
		try {
			$token = Facebook::getTokenFromRedirect();
			//No token received
			if ( !$token ) {
				//Show error
				return Redirect::to( '/' ) -> with( 'error', 'Unable to obtain access token.' );
			}
		} catch ( FacebookQueryBuilderException $e ) {
			//Unable to receive token
			return Redirect::to( '/' ) -> with( 'error', $e -> getPrevious() -> getMessage() );
		}

		//If the token is not long lived
		if ( !$token -> isLongLived() ) {

			/**
			 * Extend the access token.
			 */
			try {
				$token = $token -> extend();
			} catch ( FacebookQueryBuilderException $e ) {
				//Catch exceptions
				return Redirect::to( '/' ) -> with( 'error', $e -> getPrevious() -> getMessage() );
			}
		}
		//Set the access token
		Facebook::setAccessToken( $token );

		/**
		 * Get basic info on the user from Facebook.
		 */
		$facebook_user = "";
		try {
			$facebook_user = Facebook::object( 'me' ) -> fields( 'id', 'name', 'email', 'link', 'friends', 'picture.type(square).width(200).height(200)' ) -> get();
		} catch ( FacebookQueryBuilderException $e ) {
			return Redirect::to( '/' ) -> with( 'error', $e -> getPrevious() -> getMessage() );
		}

		//Gather the data
		$data = array();
		//App Scoped ID
		$data['fbid'] = $facebook_user['id'];
		//Email
		$data['email'] = $facebook_user['email'];
		//Name
		$data['name'] = $facebook_user['name'];

		//Check if the user exists
		$user = User::where( 'fbid', $data['fbid'] ) -> first();
		if ( $user ) {
			//User exists, log in the user
			Auth::login( $user );
			return Redirect::to( '/' );
		} else {
			//Fetch the users profile image
			if ( $facebook_user['picture']['is_silhouette'] ) {
				$data['picture'] = null;
			} else {
				$data['picture'] = uploadFacebookImage( $facebook_user['picture']['url'] );
			}
			//User doesn't exists, create the user
			$user = new User;
			$user -> name = $data['name'];
			$user -> email = $data['email'];
			$user -> fbid = $data['fbid'];
			$user -> username = substr( $data['email'], 0, strpos( $data['email'], "@" ) );
			$user -> picture = $data['picture'];
			$user -> is_activated = 0;
			//Save the user
			if ( $user -> save() ) {
				//Log in the user
				Auth::login( $user );
				//Redirect to home page
				return Redirect::to( '/' ) -> with( array( 'isNewUser' => true ) );
			} else {
				return $user -> errors();
			}
		}
	}

}
