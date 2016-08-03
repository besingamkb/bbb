class ProjectMilestoneReleaseController{
    constructor(){
        'ngInject';

        //
    }
}

export function ProjectMilestoneReleaseDirective(){
    return {
        controller: ProjectMilestoneReleaseController,
        link: function(scope, element, attrs, controllers){
            //
            console.log(attrs)
        }
    }
}
