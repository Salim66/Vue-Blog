<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updateCategory()">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="categoryname">Category Name</label>
                        <input name="cat_name" type="text" class="form-control" id="categoryname" v-model="form.cat_name" placeholder="Category Name" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                        <has-error :form="form" field="cat_name"></has-error>
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'Edit',
    mounted() {
        axios.get(`/edit-category/${this.$route.params.id}`)
            .then((response) => {
                this.form.fill(response.data.category)
            })
    },
    data() {
        return {
            form: new Form({
                cat_name: ''
            })
        }
    },
    methods: {
        updateCategory(){
            this.form.post(`/update-category/${this.$route.params.id}`)
                .then((response) => {
                    this.$router.push('/category-list')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category updated successfully ):'
                    })
                })
        }

    },
}
</script>
