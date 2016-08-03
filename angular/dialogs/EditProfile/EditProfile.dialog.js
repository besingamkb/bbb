export class EditProfileController{
    constructor(DialogService, profile, API, $mdToast, $state) {
        'ngInject';
        this.profile = profile;
        this.DialogService = DialogService;

        this.API = API;


        this.mdToast = $mdToast;
        this.state = $state;
    }

    save(){
        this.API.one('users', this.profile.id).customPUT(this.profile).then((data) => {
            this.mdToast.showSimple(data.message);
            this.DialogService.hide();
        });
        //Logic here
        // this.DialogService.hide();
    }

    cancel(){
        this.DialogService.cancel();
    }
}

