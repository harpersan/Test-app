<template>
  <div class="flex">


    <div class="mx-auto mt-6 pt-4 w-1/4">
        <h3 class="text-xl mb-5">Add User</h3>
        <div class='flex flex-wrap -mx-3 mb-6'>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Full Name</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('name')"></label>
                <input @input="errors.clear('name')" v-model="post.name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='email' placeholder='Enter email'>
            </div>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>email address</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('email')"></label>
                <input @input="errors.clear('email')" v-model="post.email" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='email' placeholder='Enter email'>
            </div>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Role</label>
                <select v-model="post.role_id" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500'>
                    <option v-for="(role,i) in roleList"  :value="role.id"  :key="i">{{ role.name }}</option>
                </select>
            </div>
            <div class='w-full md:w-full px-3 mb-3'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Password</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('password')"></label>
                <input @input="errors.clear('password')" v-model="post.password" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='password' placeholder='Enter first name'>
            </div>
            <div class='w-full md:w-full px-3 mb-3'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Confirm Password</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('password_confirmation')"></label>
                <input @input="errors.clear('password_confirmation')" v-model="post.password_confirmation" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='password' placeholder='Enter first name'>
            </div>
        </div>
        <button @click="updateOrCreate()" class="appearance-none bg-gray-200 text-gray-900 px-4 py-2 shadow-sm border border-gray-400 rounded-md mr-3" type="submit">Save</button>
        
        
        <h3 class="text-xl mt-10 mb-5">Add Role</h3>
        <div class='flex flex-wrap -mx-3 mb-6'>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Role Name</label>
                <input v-model="role.name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='email' placeholder='Enter email'>
            </div>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Description</label>
                <input v-model="role.description" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='email' placeholder='Enter email'>
            </div>
        </div>
        <button @click="updateOrCreateRole()" class="appearance-none bg-gray-200 text-gray-900 px-4 py-2 shadow-sm border border-gray-400 rounded-md mr-3" type="submit">Save</button>
    </div>



    <div class="w-1/2">
        <div>
            <h3 class="text-xl mt-10 mb-5">User List</h3>
            <div class="flex justify-between font-bold">
                <p>id</p>
                <p>Full Name</p>
                <p>Email</p>
                <p>Role</p>
                <p>Action</p>
            </div>
            <div v-for="(user,index) in userList" :key="index" class="flex justify-between">
                <p>{{ user.id }}</p>
                <p>{{ user.name }}</p>
                <p>{{ user.email }}</p>
                <p>{{ user.role ?  user.role.name : ''}}</p>
                <div class="cursor-pointer">
                    <span class="text-green-500 mr-3" @click="edit(user)">Edit</span>
                    <span class="text-red-500" @click="detete(user.id)">Delete</span>
                </div>
            </div>
        </div>

        <div class="mt-10">
            <h3 class="text-xl mt-10 mb-5">Role List</h3>
            <div class="flex justify-between font-bold">
                <p>id</p>
                <p>Name</p>
                <p>Description</p>
                <p>Action</p>
            </div>
            <div v-for="(role,ii) in roleList" :key="ii" class="flex justify-between">
                <p>{{ role.id }}</p>
                <p>{{ role.name }}</p>
                <p>{{ role.description }}</p>
                <div class="cursor-pointer">
                    <span class="text-green-500 mr-3" @click="editRole(role)">Edit</span>
                    <span class="text-red-500" @click="deteteRole(role.id)">Delete</span>
                </div>
            </div>
        </div>
    </div>

  </div>
</template>

<script>

  class Errors {
    constructor() {
      this.errors = {};
    }
    get(field) {
      if (this.errors[field]) {
        return this.errors[field][0];
      }
    }
    save(errors) {
      this.errors = errors;
    }
    clear(field) {
      delete this.errors[field];
    }
  }
import axios from 'axios'
export default {
    props: ['userlist', 'rolelist'],
    data() {
        return {
            userList: this.userlist,
            roleList: this.rolelist,
            errors: new Errors(),
            post: {
                email: '',
                password: '',
                name: '',
                password_confirmation: '',
                role_id: ''
            },
            role: {
                name: '',
                description: ''
            },
            formData: null
        };
    },
    methods: {
        updateOrCreate(){
            this.formData = new FormData;
            this.formData.append('email', this.post.email);
            this.formData.append('password', this.post.password);
            this.formData.append('password_confirmation', this.post.password_confirmation);
            this.formData.append('name', this.post.name);
            this.formData.append('role_id', this.post.role_id);
            this.formData.append('id', this.post.id ? this.post.id : null);
            axios.post('/create-update-user', this.formData)
            .then(() => {
                this.post = {}
                this.updateListUser();
            })
            .catch(error => {
                if (error.response.status == 422) {
                    this.errors.save(error.response.data.errors);
                }
            })
        },
        edit(data){
            this.post = data;
        },
        detete(userId){
            let result = confirm("Want to delete User?");
            if (result) {
                axios.post('/delete', { id : userId })
                .then(() => {
                    this.updateListUser();
                })
            }
        },
        updateListUser() {
            axios.get('/update-list-user')
            .then(response => {
                this.userList = response.data;
            })
        },
        updateListRole() {
            axios.get('/update-list-role')
            .then(response => {
                this.roleList = response.data;
            })
        },
        updateOrCreateRole(){
            this.formData = new FormData;
            this.formData.append('name', this.role.name);
            this.formData.append('description', this.role.description);
            this.formData.append('id', this.role.id ? this.role.id : null);
            axios.post('/create-update-role', this.formData)
            .then(() => {
                this.role = {}
                this.updateListRole();
            })
            .catch(error => {
                if (error.response.status == 422) {
                    this.errors.save(error.response.data.errors);
                }
            })
        },
        editRole(data){
            this.role = data;
        },
        deteteRole(roleId){
            let result = confirm("Want to delete Role?");
            if (result) {
                axios.post('/delete-role', { id : roleId })
                .then(() => {
                    this.updateListRole();
                })
            }
        },
    }

}
</script>

<style>

</style>