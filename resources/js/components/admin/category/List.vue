<template>
    <div id="category-list">
       <div class="row d-flex justify-content-center">
            <div class="col-10">
                <div class="card">
              <div class="card-header">
                <h3 class="card-title">Category List</h3>
                <router-link to="/add-category" class="btn btn-primary float-right">Add New Category</router-link>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>
                        <select @change="selectedDeleted" v-model="select">
                          <option value="">Select</option>
                          <option value="">Delete All</option>
                        </select><br>
                        <input type="checkbox" @click.prevent="allCategorySelect" v-model="select_all">
                        <span v-if="this.select_all == false">Check All</span>
                        <span v-else>Uncheck All</span>
                    </th>
                    <th>SL</th>
                    <th>Category Name</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                  <tr v-for="(category,index) in allCategory" :key="category.id">
                    <td>
                        <input type="checkbox" :value="category.id" v-model="selectCategoryItem">
                    </td>
                    <td>{{ index+1 }}</td>
                    <td>{{ category.cat_name }}</td>
                    <td>{{ category.status }}</td>
                    <td>{{ category.created_at | dateFormate }}</td>
                    <td>
                        <router-link :to="`/edit-category/${category.id}`" class="btn btn-info btn-sm">Edit</router-link>
                        <a href="#" class="btn btn-danger btn-sm" @click.prevent="delectCategory(category.id)">Delete</a>
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
            selectCategoryItem: [],
            select: '',
            select_all: false
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
        delectCategory(id){
            axios.get('/category-delete/'+id)
                .then((response) => {
                    this.$store.dispatch('allCategory')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category deleted successfully ):'
                    })
                })
        },
        selectedDeleted(){
            axios.get(`/selected-category-delete/${this.selectCategoryItem}`)
                .then((response) => {
                    this.selectCategoryItem = []
                    this.$store.dispatch('allCategory')
                    Toast.fire({
                        icon: 'success',
                        title: 'Category deleted successfully ):'
                    })
                })
        },
        allCategorySelect(){
            if(this.select_all == false){
                this.select_all = true
                for(var category in this.allCategory){
                    this.selectCategoryItem.push(this.allCategory[category].id)
                }
            }else{
                this.select_all = false
                this.selectCategoryItem = []
            }
        }
    },
}
</script>
