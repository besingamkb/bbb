export function RoutesConfig($stateProvider, $urlRouterProvider) {
	'ngInject';

	let getView = (viewName) => {
		return `./views/app/pages/${viewName}/${viewName}.page.html`;
	};

	$urlRouterProvider.otherwise('/');

	$stateProvider
		.state('app', {
			abstract: true,
            data: {},//{auth: true} would require JWT auth
			views: {
				header: {
					templateUrl: getView('header')
				},
				footer: {
					templateUrl: getView('footer')
				},
				main: {}
			}
		})
		.state('app.projectsmilestones', {
            url: '/',
            data: {
                auth: true
            },
            views: {
                'main@': {
                    templateUrl: getView('projectsmilestones')
                }
            }
        })
        .state('app.projects', {
            url: '/projects',
            data: {
                auth: true
            },
            views: {
                'main@': {
                    templateUrl: getView('projects')
                }
            }
        })


        /**
         * milestone
         * @type {String}
         */
        .state('app.milestone', {
            url: '/milestone/:project_id',
            data: {
                auth: true
            },
            views: {
                'main@': {
                    templateUrl: getView('milestone')
                }
            }
        })
        .state('app.milestone-detail', {
            url: '/milestone/detail/:milestone_id',
            data: {
                auth: true
            },
            views: {
                'main@': {
                    templateUrl: getView('milestone_detail')
                }
            }
        })

        /**
         * profile
         * @type {String}
         */
        .state('app.profile', {
            url: '/profile',
            data: {
                auth: true
            },
            views: {
                'main@': {
                    templateUrl: getView('profile')
                }
            }
        })

        /**
         * administrator
         */
        .state('app.users', {
            url: '/users',
            data: {
                auth: true
            },
            views: {
                'main@': {
                    templateUrl: getView('users')
                }
            }
        })


        /**
         * authentication
         * @type {String}
         */
        .state('app.login', {
			url: '/login',
			views: {
				'main@': {
					templateUrl: getView('login')
				}
			}
		})

        .state('app.register', {
            url: '/register',
            views: {
                'main@': {
                    templateUrl: getView('register')
                }
            }
        })
        .state('app.forgot_password', {
            url: '/forgot-password',
            views: {
                'main@': {
                    templateUrl: getView('forgot-password')
                }
            }
        })
        .state('app.reset_password', {
            url: '/reset-password/:email/:token',
            views: {
                'main@': {
                    templateUrl: getView('reset-password')
                }
            }
        });
}
