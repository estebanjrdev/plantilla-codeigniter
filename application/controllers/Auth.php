<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Auth extends CI_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(['ion_auth', 'form_validation']);
		$this->load->helper(['url', 'language','fechas']);
		$this->load->model('Ion_auth_model');
		$this->load->model('tiradas_model');
		$this->load->model('traza_model');
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{

		if (!$this->ion_auth->logged_in()) {
			// redirect them to the login page
			redirect('auth/login', 'refresh');
		} else if ($this->ion_auth->logged_in() &&  !$this->ion_auth->is_admin()) // remove this elseif if you want to enable this for non-admins
		{
			$i = $this->Ion_auth_model->user()->row()->id;
			$grupo = $this->ion_auth->get_users_groups($i)->result();

			foreach ($grupo as $grupo) {
				$grupo->name;
			}

			switch ($grupo->name) {
				case 'usuario':
					redirect('invitados/index', 'refresh');
					break;
					/* case 'laboratorio':
		       redirect('ordenes_analisis/index', 'refresh');
		       break;
		  case 'produccion':
	           redirect('produccion/index', 'refresh');
		       break;
		  case 'directivos':
		       redirect('directivos/index', 'refresh');
		       break;*/
			}
		} else {
			$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$data['success_message'] = $this->session->flashdata('success_message');
			$data['uno'] = $this->tiradas_model->decUno();
			$data['dos'] = $this->tiradas_model->decDos();
			$data['tres'] = $this->tiradas_model->decTres();
			$data['cuatro'] = $this->tiradas_model->decCuatro();
			$data['cinco'] = $this->tiradas_model->decCinco();
			$data['seis'] = $this->tiradas_model->decSeis();
			$data['siete'] = $this->tiradas_model->decSiete();
			$data['ocho'] = $this->tiradas_model->decOcho();
			$data['nueve'] = $this->tiradas_model->decNueve();
			$data['diez'] = $this->tiradas_model->decDiez();
			$data['ultimasemana'] = $this->tiradas_model->ultimosietedia();
			$data['notificar'] = $this->tiradas_model->notificar();
			$this->load->view('head');
			$this->load->view('auth/index', $data);
			$this->load->view('footer', $data);
		}
	}


	public function validator()
	{
		$programa = $this->input->get_post('movil');
		$pro = substr($programa, 1);
		$str_split0 = str_split($pro);
		if (!is_numeric($pro) || $pro === '' || count($str_split0) != 8) {

			echo '<ul id="parsley-6162543515633451" class="parsley-error-list"><li class="required" style="display: list-item;">El valor del carnet de identidad no es valido.</li></ul>';
		}
	}


	/**
	 * Log the user in
	 */
	public function login()
	{
		$this->data['title'] = $this->lang->line('login_heading');

		// validate form input
		$this->form_validation->set_rules('identity', str_replace(':', '', $this->lang->line('login_identity_label')), 'required');
		$this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');

		if ($this->form_validation->run() === TRUE) {
			// check to see if the user is logging in
			// check for "remember me"
			$remember = (bool)$this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
				//if the login is successful
				//redirect them back to the home page
				//	$this->session->set_flashdata('success_message', $this->ion_auth->messages());
				$this->system_logs->create_log(1, null);
				redirect('/', 'refresh');
			} else {
				// if the login was un-successful
				// redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->system_logs->create_log(1, null);
				redirect('auth/login', 'refresh'); // use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		} else {
			// the user is not logging in so display the login page
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			];

			$this->data['password'] = [
				'name' => 'password',
				'id' => 'password',
				'class' => 'form-control',
				'type' => 'password',
			];

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'login', $this->data);
		}
	}

	/**
	 * Log the user out
	 */
	public function logout()
	{
		$this->data['title'] = "Logout";
		$this->system_logs->create_log(2, null);
		// log the user out
		$this->ion_auth->logout();

		// redirect them to the login page
		$this->session->set_flashdata('success_message', $this->ion_auth->messages());
		redirect('auth/login', 'refresh');
	}

	/**
	 * Change password
	 */
	public function change_password()
	{
		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

		if (!$this->ion_auth->logged_in()) {
			redirect('auth/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();
		$data['url'] = $this->input->post('url');
		if ($this->form_validation->run() === FALSE) {
			// display the form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = [
				'name' => 'old',
				'id' => 'old',
				'type' => 'password',
			];
			$this->data['new_password'] = [
				'name' => 'new',
				'id' => 'new',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			];
			$this->data['new_password_confirm'] = [
				'name' => 'new_confirm',
				'id' => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
			];
			$this->data['user_id'] = [
				'name' => 'user_id',
				'id' => 'user_id',
				'type' => 'hidden',
				'value' => $user->id,
			];
			$usuario = $this->ion_auth->user()->row();
			$this->data['roll'] = $this->ion_auth->get_users_groups($usuario->id)->result();
			$this->data['users'] = $this->ion_auth->users()->result();
			$this->data['roles'] = $this->tiradas_model->getRoll();
			$this->session->set_flashdata('message', 'Error,Las contraseñas deben coincidir!!!');
			redirect($data['url'], 'refresh');
		} else {
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change) {
				//if the password was successfully changed
				$this->session->set_flashdata('success_message', $this->ion_auth->messages());
				$this->system_logs->create_log(8, null);
				$this->logout();
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect($data['url'], 'refresh');
			}
		}
	}



	/**
	 * Forgot password
	 */
	public function forgot_password()
	{
		$this->data['title'] = $this->lang->line('forgot_password_heading');

		// setting validation rules by checking whether identity is username or email
		if ($this->config->item('identity', 'ion_auth') != 'email') {
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_identity_label'), 'required');
		} else {
			$this->form_validation->set_rules('identity', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
		}


		if ($this->form_validation->run() === FALSE) {
			$this->data['type'] = $this->config->item('identity', 'ion_auth');
			// setup the input
			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
			];

			if ($this->config->item('identity', 'ion_auth') != 'email') {
				$this->data['identity_label'] = $this->lang->line('forgot_password_identity_label');
			} else {
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			// set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'forgot_password', $this->data);
		} else {
			$identity_column = $this->config->item('identity', 'ion_auth');
			$identity = $this->ion_auth->where($identity_column, $this->input->post('identity'))->users()->row();

			if (empty($identity)) {

				if ($this->config->item('identity', 'ion_auth') != 'email') {
					$this->ion_auth->set_error('forgot_password_identity_not_found');
				} else {
					$this->ion_auth->set_error('forgot_password_email_not_found');
				}

				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}

			// run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten) {
				// if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("auth/login", 'refresh'); //we should display a confirmation page here instead of the login page
			} else {
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("auth/forgot_password", 'refresh');
			}
		}
	}

	/**
	 * Reset password - final step for forgotten password
	 *
	 * @param string|null $code The reset code
	 */
	public function reset_password($code = NULL)
	{
		if (!$code) {
			show_404();
		}

		$this->data['title'] = $this->lang->line('reset_password_heading');

		$user = $this->ion_auth->forgotten_password_check($code);

		if ($user) {
			// if the code is valid then display the password reset form

			$this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[new_confirm]');
			$this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

			if ($this->form_validation->run() === FALSE) {
				// display the form

				// set the flash data error message if there is one
				$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

				$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
				$this->data['new_password'] = [
					'name' => 'new',
					'id' => 'new',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['new_password_confirm'] = [
					'name' => 'new_confirm',
					'id' => 'new_confirm',
					'type' => 'password',
					'pattern' => '^.{' . $this->data['min_password_length'] . '}.*$',
				];
				$this->data['user_id'] = [
					'name' => 'user_id',
					'id' => 'user_id',
					'type' => 'hidden',
					'value' => $user->id,
				];
				$this->data['csrf'] = $this->_get_csrf_nonce();
				$this->data['code'] = $code;

				// render
				$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'reset_password', $this->data);
			} else {
				$identity = $user->{$this->config->item('identity', 'ion_auth')};

				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $user->id != $this->input->post('user_id')) {

					// something fishy might be up
					$this->ion_auth->clear_forgotten_password_code($identity);

					show_error($this->lang->line('error_csrf'));
				} else {
					// finally change the password
					$change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

					if ($change) {
						// if the password was successfully changed
						$this->session->set_flashdata('message', $this->ion_auth->messages());
						redirect("auth/login", 'refresh');
					} else {
						$this->session->set_flashdata('message', $this->ion_auth->errors());
						redirect('auth/reset_password/' . $code, 'refresh');
					}
				}
			}
		} else {
			// if the code is invalid then send them back to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id, $code = FALSE)
	{
		$activation = FALSE;

		if ($code !== FALSE) {
			$activation = $this->ion_auth->activate($id, $code);
		} else if ($this->ion_auth->is_admin()) {
			$activation = $this->ion_auth->activate($id);
		}

		if ($activation) {
			// redirect them to the auth page
			$this->session->set_flashdata('success_message', 'Usuario activado satisfactoriamente');
			$this->system_logs->create_log(4, null);
			redirect("auth/usuarios", 'refresh');
		} else {
			// redirect them to the forgot password page
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect("auth/forgot_password", 'refresh');
		}
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}

		$id = (int)$id;

		$this->load->library('form_validation');
		$this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
		$this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

		if ($this->form_validation->run() === FALSE) {
			// insert csrf check
			$this->data['csrf'] = $this->_get_csrf_nonce();
			$this->data['user'] = $this->ion_auth->user($id)->row();

			$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'deactivate_user', $this->data);
		} else {
			// do we really want to deactivate?
			if ($this->input->post('confirm') == 'yes') {
				// do we have a valid request?
				if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
					show_error($this->lang->line('error_csrf'));
				}

				// do we have the right userlevel?
				if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
					$this->ion_auth->deactivate($id);
				}
			}

			// redirect them back to the auth page
			$this->session->set_flashdata('success_message', 'Usuario desactivado satisfactoriamente');
			$this->system_logs->create_log(5, null);
			redirect('auth/usuarios', 'refresh');
		}
	}

	/**
	 * Create a new user
	 */
	public function create_user()
	{


		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$email = strtolower($this->input->post('email'));
		$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
		$password = "12345678";

		$additional_data = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone' => $this->input->post('phone'),
		];
		$email1 = $this->input->post('email');
		$row = $this->ion_auth->obtenerEmail($email1);
		if (count($row) > 0) {

			$this->session->set_flashdata('message', 'Ya existe una cuenta  registrada con el email ' . $email);
			redirect('auth/usuarios', refresh);
		} else {

			$this->ion_auth->register($identity, $password, $email, $additional_data);
			$this->session->set_flashdata('success_message', 'Cuenta creada exitosamente');
			$this->system_logs->create_log(3, null);
			redirect("auth/usuarios", 'refresh');
		}
	}
	/**
	 * Redirect a user checking if is admin
	 */
	public function redirectUser()
	{
		if ($this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}
		redirect('/', 'refresh');
	}


	/**
	 * Edit a user
	 *
	 * @param int|string $id
	 */

	public function edit_user($id)
	{
		$this->data['title'] = $this->lang->line('edit_user_heading');

		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id))) {
			redirect('auth', 'refresh');
		}

		$user = $this->ion_auth->user($id)->row();
		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result();

		//USAGE NOTE - you can do more complicated queries like this
		//$groups = $this->ion_auth->where(['field' => 'value'])->groups()->result_array();


		// validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'trim|required');
		$this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'trim|required');
		$this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'trim|required');
		$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'trim|required');

		if (isset($_POST) && !empty($_POST)) {
			// do we have a valid request?
			if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id')) {
				show_error($this->lang->line('error_csrf'));
			}

			// update the password if it was posted
			if ($this->input->post('password')) {
				$this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|matches[password_confirm]');
				$this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
			}

			if ($this->form_validation->run() === TRUE) {
				$data = [
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'phone' => $this->input->post('phone'),
				];

				// update the password if it was posted
				if ($this->input->post('password')) {
					$data['password'] = $this->input->post('password');
				}

				// Only allow updating groups if user is admin
				if ($this->ion_auth->is_admin()) {
					// Update the groups user belongs to
					$this->ion_auth->remove_from_group('', $id);

					$groupData = $this->input->post('groups');
					if (isset($groupData) && !empty($groupData)) {
						foreach ($groupData as $grp) {
							$this->ion_auth->add_to_group($grp, $id);
						}
					}
				}

				// check to see if we are updating the user
				if ($this->ion_auth->update($user->id, $data)) {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('success_message', $this->ion_auth->messages());
					$this->redirectUser();
				} else {
					// redirect them back to the admin page if admin, or to the base url if non admin
					$this->session->set_flashdata('message', $this->ion_auth->errors());
					$this->redirectUser();
				}
			}
		}

		// display the edit user form
		$this->data['csrf'] = $this->_get_csrf_nonce();

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['user'] = $user;
		$this->data['groups'] = $groups;
		$this->data['currentGroups'] = $currentGroups;

		$this->data['first_name'] = [
			'name'  => 'first_name',
			'id'    => 'first_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('first_name', $user->first_name),
		];
		$this->data['last_name'] = [
			'name'  => 'last_name',
			'id'    => 'last_name',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('last_name', $user->last_name),
		];
		$this->data['company'] = [
			'name'  => 'company',
			'id'    => 'company',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('company', $user->company),
		];
		$this->data['phone'] = [
			'name'  => 'phone',
			'id'    => 'phone',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('phone', $user->phone),
		];
		$this->data['password'] = [
			'name' => 'password',
			'id'   => 'password',
			'type' => 'password'
		];
		$this->data['password_confirm'] = [
			'name' => 'password_confirm',
			'id'   => 'password_confirm',
			'type' => 'password'
		];

		$this->_render_page('auth/edit_user', $this->data);
	}

	/**
	 * Create a new group
	 */
	public function create_group()
	{
		$this->data['title'] = $this->lang->line('create_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('create_group_validation_name_label'), 'trim|required|alpha_dash');

		if ($this->form_validation->run() === TRUE) {
			$new_group_id = $this->ion_auth->create_group($this->input->post('group_name'), $this->input->post('description'));
			if ($new_group_id) {
				// check to see if we are creating the group
				// redirect them back to the admin page
				$this->session->set_flashdata('success_message', $this->ion_auth->messages());
				redirect("auth/usuarios", 'refresh');
			}
		} else {
			// display the create group form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['group_name'] = [
				'name'  => 'group_name',
				'id'    => 'group_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('group_name'),
			];
			$this->data['description'] = [
				'name'  => 'description',
				'id'    => 'description',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('description'),
			];

			$this->_render_page('auth/usuarios', $this->data);
		}
	}



	function borrar_group($id)
	{
		/*   if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
   {
   // redirect them to the home page because they must be an administrator to view this
   show_error('You must be an administrator to view this page.');
   }*/

		if ($id == 1 || $id == 2) {
			$this->session->set_flashdata('message', 'No esta permitido eliminar este grupo');
			redirect('auth/usuarios', refresh);
		} else {
			$this->ion_auth->delete_group($id);
			$this->session->set_flashdata('success_message', $this->ion_auth->messages());
			$this->system_logs->create_log(32, null);
			redirect('auth/usuarios', refresh);
		}
	}
	/**
	 * Edit a group
	 *
	 * @param int|string $id
	 */
	public function edit_group($id)
	{
		// bail if no group id given
		if (!$id || empty($id)) {
			redirect('auth', 'refresh');
		}

		$this->data['title'] = $this->lang->line('edit_group_title');

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			redirect('auth', 'refresh');
		}

		$group = $this->ion_auth->group($id)->row();

		// validate form input
		$this->form_validation->set_rules('group_name', $this->lang->line('edit_group_validation_name_label'), 'trim|required|alpha_dash');

		if (isset($_POST) && !empty($_POST)) {
			if ($this->form_validation->run() === TRUE) {
				$group_update = $this->ion_auth->update_group($id, $_POST['group_name'], [
					$_POST['group_description']
				]);

				if ($group_update) {
					$this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
				} else {
					$this->session->set_flashdata('message', $this->ion_auth->errors());
				}
				redirect("auth", 'refresh');
			}
		}

		// set the flash data error message if there is one
		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

		// pass the user to the view
		$this->data['group'] = $group;

		$readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

		$this->data['group_name'] = [
			'name'    => 'group_name',
			'id'      => 'group_name',
			'type'    => 'text',
			'value'   => $this->form_validation->set_value('group_name', $group->name),
			$readonly => $readonly,
		];
		$this->data['group_description'] = [
			'name'  => 'group_description',
			'id'    => 'group_description',
			'type'  => 'text',
			'value' => $this->form_validation->set_value('group_description', $group->description),
		];

		$this->_render_page('auth' . DIRECTORY_SEPARATOR . 'edit_group', $this->data);
	}

	/**
	 * @return array A CSRF key-value pair
	 */
	public function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return [$key => $value];
	}

	/**
	 * @return bool Whether the posted CSRF token matches
	 */
	public function _valid_csrf_nonce()
	{
		$csrfkey = $this->input->post($this->session->flashdata('csrfkey'));
		if ($csrfkey && $csrfkey === $this->session->flashdata('csrfvalue')) {
			return TRUE;
		}
		return FALSE;
	}

	function borrar_user($id)
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
		$this->ion_auth->delete_user($id);
		$this->session->set_flashdata('success_message', $this->ion_auth->messages());
		$this->system_logs->create_log(32, null);
		redirect('auth/usuarios', refresh);
	}

	public function roll_edit()
	{
		/*   if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
     {
     // redirect them to the home page because they must be an administrator to view this
     show_error('You must be an administrator to view this page.');
     }*/
		$data['rol'] = $this->input->post('roll');
		$data['id'] = $this->input->post('id_roll');

		$this->ion_auth->editar_user_Roll($data);
		$this->session->set_flashdata('success_message', 'Se ha cambiado el roll satisfactoriamente');
		$this->system_logs->create_log(7, null);
		redirect('auth/usuarios', refresh);
	}


	/**
	 * @param string     $view
	 * @param array|null $data
	 * @param bool       $returnhtml
	 *
	 * @return mixed
	 */
	public function _render_page($view, $data = NULL, $returnhtml = FALSE) //I think this makes more sense
	{

		$viewdata = (empty($data)) ? $this->data : $data;

		$view_html = $this->load->view($view, $viewdata, $returnhtml);

		// This will return html on 3rd argument being true
		if ($returnhtml) {
			return $view_html;
		}
	}



	public function usuarios()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$data['success_message'] = $this->session->flashdata('success_message');

		$data['users'] = $this->ion_auth->users()->result();
		//USAGE NOTE - you can do more complicated queries like this
		//$this->data['users'] = $this->ion_auth->where('field', 'value')->users()->result();
		$id = NULL;
		foreach ($data['users'] as $k => $user) {
			$data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
		}
		$usuario = $this->ion_auth->user()->row();
		$data['roll'] = $this->ion_auth->get_users_groups($usuario->id)->result();
		$data['roles'] = $this->ion_auth->getRoll();
		$this->load->view('head');
		$this->load->view('usuarios', $data);
		$this->load->view('footer');
	}


	public function registrarse()
	{
		$tables = $this->config->item('tables', 'ion_auth');
		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		// validate form input
		$email = strtolower($this->input->post('email'));
		$identity = ($identity_column === 'email') ? $email : $this->input->post('identity');
		$password = $this->input->post('password');
		$password_confirm = $this->input->post('password_confirm');
		if ($password !== $password_confirm) {
			$this->session->set_flashdata('message', 'Debe confirmar la misma contraseña');
			redirect('auth/login', refresh);
		}
		$additional_data = [
			'first_name' => $this->input->post('first_name'),
			'last_name' => $this->input->post('last_name'),
			'phone' => $this->input->post('phone'),
		];
		$email1 = $this->input->post('email');
		$row = $this->ion_auth->obtenerEmail($email1);
		if (count($row) > 0) {

			$this->session->set_flashdata('message', 'Ya existe una cuenta  registrada con el email ' . $email);
			redirect('auth/login', refresh);
		} else {

			$this->ion_auth->register($identity, $password, $email, $additional_data);
			$this->session->set_flashdata('message', 'Cuenta creada exitosamente');
			redirect("auth/login", 'refresh');
		}
	}

	public function perfil($id)
	{
		if (!$this->ion_auth->logged_in()) {
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
		$data['url'] = $this->input->post('url');
		$data['first_name'] = $this->input->post('first_name');
		$data['last_name'] = $this->input->post('last_name');
		$data['phone'] = $this->input->post('phone');
		$data['email'] = $this->input->post('email');
		if ($this->ion_auth->update($id, $data)) {
			// redirect them back to the admin page if admin, or to the base url if non admin

			$this->session->set_flashdata('success_message', 'Perfil actualizado satisfactoriamente');
			$this->system_logs->create_log(6, null);
			redirect($data['url'], 'refresh');
		} else {
			// redirect them back to the admin page if admin, or to the base url if non admin
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect($data['url'], 'refresh');
		}
	}



	public function trazas()
	{
		$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$data['success_message'] = $this->session->flashdata('success_message');

		$data['traza'] = $this->traza_model->getData();
		$this->load->view('head');
		$this->load->view('trazas', $data);
		$this->load->view('footer');
	}
	function exportar()
	{

		$this->load->library("excel");
		$this->system_logs->create_log(33, null);
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array(
			"Fecha",
			"Nombre", "Apellidos", "Email", "Acción",
			"Ip"
		);

		$column = 0;

		foreach ($table_columns as $field) {
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$employee_data = $this->traza_model->getData();

		$excel_row = 2;

		foreach ($employee_data as $row) {
			$obtenerUser = $this->traza_model->obtenerUser($row->user_id);
			$obtener = $this->traza_model->obtenerAction($row->action);

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->date);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $obtenerUser[0]->first_name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $obtenerUser[0]->last_name);


			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $obtenerUser[0]->email);
			$object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $obtener[0]->action);
			$object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $row->ip);





			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="trazas.xls"');
		$object_writer->save('php://output');
	}

	public function delete_trazas()
	{
		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
		$this->traza_model->borrar_trazas();
		$this->system_logs->create_log(34, null);
		$this->session->set_flashdata('success_message', 'Trazas de Navegación eliminadas saticfactoriamente');
		redirect('auth/trazas', 'refresh');
	}

	function exportar_user()
	{

		$this->load->library("excel");
		$this->system_logs->create_log(35, null);
		$object = new PHPExcel();

		$object->setActiveSheetIndex(0);

		$table_columns = array("Nombre", "Apellidos", "Email", "Teléfono");

		$column = 0;

		foreach ($table_columns as $field) {
			$object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
			$column++;
		}

		$employee_data = $this->ion_auth->users()->result();
		$excel_row = 2;

		foreach ($employee_data as $row) {

			$object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $row->first_name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $row->last_name);
			$object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $row->email);
			$object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $row->phone);





			$excel_row++;
		}

		$object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="usuarios.xls"');
		$object_writer->save('php://output');
	}
}
