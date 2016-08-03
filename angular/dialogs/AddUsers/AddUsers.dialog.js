export class AddUsersController{
    constructor(DialogService, API, $mdToast){
        'ngInject';

        this.DialogService = DialogService;

        this.API = API;
        this.mdToast = $mdToast;
    }

    save(user){
        
        this.API.all('users').post(user).then((response) => {
            this.mdToast.showSimple(response.message).then((evt) => {
                this.DialogService.hide();
            });
        });
        //Logic here
        
    }

    cancel(){
        this.DialogService.cancel();
    }
}

