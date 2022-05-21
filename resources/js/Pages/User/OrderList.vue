<template>
    <Master>
        <h2 v-show="!isCompleteState">Your Pending Order List</h2>
        <h2 v-show="isCompleteState">Your Success Order List</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Qty</th>
                </tr>
            </thead>
            <tbody v-for="c in order.data" :key="c.id">
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
            <div class="col-md-4">
                <Pagination :data='order.links' />
            </div>
        </div>
    </Master>
</template>

<script>
import Master from './Master.vue'
import Pagination from '../Admin/Share/Pagination.vue'
export default {
    name: 'OrderList',
    components:{Master,Pagination},
    props:{order : Object},
    computed:{
        isCompleteState(){
            const complete = location.pathname;
            if(complete == '/order/complete'){
                return true;
            }else{
                return false;
            }
        }
    }
}
</script>
