import {EditProjectController} from '../../../dialogs/edit-project/edit-project.dialog.js';

class ProjectsController{
    constructor($mdDialog, $mdMedia, $mdToast, API, $state, $document, DialogService){
        'ngInject';

        this.mdDialog = $mdDialog;
        this.mdMedia = $mdMedia;
        this.mdToast = $mdToast;
        this.API = API;
        this.document = $document;

        //DIALOG SERVICES
        this.DialogService = DialogService;

        this.state = $state;
    }

    $onInit(){
        
    }

    getProjects() {
        this.API.all('projects').get('').then((response) => {
            this.projects = response.projects;
        });
    }

    showAddDialog(ev) {
        var useFullScreen = (this.mdMedia('sm') || this.mdMedia('xs'))  && this.customFullscreen;
        this.mdDialog.show({
          controller: ProjectsController,
          controllerAs: 'vm',
          templateUrl: './views/app/components/projects/project-add-dialog.tmpl.html',
          parent: angular.element(this.document.body),
          targetEvent: ev,
          clickOutsideToClose:true,
          fullscreen: useFullScreen
        });
    }

    showEditDialog(ev, project) {
        // var useFullScreen = (this.mdMedia('sm') || this.mdMedia('xs'))  && this.customFullscreen;
        // this.mdDialog.show({
        //   controller: EditProjectController,
        //   controllerAs: 'vm',
        //   templateUrl: './views/dialogs/edit-project/edit-project.dialog.html',
        //   parent: angular.element(this.document.body),
        //   targetEvent: ev,
        //   clickOutsideToClose:true,
        //   fullscreen: useFullScreen
        // });
        
        return this.DialogService.fromTemplate('edit-project', {
            controller: EditProjectController,
            controllerAs: 'vm',
            templateUrl: './views/dialogs/edit-project/edit-project.dialog.html',
            parent: angular.element(this.document.body),
            locals: {
                project: project
            },
            clickOutsideToClose:true
        });
    }

    hide() {
        this.mdDialog.hide();
    }

    save(project) { 
        this.API.all('projects').post('', {name: project.name}).then((data) => {
            this.getProjects();
            this.mdToast.showSimple(data.message);
            this.mdDialog.hide();
            this.state.reload();
        });
    }

    deleteProject(event, id) {
        this.API.one('projects', id).remove().then((data) => {
            this.getProjects();
            this.mdToast.showSimple(data.message);
            // this.$state.go('app');
        });
    }
}

export const ProjectsComponent = {
    templateUrl: './views/app/components/projects/projects.component.html',
    controller: ProjectsController,
    controllerAs: 'vm',
    bindings: {}
}
