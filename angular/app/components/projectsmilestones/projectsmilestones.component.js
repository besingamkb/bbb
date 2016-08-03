class ProjectsmilestonesController {
    constructor(API, $auth, $state, $element, dragularService, $scope) {
        'ngInject';
        
        this.API = API;
        this.projects = [];
        this.project_milestones = [];
        this.element = $element;
        this.dragularService = dragularService;
        this.$scope = $scope;

        let elementResult = this.element[0].getElementsByClassName('dragular-milestones');

        let wrappedElementResult = angular.element(elementResult);

        console.log(this.element[0].getElementsByClassName('dragular-milestones'));

        this.dragularService(this.element[0].getElementsByClassName('dragular-milestones'), {
            scope: this.$scope
        });
    }

    $onInit() {
        this.API.all('projects').get('').then((response) => {
            this.projects = response.v1.projects;
            this.project_milestones = response.v1.project_milestones;

            // version 2
            this.all_projects = response.v2.all_projects;
            this.all_milestone_by_release = response.v2.all_milestone_by_release;
        });
    }

    $onDestroy() {
        this.$element.on('dragulardrag', function() {
            console.log("yow");
        });
    }

    projectMilestonesByRelease(release, project_id) {
        var data = [];
        
        return data;
    }

    milestoneDetailed(release, project) {
        var ret = [];
        angular.forEach(this.all_milestone_by_release, function(data, key){
            if (key == release) {
                if (data.project_id == project.id) {
                    ret.push(data);
                }
            }
        });

        console.log(ret);
    }

    dragula(release) {
        return "box-" + release.replace('-', '');
    }

    loaded(release, user_id) {
        var days = 0;
        angular.forEach(this.project_milestones, function(project_milestones, milestone_release) {
            if (milestone_release == release) {
                angular.forEach(project_milestones, function(milestones, project_id) {
                    angular.forEach(milestones, function(milestone, key) {
                        if (milestone != null && milestone.length != 0) {
                            angular.forEach(milestone, function(data, key) {
                                if (data != null && key == 'users') {
                                    angular.forEach(data, function(a) {
                                        if (a.id == user_id) {
                                            days += a.pivot.days;
                                        }
                                    });
                                }
                            });
                        }
                    });
                });
            }
        });
        
        return (days > 5) ? "overloaded" : "";
    }

    releaseDateFormat(release) {
        var monthNames = [
            "Jan", "Feb", "Mar",
            "Apr", "May", "Jun", "Jul",
            "Aug", "Sep", "Oct",
            "Nov", "Dec"
        ];

        var formatDate = new Date(release);

        var date = this.ordinalSuffix(formatDate.getDate());

        return date + " " + monthNames[formatDate.getMonth()];
        console.log(formatDate.getMonth());
    }

    ordinalSuffix(i) {
        var j = i % 10,
            k = i % 100;
        if (j == 1 && k != 11) {
            return i + "st";
        }
        if (j == 2 && k != 12) {
            return i + "nd";
        }
        if (j == 3 && k != 13) {
            return i + "rd";
        }
        return i + "th";
    }

}

export const ProjectsmilestonesComponent = {
    templateUrl: './views/app/components/projectsmilestones/projectsmilestones.component.html',
    controller: ProjectsmilestonesController,
    controllerAs: 'vm',
    bindings: {}
}
