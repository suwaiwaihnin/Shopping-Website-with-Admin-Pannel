<template>
    <Master>
        <template slot="header">
            Product Detail
        </template>
        <template slot="body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <td>Category</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>View Count</td>
                        <td>Image</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{product.category.name}}</td>
                        <td>{{product.name}}</td>
                        <td>{{product.price}}</td>
                        <td>{{product.view_count}}</td>
                        <td><img :src="`/${product.image}`" width="60px" alt=""></td>
                    </tr>
                </tbody>
            </table>
            <p>{{product.description}}</p>
        </template>
    </Master>
</template>

<script>
import Master from '../Master.vue'
export default {
    name: 'ProductDetail',
    components: {Master},
    props:{product:Object},
    // mounted(){
    //     console.log(this.product)
    // }
}
</script>
