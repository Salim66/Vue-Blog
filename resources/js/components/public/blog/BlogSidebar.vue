<template>
    <span id="blogsidebar">
        <div class="span4">
            <aside class="right-sidebar">
              <div class="widget">
                <form class="form-search">
                  <input @keyup="realSearch" placeholder="Type something" type="text" v-model="keyword" class="input-medium search-query">
                  <button type="submit" @click.prevent="realSearch" class="btn btn-square btn-theme">Search</button>
                </form>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Categories</h5>
                <ul class="cat">

                  <li v-for="(category,index) in allCategory" v-if="index < 5"><i class="icon-angle-right"></i><router-link :to="`/categories/${category.id}`">{{ category.cat_name }}</router-link></li>

                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Latest posts</h5>
                <ul class="recent">
                  <li v-for="(post,index) in allBlogPost" :key="post.id" v-if="index < 5">
                    <img :src="`/uploadimage/${post.photo}`" class="pull-left" alt="" width="40" height="40" />
                    <h6><router-link :to="`/single-blog/${post.id}`">{{ post.title | shortTextFormatter(30, '...') }}</router-link></h6>
                    <p>
                      {{ post.description | shortTextFormatter(100, '...') }}
                    </p>
                  </li>

                </ul>
              </div>
              <div class="widget">
                <h5 class="widgetheading">Popular tags</h5>
                <ul class="tags">
                  <li><a href="#">Web design</a></li>
                  <li><a href="#">Trends</a></li>
                  <li><a href="#">Technology</a></li>
                  <li><a href="#">Internet</a></li>
                  <li><a href="#">Tutorial</a></li>
                  <li><a href="#">Development</a></li>
                </ul>
              </div>
            </aside>
          </div>
    </span>
</template>
<script>
import _ from 'lodash'
export default {
    name: 'BlogSidebar',
    data(){
      return {
          keyword: ''
      }
    },
    mounted() {
        this.$store.dispatch('latestPost')
        this.$store.dispatch('allPostCategories')
    },
    computed: {
       allBlogPost(){
            return this.$store.getters.latestBlogPost
        },
        allCategory(){
            return this.$store.getters.allPostCategory
        }
    },
    methods: {
        // realSearch(){
        //     this.$store.dispatch('realSearchByPost',this.keyword)
        // },
        realSearch:_.debounce(function name() {
            this.$store.dispatch('realSearchByPost',this.keyword)
        }, 1000)
    },
}
</script>
