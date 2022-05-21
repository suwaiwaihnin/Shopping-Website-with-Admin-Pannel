<template>
    <Master>
        <template slot="header">
            <span v-show="isSuccess">Success Order</span>
            <span v-show="!isSuccess">Pending Order</span>
        </template>
        <template slot="body">
            <table class='table'>
                <thead>
                    <tr>
                        <th>User</th>
                        <th>Product</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="c in order.data" :key="c.id">
                        <td>{{c.user.name}}</td>
                        <td>{{c.product.name}}</td>
                        <td>{{c.phone}}</td>
                        <td>{{c.address}}</td>
                        <td>
                            <inertia-link
                            :href='`/admin/order/success/${c.id}/`'
                            v-show="!isSuccess"
                            class="badge badge-primary">Make Success
                            </inertia-link>
                            <span class="badge badge-success" v-show="isSuccess">Success</span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <Pagination :data='order.links'/>
        </template>
    </Master>
</template>

<script>
import Master from './Master.vue'
import Pagination from './Share/Pagination.vue'
export default {
    name: 'Order',
    components: {Master, Pagination},
    computed:{
        isSuccess(){
            if(location.pathname == '/admin/order/success'){
                return true;
            }
            return false;
        }
    },
    props:{order: Object },

}
</script>
