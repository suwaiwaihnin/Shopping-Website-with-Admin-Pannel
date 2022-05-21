<template>
    <Master>
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Login</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-show="errors.error">{{errors.error}}</div>
                <form @submit.prevent="login">
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="text" v-model="email" class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="">Enter Password</label>
                        <input type="password" v-model="password" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    Login</button>
                </form>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from '../User/Master.vue'
export default {
    name:'Login',
    components:{Master},
    props:{errors:Object},
    data(){
        return{
            loading:false,
            email:'',
            password:''
        }
    },
    methods:{
        login(){
            const data = {email:this.email, password:this.password};
            this.$inertia.post('/login',data,{
                onStart: ()=> this.loading = true,
                onFinish: ()=> this.loading = false
            })
        }
    }
}
</script>
