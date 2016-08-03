class MilestoneDetailController{
    constructor($mdToast, API, $auth, $state){
        'ngInject';
        
        this.$state = $state;
        this.API = API;

        this.mdToast = $mdToast;

        this.milestone_users = {};
        this.milestone_name = {};

        this.users = {};

        this.attachUser = {};

        this.loadUsers();

                
    }

    loadUsers() {
        /**
         * Build `users` list of key/value pairs
         */
        this.API.one('users').get('').then((response) => {
            this.users = response.users.map(function (user) {
                return {
                    value: user.id,
                    display: user.name
                }
            });
        });
    }

    /**
     * initiate milestone with users
     * @return {[object]} [milestones with users]
     */
    $onInit(){
        this.API.one('milestone/detailed', this.$state.params.milestone_id).get('').then((response) => {
            this.milestone_users = response.milestone_users;
            this.milestone_name = response.milestone_name;            
        });
    }

    /**
     * Create filter function for a query string
     */
    createFilterFor(query) {
        var lowercaseQuery = angular.lowercase(query);
        return function filterFn(users) {
            return (users.display.toLowerCase().indexOf(lowercaseQuery) === 0);
        };
    }

    /**
     * Search for users... use $timeout to simulate
     * remote dataservice call.
     */
    querySearch(query) {
        return query ? this.users.filter( this.createFilterFor(query) ) : this.users;
    }

    /**
     * attach user into milestone
     */
    attachUserToMilestone(user, pivot) {
        var data = {
            user_id: user.value,
            days: pivot,
            milestone_id: this.$state.params.milestone_id
        }

        this.API.all('milestone-user').post('', data).then((response) => {
            
                this.mdToast.showSimple(response.message);
                this.$onInit();
                this.loadUsers();
        });

    }
}

export const MilestoneDetailComponent = {
    templateUrl: './views/app/components/milestone_detail/milestone_detail.component.html',
    controller: MilestoneDetailController,
    controllerAs: 'vm',
    bindings: {}
}
