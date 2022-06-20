//Admin Home Component Import
import AdminHome from './components/admin/AdminHome.vue'

//Category Component Import
import CategoryList from './components/admin/category/List.vue'
import AddCategory from './components/admin/category/New.vue'
import EditCategory from './components/admin/category/Edit.vue'

//Post Component Import
import PostList from './components/admin/post/List.vue'
import AddPost from './components/admin/post/New.vue'
import EditPost from './components/admin/post/Edit.vue'

//Public Home Component Import
import PublicHome from './components/public/PublicHome.vue'
import BlogPost from './components/public/blog/BlogPost.vue'
import SingleBlogPost from './components/public/blog/SingleBlog.vue'

export const routes = [
    {
        path: '/home',
        component: AdminHome
    },
    //Category
    {
        path: '/category-list',
        component: CategoryList
    },
    {
        path: '/add-category',
        component: AddCategory
    },
    {
        path: '/edit-category/:id',
        component: EditCategory
    },
    //Post
    {
        path: '/post-list',
        component: PostList
    },
    {
        path: '/add-post',
        component: AddPost
    },
    {
        path: '/edit-post/:id',
        component: EditPost
    },

    //Public Home
    {
        path: '/',
        component: PublicHome
    },
    {
        path: '/blog',
        component: BlogPost
    },
    {
        path: '/single-blog/:id',
        component: SingleBlogPost
    },
    {
        path: '/categories/:id',
        component: BlogPost
    }
]
