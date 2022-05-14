<template>
    
    <div class="card">
        <div class="card-header">
            <h3 class="text-center">All Products</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Detail</th>
                    <!-- <th>Actions</th> -->
                </tr>
                </thead>
                <tbody>
                <tr v-for="product in products" :key="product.id">
                    <td>{{ product.id }}</td>
                    <td>{{ product.name }}</td>
                    <td>{{ product.detail }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <router-link 
                                    :to="{name: 'Edit', params: { id: product.id }}" 
                                    class="btn btn-success">
                                    Edit
                            </router-link>
                            <button class="btn btn-danger" 
                                    @click="deleteProduct(product.id)">
                                    Delete
                            </button>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                products: []
            }
        },
        created(){
            axios
            .get('http://localhost:8000/api/products/')
            .then(response => {
                this.products = response.data
            })
        },
        methods: {
            deleteProduct(id) { 
                axios
                .delete(`http://localhost:8000/api/products/${id}`)
                .then(response => {
                    this.products.splice(this.products.indexOf(id), 1);
                });
            }
        }
    }
</script>
