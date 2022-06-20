<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-6">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="addCategory()">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="categoryname">Category Name</label>
                        <input name="cat_name" type="text" class="form-control" id="categoryname" v-model="form.cat_name" placeholder="Category Name" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                        <has-error :form="form" field="cat_name"></has-error>
                    </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Add New</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'New',
    data() {
        return {
            form: new Form({
                cat_name: ''
            })
        }
    },
    methods: {
        addCategory(){
            this.form.post('/add-category')
                .then((response) => {
                    this.$router.push('/category-list')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category added successfully ):'
                    })
                })
        }
    },
}
</script>
