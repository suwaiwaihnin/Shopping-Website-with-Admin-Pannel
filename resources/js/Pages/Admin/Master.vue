<template>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <a>
                                <li class="list-group-item bg-primary text-white">
                                    Admin Management
                                </li>
                            </a>
                            <inertia-link href='/admin/dashboard'>
                                <li class="list-group-item">
                                    Dashboard
                                </li>
                             </inertia-link >
                             <inertia-link href='/admin/category'>
                                <li class="list-group-item">
                                    Category
                                </li>
                             </inertia-link >
                            <inertia-link href='/admin/product'>
                                <li class="list-group-item">
                                    Product
                                </li>
                            </inertia-link>
                            <inertia-link href='/admin/order/pending'>
                                <li class="list-group-item">
                                     Pending Order
                                </li>
                            </inertia-link>
                             <inertia-link href='/admin/order/success'>
                                <li class="list-group-item">
                                     Success Order
                                </li>
                            </inertia-link>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card-header bg-primary">
                    <h3 class="text-white">
                        <slot name="header"/>
                    </h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <slot name="body"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'Master',
    created(){
        const {success} = this.$page.props;
        if(success){
            this.$toastr.s(success);
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
