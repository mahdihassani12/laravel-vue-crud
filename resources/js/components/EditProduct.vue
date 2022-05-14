<template>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Edit Product</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="updateProduct">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="product.name">
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <input type="text" class="form-control" v-model="product.detail">
                </div>
                <button type="submit" class="btn btn-primary">Edit</button>
            </form>
        </div>
    </div>

</template>

<script>
    export default{
        data(){
            return{
                product: {}
            }
        },
        created(){
            axios
            .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
            .then(response => {
                this.product = response.data
            })
        },
        methods: {
            updateProduct() {
                axios
                .patch(`http://localhost:8000/api/products/${this.$route.params.id}`, this.product)
                .then((res) => {
                    this.$router.push({ name: 'Products' });
                });
            }
        }
    }
</script>