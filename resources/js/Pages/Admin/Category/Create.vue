<template>
    <Master>
        <template slot="header">
            Create Category
        </template>
        <template slot="body">
            <inertia-link class="btn btn-sm btn-dark" href='/admin/category'>Back</inertia-link>
            <form @submit.prevent="store">
                <div class="form-group">
                    <label for="">Enter Name</label>
                    <input type="text" name='name' v-model="name" class="form-control" :class="{'border-danger':errors.name}">
                    <small v-show='errors.name' class="text-danger">{{errors.name}}</small>
                </div>
                <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    Create</button>
            </form>
        </template>
    </Master>
</template>

<script>
import Master from '../Master.vue'
export default {
    name: 'CreateCategory',
    components: {Master},
    props:{errors:Object},
    data(){
        return{
            name: '',
            loading: false
        }
    },
    methods:{
        store(){
            this.loading = true;
            this.$inertia.post('/admin/category',
            {name: this.name},
            {onSuccess: ()=>{
                this.loading = false,
                this.name = ''
            },
            })
        }
    },
}
</script>
