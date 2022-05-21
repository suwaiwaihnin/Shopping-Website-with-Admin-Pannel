<template>
    <Master>
        <form @submit="checkout">
            <div class="form-group">
                <label for="">Enter Phone Number</label>
                <input type="number" class="form-control" v-model="phone">
            </div>
             <div class="form-group">
                <label for="">Enter Address</label>
                <input type="text" class="form-control" v-model="address">
            </div>
            <button type="submit" class="btn btn-primary" :disabled='loading'>
                    <div v-show="loading" class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                    </div>
                    CheckOut</button>
        </form>
    </Master>
</template>

<script>
import Master from './Master.vue'
export default {
    name: 'Checkout',
    components:{Master},
    data(){
        return{
            address: '',
            phone: '',
            loading: false
        }
    },
    methods:{
        checkout(){
            const data = {'phone':this.phone, 'address': this.address};
            this.$inertia.post('/checkout',data,{
                onStart: () => this.loading = true,
                onFinish: () => this.loading = false
            });
        }
    }
}
</script>
