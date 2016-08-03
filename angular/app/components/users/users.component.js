import {AddUsersController} from '../../../dialogs/AddUsers/AddUsers.dialog.js';
import {EditUsersController} from '../../../dialogs/EditUsers/EditUsers.dialog.js';

class UsersController{
    constructor(API, DialogService, $document, $mdToast){
        'ngInject';

        
        this.API = API;
        this.mdToast = $mdToast;

        this.DialogService = DialogService;
        this.document = $document;

        this.users = [];
    }

    $onInit(){
        this.getallUsers();

    }

    getallUsers() {
        this.API.one('users').get('').then((response) => {
            this.users = response.users;
            console.log(this.users);
        });
    }

    showEditUser(user) {
        return this.DialogService.fromTemplate('EditUsers', {
            controller: EditUsersController,
            controllerAs: 'vm',
            templateUrl: './views/dialogs/EditUsers/EditUsers.dialog.html',
            parent: angular.element(this.document.body),
            locals: {
                user: user
            },
            clickOutsideToClose:true
        }).then((response) => {
            this.$onInit();
        });
    }

    showAddUser(){
        return this.DialogService.fromTemplate('AddUsers', {
            controller: AddUsersController,
            controllerAs: 'vm',
            templateUrl: './views/dialogs/AddUsers/AddUsers.dialog.html',
            parent: angular.element(this.document.body),
            locals: {
                // scope: project
            },
            clickOutsideToClose:true
        }).then((response) => {
            this.$onInit();
        });
    }

    deleteUser(id) {
        this.API.one('users', id).remove().then((data) => {
            
            this.mdToast.showSimple(data.message).then((evt) => {
                this. $onInit();
            });
            
        });
    }
}

export const UsersComponent = {
    templateUrl: './views/app/components/users/users.component.html',
    controller: UsersController,
    controllerAs: 'vm',
    bindings: {}
}
