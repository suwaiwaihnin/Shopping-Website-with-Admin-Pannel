<template>
    <Master>
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Register</h3>
            </div>
            <div class="card-body">
                <form @submit.prevent="register">
                    <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" v-model="name" class="form-control" :class="{'border-danger':errors.name}">
                        <small v-show='errors.name' class="text-danger">{{errors.name}}</small>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="text" v-model="email" class="form-control" :class="{'border-danger':errors.email}">
                        <small v-show='errors.name' class="text-danger">{{errors.email}}</small>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input type="password" v-model="password" class="form-control" :class="{'border-danger':errors.password}">
                        <small v-show='errors.name' class="text-danger">{{errors.password}}</small>
                    </div>
                    <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    Register</button>
                </form>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from '../User/Master.vue'
export default {
    name:'Register',
    components:{Master},
    props:{errors:Object},
    data(){
        return{
            loading:false,
            name:'',
            email:'',
            password:''
        }
    },
    methods:{
        register(){
            const data ={
                'name':this.name,
                'email':this.email,
                'password':this.password
            };
            this.$inertia.post('/register',data,{
                onStart: ()=> this.loading=true,
                onFinish: ()=> this.loading=false,
            });
        }
    }
}
</script>
