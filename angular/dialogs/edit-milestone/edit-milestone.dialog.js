export class EditMilestoneController{
    constructor(DialogService, milestone, API, $state, $mdToast){
        'ngInject';

        this.DialogService = DialogService;

        this.milestone_before = milestone;
        this.milestone = milestone;

        this.milestone.is_important = (this.milestone.is_important == 1) ? true : false;

        this.API = API;

        this.mdToast = $mdToast;
        this.state = $state;
    }

    milestoneDate(release) {
        return new Date(release);
    }

    save(){
        this.API.one('milestones', this.milestone.id).customPUT(this.milestone).then((data) => {
            this.mdToast.showSimple(data.message);
            this.DialogService.hide();
        });
    }

    cancel(){
        this.DialogService.cancel();
        this.milestone = this.milestone_before;
    }
}
