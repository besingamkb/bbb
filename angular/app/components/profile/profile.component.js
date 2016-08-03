import {EditProfileController} from '../../../dialogs/EditProfile/EditProfile.dialog.js';

class ProfileController{
    constructor(API, $state, Upload, $timeout, DialogService, $document, $mdToast){
        'ngInject';
        this.document = $document;

        this.API = API;
        this.state = $state;
        this.mdToast = $mdToast;

        this.profile = [];

        this.show = false;
        this.Upload = Upload;

        this.timeout = $timeout;

        this.DialogService = DialogService;
        this.loadProfile();

        this.uploadProgress = "";
    }

    $onInit(){
        this.loadProfile();
    }

    loadProfile() {
        this.API.all('profile').get('').then((response) => {
            this.profile = response.users;
            console.log(response.users)
            this.show = true;
        });
    }

    triggerUpload() {
        angular.element(document.querySelector('#changePhotoBtn')).click();
    }

    uploadFiles(file, errFiles) {
        this.f = file;
        this.errFiles = errFiles && errFiles[0];

        if (this.errFiles) {
            // console.log(this.errFiles);
            if (this.errFiles.$error == "maxSize") {
                this.mdToast.showSimple("File size is greater than " + this.errFiles.$errorParam);
            } 
            if (this.errFiles.$error == "maxHeight") {
                this.mdToast.showSimple("File height is greater than " + this.errFiles.$errorParam);
            }
        }

        if (file) {
            file.upload = this.Upload.upload({
                url: 'api/upload',
                data: {file: file}
            });

            file.upload.then((response) => {
                file.result = response.data;
                this.loadProfile();
            }, (response) => {
                if (response.status > 0) {
                    this.errorMsg = response.status + ': ' + response.data;
                    this.mdToast.showSimple(this.errorMsg);
                }
                    
            }, (evt) => {
                file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
                console.log(file.progress);
            });
        }
        // this.state.reload();
    }

    showEdit() {
        return this.DialogService.fromTemplate('EditProfile', {
            controller: EditProfileController,
            controllerAs: 'vm',
            templateUrl: './views/dialogs/EditProfile/EditProfile.dialog.html',
            parent: angular.element(this.document.body),
            locals: {
                profile: this.profile
            },
            clickOutsideToClose:true
        });
    }
}

export const ProfileComponent = {
    templateUrl: './views/app/components/profile/profile.component.html',
    controller: ProfileController,
    controllerAs: 'vm',
    bindings: {}
}
