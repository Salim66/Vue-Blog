<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Post</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="addPost()" enctype="multipart/form-data">
                    <div class="card-body">
                    <div class="form-group">
                        <label for="titlepost">Post Name</label>
                        <input name="title" type="text" class="form-control" id="titlepost" v-model="form.title" placeholder="Post Title" :class="{ 'is-invalid': form.errors.has('title') }">
                        <has-error :form="form" field="title"></has-error>
                    </div>
                    <div class="form-group">
                        <label for="titlepost">Post Description</label>
                        <markdown-editor v-model="form.description"></markdown-editor>
                        <has-error :form="form" field="description"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select class="form-control" v-model="form.cat_id" name="cat_name" :class="{ 'is-invalid': form.errors.has('title') }">
                          <option disabled value="">Select One</option>
                          <option :value="category.id" v-for="category in allCategory" :key="category.id">{{ category.cat_name }}</option>
                        </select>
                        <has-error :form="form" field="title"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Photo</label><br>
                        <input name="photo" type="file" @change="changePhoto($event)">
                        <img :src="form.photo" alt="" width="100" height="100">
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
    data(){
        return {
            form: new Form({
                title: '',
                description: '',
                cat_id: '',
                photo: ''
            })
        }
    },
    mounted() {
        this.$store.dispatch('allCategory')
    },
    computed: {
        allCategory(){
            return this.$store.getters.allcategory
        }
    },
    methods: {
        changePhoto(event){
            const file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                this.form.photo = event.target.result
                console.log(event.target.result)
            };

            reader.readAsDataURL(file);
        },
        addPost(){
            this.form.post('/add-post')
                .then((response) =>{
                    this.$router.push('/post-list')
                     Toast.fire({
                        icon: 'success',
                        title: 'Post added successfully ):'
                    })
                })
        }
    },
}
</script>
