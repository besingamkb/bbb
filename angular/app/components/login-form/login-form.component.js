class LoginFormController {
	constructor($auth, $state, ToastService) {
		'ngInject';

		this.$auth = $auth;
		this.ToastService = ToastService;
		this.state = $state;


		if (this.$auth.isAuthenticated()) {
			this.state.go('app.projectsmilestones');
		}
	}

	showLoginLink() {
		if (this.$auth.isAuthenticated()) {
			return false;
		}

		return true;
	}

    $onInit(){
        this.email = '';
        this.password = '';
    }

	login() {
		let user = {
			email: this.email,
			password: this.password
		};

		this.$auth.login(user)
			.then((response) => {
				this.$auth.setToken(response.data);
				console.log(response);
				this.state.go('app.projectsmilestones');

				this.ToastService.show('Logged in successfully.');

			})
			.catch(this.failedLogin.bind(this));
	}

	failedLogin(response) {
		if (response.status === 422) {
			for (let error in response.data.errors) {
				return this.ToastService.error(response.data.errors[error][0]);
			}
		}
		this.ToastService.error(response.statusText);
	}
}

export const LoginFormComponent = {
	templateUrl: './views/app/components/login-form/login-form.component.html',
	controller: LoginFormController,
	controllerAs: 'vm',
	bindings: {}
}
