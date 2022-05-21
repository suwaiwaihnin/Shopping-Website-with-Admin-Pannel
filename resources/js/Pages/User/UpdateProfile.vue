<template>
    <Master>
        <div class="card">
            <div class="alert alert-success" v-show="$page.props.success">{{$page.props.success}}</div>
            <div class="card-header bg-primary">
                <h3 class="text-white">Update Profile</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-danger" v-show="errors.error">{{errors.error}}</div>
                <form @submit.prevent="update">
                     <div class="form-group">
                        <label for="">Enter Name</label>
                        <input type="text" v-model="name" class="form-control" :class="{'border-danger':errors.name}">
                        <small v-show='errors.name' class="text-danger">{{errors.name}}</small>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Email</label>
                        <input type="text" v-model="email" class="form-control" :class="{'border-danger':errors.email}">
                        <small v-show='errors.email' class="text-danger">{{errors.email}}</small>
                    </div>
                    <div class="form-group">
                        <label for="">Enter Password</label>
                        <input type="password" v-model="password" class="form-control" :class="{'border-danger':errors.password}">
                        <small v-show='errors.password' class="text-danger">{{errors.password}}</small>
                    </div>
                    <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    Update</button>
                </form>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from '../User/Master.vue'
export default {
    name:'UpdateProfile',
    components:{Master},
    props:{errors:Object},
    data(){
        return{
            loading:false,
            email:'',
            name:'',
            password:''
        }
    },
    created(){
        const{name,email} = this.$page.props.auth;
        this.name = name;
        this.email = email;
    },
    methods:{
        update(){
            const data = {email:this.email, name:this.name, password:this.password};
            this.$inertia.post('/user/update',data,{
                onStart: ()=> this.loading = true,
                onFinish: ()=> this.loading = false
            })
        }
    }
}
</script>
