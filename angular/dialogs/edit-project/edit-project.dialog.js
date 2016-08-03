export class EditProjectController{
    constructor(DialogService, project, API, $state, $mdToast){
        'ngInject';

        this.project = project;
        this.DialogService = DialogService;

        this.API = API;

        this.mdToast = $mdToast;
        this.state = $state;
    }

    save(){
        //Logic here
        this.API.one('projects', this.project.id).customPUT(this.project).then((data) => {
            this.mdToast.showSimple(data.message);
            this.DialogService.hide();
        });
        // this.DialogService.hide();
    }

    cancel(){
        this.DialogService.cancel();
        this.state.reload();
    }
}

