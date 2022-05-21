<template>
<div>
    <!-- Header -->
    <div class="container-fluid" id="header">
        <nav class="navbar navbar-expand-lg">
            <inertia-link class="navbar-brand text-white" href="/">MM-Shop</inertia-link>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <inertia-link class="nav-link" href="#">Home </inertia-link>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Your Order</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            User
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown" >
                            <div v-if="!$page.props.auth">
                                <inertia-link class="dropdown-item" href="/login">Login</inertia-link>
                                <inertia-link class="dropdown-item" href="/register">Register</inertia-link>
                            </div>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" v-if='$page.props.auth !== null'>Welcome {{$page.props.auth.name}}!</a>
                            <inertia-link class="dropdown-item" href="/logout" v-if="$page.props.auth !== null">Logut</inertia-link>
                        </div>
                    </li>
                    <li class="nav-item">
                        <inertia-link href='/cart' class="nav-link " tabindex="-1" aria-disabled="true">
                            Cart
                            <small class="badge badge-danger">{{$page.props.cart}}</small>
                        </inertia-link>
                    </li>
                </ul>
                <form class="form-inline" @submit.prevent="searchproduct">
                    <input class="form-control mr-sm-2" type="text" v-model="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-primary" type="submit">Search</button>
                </form>
            </div>
        </nav>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Welcome From MM-Coder Shopping Website</h1>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Praesentium
                        sequi voluptas similique sed minima rerum labore reprehenderit, illo
                        recusandae quasi tempore placeat aliquam autem, a soluta nisi totam
                        temporibus dolorem!
                    </p>
                    <div v-if="!$page.props.auth">
                        <inertia-link href="/register" class="btn btn-outline-primary">SignUp</inertia-link>
                        <inertia-link href="/login" class="btn btn-primary">Login</inertia-link>
                    </div>
                    <h1 v-if="$page.props.auth">Welcome {{$page.props.auth.name}}</h1>
                </div>
                <div class="col-md-6 text-center">
                    <img class="" src="https://wp.xpeedstudio.com/seocify/home-fifteen/wp-content/uploads/sites/27/2020/03/home17-banner-image-min.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->
    <div class="container mt-3">
        <div class="row">
            <!-- For Category and Information -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body" v-show="$page.props.auth">
                        <ul class="list-group">
                            <inertia-link href='/order/pending'>
                                <li class="list-group-item bg-dark text-white">
                                Your Pending Order List
                                </li>
                            </inertia-link>
                            <inertia-link href='/order/complete'>
                                <li class="list-group-item bg-dark text-white">
                                Your Success Order List
                                </li>
                            </inertia-link>
                            <inertia-link href='/user/update'>
                                <li class="list-group-item bg-danger text-white">
                                Your Profile Info
                                </li>
                            </inertia-link>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item bg-primary text-white">
                                All Category

                            </li>
                            <inertia-link href='/'>
                                <li class="list-group-item">
                                    All
                                </li>
                            </inertia-link>
                            <inertia-link v-for="c in $page.props.category" :key='c.id' :href='`/product/category/${c.slug}`'>
                                <li class="list-group-item">
                                    {{c.name}}
                                    <span class="badge badge-primary float-right">{{c.product_count}}</span>
                                </li>
                            </inertia-link>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <slot />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    name: 'Master',
    created(){
        const{success,error,info} = this.$page.props;
        if(success){
            this.$toastr.s(success);
        }else if(error){
            this.$toastr.e(error);
        }else if(info){
            this.$toastr.i(info);
        }
    },
    data(){
        return{
            search: '',
        }
    },
    methods:{
        searchproduct(search){
            this.$inertia.get('/product/search/'+this.search)
        }
    }
}
</script>
