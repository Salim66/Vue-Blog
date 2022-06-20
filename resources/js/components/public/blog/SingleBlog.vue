<template>
    <span id="singleblog">
        <section id="inner-headline">
        <div class="container">
            <div class="row">
            <div class="span4">
                <div class="inner-heading">
                <h2>Post right sidebar</h2>
                </div>
            </div>
            <div class="span8">
                <ul class="breadcrumb">
                <li><a href="#"><i class="icon-home"></i></a><i class="icon-angle-right"></i></li>
                <li><a href="#">Blog</a><i class="icon-angle-right"></i></li>
                <li class="active">Blog post right sidebar</li>
                </ul>
            </div>
            </div>
        </div>
        </section>
        <section id="content">
        <div class="container">
            <div class="row">
            <div class="span8">
                <article>
                <div class="row">
                    <div class="span8">
                    <div class="post-image">
                        <div class="post-heading">
                        <h3><a href="#">{{ post.title }}</a></h3>
                        </div>
                        <img src="img/dummies/blog/img1.jpg" alt="" />
                    </div>
                    <p>
                        {{ post.description }}
                    </p>
                    <div class="bottom-article">
                        <ul class="meta-post">
                        <li><i class="icon-user"></i><a href="#"> {{ post.user.name }}</a></li>
                        <li><i class="icon-tags"></i><a href="#">{{ post.category.cat_name }}</a></li>
                        </ul>
                    </div>
                    </div>
                </div>
                </article>
            </div>

                <BlogSidebar/>

            </div>
        </div>
        </section>
    </span>
</template>
<script>
import BlogSidebar from './BlogSidebar'
export default {
    name: 'SingleBlog',
    components: {
        BlogSidebar
    },
    mounted() {
        this.allBlogPostLoad()
    },
    computed: {
        post(){
            return this.$store.getters.singleblogpost
        }
    },
    methods: {
        allBlogPostLoad(){
            return this.$store.dispatch('singleBlogpost',this.$route.params.id)
        }
    },
    watch: {
        $route(to,from){
            this.allBlogPostLoad()
        }
    },

}
</script>
