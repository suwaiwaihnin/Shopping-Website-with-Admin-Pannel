<template>
    <Master>
        <template slot="header">
            All Category
        </template>
        <template slot="body">
            <inertia-link class="btn btn-sm btn-primary" href='/admin/product/create'>Create</inertia-link>
            <table class='table'>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in product.data" :key="c.id">
                        <td>{{c.name}}</td>
                        <td>{{c.price}}</td>
                        <td><img :src="`/${c.image}`" alt="product" width="50px" style="border-radius:30px"></td>
                        <td>
                            <inertia-link :href='`/admin/product/${c.id}`' class="badge badge-success">Detail</inertia-link>
                            <inertia-link :href='`/admin/product/${c.id}/edit`' class="badge badge-primary">Edit</inertia-link>
                            <span @click="destroy(c.id)" class="badge badge-danger">Delete</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data='product.links'/>
        </template>
    </Master>
</template>

<script>
import Master from '../Master.vue'
import Pagination from '../Share/Pagination.vue'
export default {
    name: 'Index',
    components: {Master, Pagination},
    props:{product: Object },
    methods:{
        destroy(id){
            if(confirm('Delete Sure?')){
                const data ={id,_method:'DELETE'};
                this.$inertia.delete('/admin/product/'+id,data);
            }
        }
    }
}
</script>
