var moment = require('moment'); // require
import Vue from 'vue'
Vue.filter('dateFormate', (arg) => {
    return moment(arg).format("MMM Do YY");
})

Vue.filter('shortTextFormatter', (text,length,suffix) => {
    return text.substring(0, length)+suffix
})
