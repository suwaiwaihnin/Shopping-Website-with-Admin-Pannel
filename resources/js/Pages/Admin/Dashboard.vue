<template>
    <Master>
        <template slot="header">
            Admin Dashboard
        </template>
        <template slot="body">
            <h1>Dashboard</h1>
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-dark text-white">Category</div>
                        <h2 class="text-center">{{data.category}}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-danger text-white">Product</div>
                        <h2 class="text-center">{{data.product}}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-success text-white">Peding </div>
                        <h2 class="text-center">{{data.pending}}</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header bg-primary text-white">Success </div>
                        <h2 class="text-center">{{data.complete}}</h2>
                    </div>
                </div>
            </div>
            <h3>Latest 5 Users</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody v-for="u in data.user" :key="u.id">
                    <tr>
                        <td>{{u.name}}</td>
                        <td>{{u.email}}</td>
                    </tr>
                </tbody>
            </table>
        </template>
    </Master>
</template>

<script>
import Master from './Master.vue'
export default {
    name: 'Dashboard',
    components: {Master},
    props:{data: Object},
}
</script>
