import {EditMilestoneController} from '../../../dialogs/edit-milestone/edit-milestone.dialog.js';

class MilestoneController{
    constructor($mdDialog, $mdMedia, $mdToast, API, $auth, $state, $document, $log, DialogService){
        'ngInject';

        this.mdDialog = $mdDialog;
        this.mdMedia = $mdMedia;
        this.mdToast = $mdToast;
        this.document = $document;

        this.API = API;
        this.$state = $state;

        // log
        this.$log = $log;
        
        this.DialogService = DialogService;
        
    }

    $onInit() {
        this.$log.log("init");
        // this.getMilestones();
    }

    getMilestones() {
        this.API.one('milestones', this.$state.params.project_id).get('').then((response) => {
            this.milestones = response.milestones;
            this.project = response.project;

            this.loaded = true;
        });
    }

    showAddDialog(ev) {
        var useFullScreen = (this.mdMedia('sm') || this.mdMedia('xs'))  && this.customFullscreen;
        this.mdDialog.show({
          controller: MilestoneController,
          controllerAs: 'vm',
          templateUrl: './views/app/components/milestone/milestone-add-dialog.tmpl.html',
          parent: angular.element(this.document.body),
          targetEvent: ev,
          clickOutsideToClose:true,
          fullscreen: useFullScreen
        });
    }

    save(milestone) {

        var data = {};

        data.milestone_name = milestone.milestone_name;
        data.release = milestone.release.getFullYear() + "-" + (milestone.release.getMonth() + 1) + "-" + milestone.release.getDate();
        data.is_important = milestone.is_important;
        data.project_id = this.$state.params.project_id;

        this.API.all('milestones').post('', data).then((response) => {
            this.getMilestones();
            this.mdToast.showSimple(response.message);
            this.hide();
            this.$state.reload();
        });

    }

    deleteMilestone(event, id) {
        this.API.one('milestones', id).remove().then((data) => {
            this.mdToast.showSimple(data.message);
            this.getMilestones();
        });

        event.stopPropagation();
    }

    editMilestone(ev, milestone) {
        console.log(milestone);

        event.stopPropagation();

        return this.DialogService.fromTemplate('edit-milestone', {
            controller: EditMilestoneController,
            controllerAs: 'vm',
            templateUrl: './views/dialogs/edit-milestone/edit-milestone.dialog.html',
            parent: angular.element(this.document.body),
            locals: {
                milestone: milestone
            },
            clickOutsideToClose:true
        });
    }

    hide() {
        this.mdDialog.hide();
    }
}

export const MilestoneComponent = {
    templateUrl: './views/app/components/milestone/milestone.component.html',
    controller: MilestoneController,
    controllerAs: 'vm',
    bindings: {}
}
