<template>
<div class="">
    <div class="mx-auto mt-6 pt-4 w-1/4">
        <h3 class="text-xl mb-5">Register</h3>
        <div class='flex flex-wrap -mx-3 mb-6'>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Full Name</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('name')"></label>
                <input @input="errors.clear('name')" v-model="name" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='email' placeholder='Enter email'>
            </div>
            <div class='w-full md:w-full px-3 mb-6'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>email address</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('email')"></label>
                <input @input="errors.clear('email')" v-model="email" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='email' placeholder='Enter email'>
            </div>
            <div class='w-full md:w-full px-3 mb-3'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Password</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('password')"></label>
                <input @input="errors.clear('password')" v-model="password" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='password' placeholder='Enter first name'>
            </div>
            <div class='w-full md:w-full px-3 mb-3'>
                <label class='block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2' for='grid-text-1'>Confirm Password</label>
                <label class='block uppercase tracking-wide text-red-600 text-xs font-bold mb-2' v-text="errors.get('password_confirmation')"></label>
                <input @input="errors.clear('password_confirmation')" v-model="password_confirmation" class='appearance-none block w-full bg-white text-gray-700 border border-gray-400 shadow-inner rounded-md py-3 px-4 leading-tight focus:outline-none  focus:border-gray-500' id='grid-text-1' type='password' placeholder='Enter first name'>
            </div>
        </div>
        <button @click="register()" class="appearance-none bg-gray-200 text-gray-900 px-4 py-2 shadow-sm border border-gray-400 rounded-md mr-3" type="submit">Register</button>
        <br>
        <br>
        <a class="mt-4 text-blue-500 cursor-pointer" href="/login">Already have account? Login.</a>
    </div>
</div>
</template>

<script>
import axios from 'axios'


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

export default {
    data() {
        return {
            errors: new Errors(),
            email: '',
            password: '',
            name: '',
            password_confirmation: '',
            formData: new FormData
        };
    },
    methods: {
        register(){
            this.formData.append('email', this.email);
            this.formData.append('password', this.password);
            this.formData.append('password_confirmation', this.password_confirmation);
            this.formData.append('name', this.name);
            axios.post('/register', this.formData)
            .then(()=> {
                window.location.href = '/home';
            })
            .catch(error => {
                if (error.response.status == 422) {
                    this.errors.save(error.response.data.errors);
                }
            })
        }
    }
}
</script>

<style>

</style>
