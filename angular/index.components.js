import {UsersComponent} from './app/components/users/users.component';
import {ProfileComponent} from './app/components/profile/profile.component';
import {ProjectHeaderComponent} from './app/components/project-header/project-header.component';
import {MilestoneDetailComponent} from './app/components/milestone_detail/milestone_detail.component';
import {MilestoneComponent} from './app/components/milestone/milestone.component';
import {ProjectsComponent} from './app/components/projects/projects.component';
import {ProjectsmilestonesComponent} from './app/components/projectsmilestones/projectsmilestones.component';
import {ResetPasswordComponent} from './app/components/reset-password/reset-password.component';
import {ForgotPasswordComponent} from './app/components/forgot-password/forgot-password.component';
import {LoginFormComponent} from './app/components/login-form/login-form.component';
import {RegisterFormComponent} from './app/components/register-form/register-form.component';

angular.module('app.components')
	.component('users', UsersComponent)
	.component('profile', ProfileComponent)
	.component('projectHeader', ProjectHeaderComponent)
	.component('milestoneDetail', MilestoneDetailComponent)
	.component('milestone', MilestoneComponent)
	.component('projects', ProjectsComponent)
	.component('projectsmilestones', ProjectsmilestonesComponent)
	.component('resetPassword', ResetPasswordComponent)
	.component('forgotPassword', ForgotPasswordComponent)
	.component('loginForm', LoginFormComponent)
	.component('registerForm', RegisterFormComponent);

