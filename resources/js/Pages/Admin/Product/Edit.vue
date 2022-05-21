<template>
    <Master>
        <template slot="header">
            Create Product
        </template>
        <template slot="body">
            <inertia-link class="btn btn-sm btn-dark" href='/admin/product'>Back</inertia-link>
            <form @submit.prevent="store" enctype="multipart/form-data">
                <!-- For Category -->
                <div class="form-group">
                    <label for="">Choose Category</label>
                    <select class="form-control" v-model="category_id" :class="{'border-danger':errors.category_id}">
                        <option v-for="c in category" :key='c.id' :value="c.id" >{{c.name}}</option>
                    </select>
                    <small v-show='errors.category_id' class="text-danger">{{errors.category_id}}</small>
                </div>
                <div class="form-group">
                    <label for="">Enter Name</label>
                    <input
                    type="text"
                    v-model="name"
                    class="form-control"
                    :class="{'border-danger':errors.name}">
                    <small v-show='errors.name' class="text-danger">{{errors.name}}</small>
                </div>
                <div class="form-group">
                    <label for="">Enter Price</label>
                    <input
                    type="number"
                    v-model="price"
                    class="form-control"
                    :class="{'border-danger':errors.price}">
                    <small v-show='errors.price' class="text-danger">{{errors.price}}</small>
                </div>
                 <div class="form-group">
                    <label for="">Choose Image</label>
                    <input
                    type="file"
                    name='image'
                    @change="chooseImage"
                    class="form-control"
                    :class="{'border-danger':errors.image}">
                    <img :src="`/${product.image}`" alt="" width="200px">
                    <small v-show='errors.image' class="text-danger">{{errors.image}}</small>
                </div>
                 <div class="form-group">
                    <label for="">Enter Description</label>
                    <textarea
                    v-model="description"
                    class="form-control"
                    :class="{'border-danger':errors.description}"></textarea>
                    <small v-show='errors.description' class="text-danger">{{errors.description}}</small>
                </div>
                <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    Update
                </button>
            </form>
        </template>
    </Master>
</template>

<script>
import Master from '../Master.vue'
export default {
    name: 'EditProduct',
    components: {Master},
    props:{errors:Object,category:Array,product:Object},
    data(){
        return{
            category_id :'',
            name: '',
            description: '',
            image: '',
            price: '',
            loading: false
        }
    },
    created(){
        this.category_id = this.product.category_id;
        this.name = this.product.name;
        this.description = this.product.description;
        this.price = this.product.price;
    },
    methods:{
        chooseImage(e){
            this.image = e.target.files[0]
        },
        store(){
            this.loading = true;
            const data = new FormData();
            data.append('name',this.name);
            data.append('image',this.image);
            data.append('category_id',this.category_id);
            data.append('price',this.price);
            data.append('description',this.description);
            data.append('_method','PUT');
            this.$inertia.post('/admin/product/'+this.product.id,data,
            {onSuccess: ()=>
                this.loading = false,
            })
        }
    },
}
</script>

