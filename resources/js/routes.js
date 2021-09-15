import Home from './components/HomeComponent.vue'
import CourseDetails from './components/CourseDetailsComponent.vue'
import About from './components/AboutComponent.vue'
import Dashboard from './components/admin/DashboardComponent.vue'
import Profile from './components/admin/ProfileComponent.vue'
import Student from './components/admin/StudentComponent.vue'
import Educator from './components/admin/EducatorComponent.vue'

export const routes = [
    { 
        path:'/home',
        component:Home
    },
    { 
        path:'/coursedetails',
        component:CourseDetails
    },
    { 
        path:'/about',
        component:About
    },
    {
        path:'/admin/dashboard',
        component:Dashboard
    },
    {
        path:'/admin/profile',
        component:Profile
    },
    { 
        path:'/admin/student',
        component:Student
    },
    { 
        path:'/admin/educator',
        component:Educator
    },
 
 
];
