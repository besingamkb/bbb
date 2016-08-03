export class EditUsersController{
    constructor(DialogService, user, API, $mdToast){
        'ngInject';

        this.DialogService = DialogService;

        this.API = API;
        this.user = user;

        this.mdToast = $mdToast;

        this.user.is_admin = (user.is_admin == 1) ? true : false;
    }

    save(user){
        this.API.one('users', user.id).customPUT(user).then((response) => {
            this.mdToast.showSimple(response.message).then((evt) => {
                this.DialogService.hide();
            });
        });
    }

    cancel(){
        this.DialogService.cancel();
    }
}

