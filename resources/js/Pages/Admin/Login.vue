<template>
    <div class="row">
        <div class="col-md-4 offset-4">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form @submit.prevent="login">
                        <div class="form-group">
                            <label for="">Enter Email</label>
                            <input type="text" class="form-control" v-model="email">
                            <label for="">Enter Password</label>
                            <input type="password" class="form-control" v-model="password">
                        </div>
                        <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data(){
        return{
            email:'',
            password:'',
            loading:false
        }
    },
    methods:{
        login(){
            const data = {'email':this.email,'password':this.password};
            this.$inertia.post('/admin/login',data,{
                onStart:()=>this.loading=true,
                onFinish:() => this.loading = false
            })
        }
    },
    watch:{
        '$page.props.success' :function(value){
            this.$toastr.s(value);
        },
        '$page.props.danger' :function(value){
            this.$toastr.e(value);
        },
        '$page.props.info' :function(value){
            this.$toastr.i(value);
        }
    }
}
</script>
