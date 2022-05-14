<template>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Create Product</h3>
        </div>
        <div class="card-body">
            <form @submit.prevent="addProduct">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="product.name">
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <input type="text" class="form-control" v-model="product.detail">
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>

</template>

<script>
    export default {
         data() {
            return {
                product: {}
            }
        },
        methods: {
            addProduct() {
                axios
                .post('http://localhost:8000/api/products',this.product)
                .then(response => (
                    this.$router.push({ name: 'Products' })
                ))
                .catch(error => console.log(error));
            }
        }
    }
</script>
