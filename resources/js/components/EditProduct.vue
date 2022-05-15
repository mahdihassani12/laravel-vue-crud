<template>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Edit Product</h3>
        </div>
        <div class="card-body">

            <form @submit.prevent="updateProduct" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="product.name">
                    <span v-if="allerros.name" :class="['label label-danger']">
                        {{ allerros.name[0] }}
                    </span>
                </div>

                <div class="form-group">
                    <label>Detail</label>
                    <input type="text" class="form-control" v-model="product.detail">
                    <span v-if="allerros.detail" :class="['label label-danger']">
                        {{ allerros.detail[0] }}
                    </span>
                </div>

                <div class="form-group">
                    <figure>
                        <img :src="product.path + product.image" />
                    </figure>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file"
                           class="form-control"
                           @change="onChange"
                        />
                    <span v-if="allerros.image" :class="['label label-danger']">
                        {{ allerros.image[0] }}
                    </span>
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
                product:{
                    name:"",
                    detail:"",
                    image:"",
                    path:"",
                },
                allerros: [],
            }
        },
        mounted(){
            this.showProduct()
        },
        methods: {
            async showProduct(){
                await axios
                .get(`http://localhost:8000/api/products/${this.$route.params.id}`)
                .then(response => {
                    const { name, detail, image, path } = response.data;
                    this.product.name = name;
                    this.product.detail = detail;
                    this.product.image = image;
                    this.product.path = path;
                })
            },
            async onChange(e) {
                this.product.image = e.target.files[0];
            },
            async updateProduct() {

                let data = new FormData();
                data.append('image', this.product.image);
                data.append('name', this.product.name);
                data.append('detail', this.product.detail);
                data.append('_method', 'PATCH');

                axios
                .post(`http://localhost:8000/api/products/${this.$route.params.id}`,data,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then((res) => {
                    this.$router.push({ name: 'Products' });
                })
                .catch((error) => {
                    console.log(error)
                })
                
            }
        }
    }
</script>

<style scope>
    img{
        width:200px;
        height: auto;
        object-fit:cover;
    }
</style>
