<template>
    <div>
        <div class="row d-flex justify-content-center">
            <div class="col-8">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Post</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" @submit.prevent="updatePost()" enctype="multipart/form-data">
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
                        <select class="form-control" v-model="form.cat_id" name="cat_name" :class="{ 'is-invalid': form.errors.has('cat_name') }">
                          <option disabled value="">Select One</option>
                          <option :value="category.id" v-for="category in allCategory" :key="category.id">{{ category.cat_name }}</option>
                        </select>
                        <has-error :form="form" field="cat_name"></has-error>
                    </div>
                    <div class="form-group">
                        <label>Photo</label><br>
                        <input name="photo" type="file" @change="changePhoto($event)">
                        <img :src="uploadImage()" alt="" width="100" height="100">
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
    created() {
        axios.get(`/edit-post/${this.$route.params.id}`)
            .then((response) => {
                this.form.fill(response.data.post)
            })
    },
    computed: {
        allCategory(){
            return this.$store.getters.allcategory
        },

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
        updatePost(){
            this.form.post(`/update-post/${this.$route.params.id}`)
                .then((response) =>{
                    this.$router.push('/post-list')
                     Toast.fire({
                        icon: 'success',
                        title: 'Post updated successfully ):'
                    })
                })
        },
        uploadImage(){
            const image = this.form.photo
            if(image.length > 100){
                return this.form.photo
            }else{
                return 'uploadimage/'+image
            }
        }
    },
}
</script>
