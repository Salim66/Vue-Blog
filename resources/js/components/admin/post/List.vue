<template>
    <div id="category-list">
       <div class="row d-flex justify-content-center">
            <div class="col-12">
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Post List</h3>
                <router-link to="/add-post" class="btn btn-primary float-right">Add New Post</router-link>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>
                        <select @change="selectedDeleted" v-model="select">
                          <option value="">Select</option>
                          <option value="" >Delete All</option>
                        </select><br>
                        <input type="checkbox" @click.prevent="selectAllPost" v-model="all_post">
                        <span v-if="this.all_post==false">Check All</span>
                        <span v-else>Uncheck All</span>
                    </th>
                    <th>SL</th>
                    <th>User</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Photo</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <tr v-for="(post,index) in allPost" :key="post.id">
                    <td>
                        <input type="checkbox" :value="post.id" v-model="selectPostItem">
                    </td>
                    <td>{{ index+1 }}</td>
                    <td v-if="post.user">{{ post.user.name }}</td>
                    <td v-if="post.category">{{ post.category.cat_name }}</td>
                    <td>{{ post.title | shortTextFormatter(20, '....') }}</td>
                    <td>{{ post.description | shortTextFormatter(30, '....') }}</td>
                    <td>
                        <img :src="ourImage(post.photo)" width="40" height="40">
                    </td>
                    <td>{{ post.created_at | dateFormate }}</td>
                    <td>{{ post.status }}</td>
                    <td>
                        <router-link :to="`/edit-post/${post.id}`" class="btn btn-info btn-sm">Edit</router-link>
                        <a href="#" class="btn btn-danger btn-sm" @click.prevent="delectPost(post.id)">Delete</a>
                    </td>
                  </tr>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
       </div>
    </div>
</template>
<script>
export default {
    name: 'List',
    data(){
        return {
            selectPostItem: [],
            select: '',
            all_post: false
        }
    },
    mounted() {
        this.$store.dispatch('allPost')
    },
    computed: {
      allPost(){
          return this.$store.getters.allpost
      }
    },
    methods: {
        ourImage(image){
            return '/uploadimage/'+image
        },
        delectPost(id){
            axios.get('/delete-post/'+id)
                .then((respones) => {
                   this.$store.dispatch('allPost')
                   Toast.fire({
                        icon: 'success',
                        title: 'Post deleted successfully ):'
                    })
                })
        },
        selectedDeleted(){
           axios.get(`/selected-post-deleted/${this.selectPostItem}`)
                .then((response) => {
                   this.selectPostItem = []
                   this.$store.dispatch('allPost')
                   Toast.fire({
                        icon: 'success',
                        title: 'Post deleted successfully ):'
                    })
                })
        },
        selectAllPost(){
            if(this.all_post == false){
                this.all_post = true
                for(var post in this.allPost){
                    this.selectPostItem.push(this.allPost[post].id)

                }
            }else{
                this.all_post = false
                this.selectPostItem = []
            }
        }
    },
}
</script>
