import AllPeoples from './components/AllPeoples.vue';
import AddPeople from './components/AddPeople.vue';
import EditPeople from './components/EditPeople.vue';
 
export const routes = [
    {
        name: 'home',
        path: '/',
        component: AllPeoples
    },
    {
        name: 'add',
        path: '/add',
        component: AddPeople
    },
    {
        name: 'edit',
        path: '/edit/:id',
        component: EditPeople
    }
];