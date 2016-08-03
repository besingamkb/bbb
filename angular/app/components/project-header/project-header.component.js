class ProjectHeaderController{
    constructor($log, $auth, $state, API){
        'ngInject';

        this.state = $state;
        this.console = $log;
        this.console.log("initiate header...");

        // authenticated
        this.auth = $auth;
        
        this.isAdmin = 0;

        this.API = API;
        
        this.is_admin();
    }

    $onInit(){
        
    }

    is_admin() {
        this.API.all('isAdmin').get('').then((response) => {
            this.isAdmin = response.is_admin;
        });
    }

    logout() {
        if (this.auth.logout()) {
            this.state.go('app.login');
            this.$onInit();
        }
    }
}

export const ProjectHeaderComponent = {
    templateUrl: './views/app/components/project-header/project-header.component.html',
    controller: ProjectHeaderController,
    controllerAs: 'vm',
    bindings: {}
}
