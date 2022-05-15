<template>

    <div class="card">
        <div class="card-header">
            <h3 class="text-center">Create Product</h3>
        </div>
        <div class="card-body">

            <form @submit.prevent="addProduct" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" v-model="name">
                     <span v-if="allerros.name" :class="['label label-danger']">
                        {{ allerros.name[0] }}
                    </span>
                </div>
                <div class="form-group">
                    <label>Detail</label>
                    <input type="text" class="form-control" v-model="detail">
                    <span v-if="allerros.detail" :class="['label label-danger']">
                        {{ allerros.detail[0] }}
                    </span>
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
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
            
        </div>
    </div>

</template>

<script>
    export default {
         data() {
            return {
                name: '',
                detail: '',
                image: '',
                allerros: [],
            }
        },
        methods: {
            onChange(e) {
                this.image = e.target.files[0];
            },
            addProduct() {

                let data = new FormData();
                data.append('image', this.image);
                data.append('name', this.name);
                data.append('detail', this.detail);

                axios
                .post('http://localhost:8000/api/products', data , {
                    headers: {
                        'Content-Type': 'multipart/form-data',
                    },
                })
                .then((response) => {
                    this.$router.push({ name: 'Products' })
                    this.allerros = []
                })
                .catch((error) => {
                    this.allerros = error.response.data.errors;
                    console.log(error.response)
                });
            }
        }
    }
</script>
