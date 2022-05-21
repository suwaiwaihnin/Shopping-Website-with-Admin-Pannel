<template>
    <nav aria-label="...">
        <ul class="pagination">
            <li class="page-item"
                v-for="(d,index) in data"
                :key="index"
                :class="{disabled:'d.url' == null, active: d.active}">
                <inertia-link class="page-link" :href="d.url" v-show="d.label != '&laquo; Previous' && d.label != 'Next &raquo;'">
                    {{d.label}}
                </inertia-link>
                <inertia-link class="page-link" :href="d.url" v-show="d.label == '&laquo; Previous'">
                    <i class="fa fa-angle-left"></i>
                    <span class="sr-only">Prev</span>
                </inertia-link>
                <inertia-link class="page-link" :href="d.url" v-show="d.label == 'Next &raquo;'">
                    <i class="fa fa-angle-right"></i>
                    <span class="sr-only">Next</span>
                </inertia-link>
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    name: 'Pagination',
    props:{data:Array},
}
</script>
