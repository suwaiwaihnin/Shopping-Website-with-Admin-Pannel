<template>
    <Master>
        <template slot="header">
            All Category
        </template>
        <template slot="body">
            <inertia-link class="btn btn-sm btn-primary" href='/admin/category/create'>Create</inertia-link>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in category.data" :key="c.id">
                        <td>{{c.name}}</td>
                        <td>
                            <inertia-link :href='`/admin/category/${c.id}/edit`' class="badge badge-primary">Edit</inertia-link>
                            <span @click="destroy(c.id)" class="badge badge-danger">Delete</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data='category.links'/>
        </template>
    </Master>
</template>

<script>
import Master from '../Master.vue'
import Pagination from '../Share/Pagination.vue'
export default {
    name: 'Index',
    components: {Master, Pagination},
    props:{category: Object },
    methods:{
        destroy(id){
            if(confirm('Delete Sure?')){
                const data ={id,_method:'DELETE'};
                this.$inertia.delete('/admin/category/'+id,data);
            }
        }
    }
}
</script>
