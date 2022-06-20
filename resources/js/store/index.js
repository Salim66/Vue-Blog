import axios from 'axios'

export default {
    state: {
        allCategoryItem: [],
        allPostItem: [],
        allBlogPost: [],
        singleBlogPost: '',
        allPostCategoris: [],
        latestBlogPost: []
    },
    getters: {
        allcategory(state){
            return state.allCategoryItem
        },
        allpost(state){
            return state.allPostItem
        },
        allblogpost(state){
            return state.allBlogPost
        },
        singleblogpost(state){
            return state.singleBlogPost
        },
        allPostCategory(state){
            return state.allPostCategoris
        },
        latestBlogPost(state){
            return state.latestBlogPost
        }
    },
    actions: {
        allCategory(context){
            axios.get('/all-category')
                .then((response) => {
                    context.commit('allcategory', response.data.categories)
                })
        },
        allPost(context){
            axios.get('/all-post')
                .then((response) => {
                    context.commit('allpost', response.data.posts)
                })
        },
        allBlogPost(context){
            axios.get('/all-blog-post')
                .then((response) => {
                    context.commit('allblogpost', response.data.posts)
                })
        },
        singleBlogpost(context,payload){
            axios.get('/single-blog-post/'+payload)
                .then((response) => {
                    context.commit('singleblogpost', response.data.post)
                })
        },
        allPostCategories(context){
            axios.get('/all-post-categories')
                .then((response) => {
                    context.commit('allpostcategory', response.data.categories)
                })
        },
        allPostBlogCategories(contenx,payload){
            axios.get('/categories/'+payload)
                .then((response) => {
                    contenx.commit('allgetpostcategories', response.data.posts)
                })
        },
        latestPost(context){
            axios.get('/latest-post')
                .then((response) => {
                    context.commit('latestpost', response.data.posts)
                })
        },
        realSearchByPost(context,payload){
            axios.get('/search?s='+payload)
                .then((response) => {
                    context.commit('realsearchbypost', response.data.posts)
                })
        }
    },
    mutations: {
        allcategory(state,payload){
            return state.allCategoryItem = payload
        },
        allpost(state,payload){
            return state.allPostItem = payload
        },
        allblogpost(state,payload){
            return state.allBlogPost = payload
        },
        singleblogpost(state,payload){
            return state.singleBlogPost = payload
        },
        allpostcategory(state,payload){
            return state.allPostCategoris = payload
        },
        allgetpostcategories(state,payload){
            return state.allBlogPost = payload
        },
        latestpost(state,payload){
            return state.latestBlogPost = payload
        },
        realsearchbypost(state,payload){
            return state.allBlogPost = payload
        }
    }
}
