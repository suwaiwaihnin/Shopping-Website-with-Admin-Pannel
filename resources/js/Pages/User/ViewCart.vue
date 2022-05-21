<template>
    <Master>
        <h2>Your Cart List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody v-for="c in cart_data.data" :key="c.id">
                <tr>
                    <td>{{c.product.name}}</td>
                    <td>
                        <img :src="`/${c.product.image}`" style="width:50px;border-radius:30%">
                    </td>
                    <td>{{c.qty}}</td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-md-10">
                <Pagination :data='cart_data.links' />
            </div>
            <div class="col-md-2">
                <inertia-link href='/checkout' class="btn btn-sm btn-primary">Check Out</inertia-link>
            </div>
        </div>
    </Master>
</template>

<script>
import Master from './Master.vue'
import Pagination from '../Admin/Share/Pagination.vue'
export default {
    name: 'ViewCart',
    components:{Master,Pagination},
    props:{cart_data : Object},
}
</script>
