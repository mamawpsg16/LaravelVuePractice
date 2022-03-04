require('./bootstrap');
window.Vue = require('vue');

import 'vue2-toast/lib/toast.css';
import Toast from 'vue2-toast';
import Vue from 'vue';
import VueRouter from 'vue-router';
import Vuelidate from 'vuelidate'
import CKEditor from '@ckeditor/ckeditor5-vue2';

Vue.use(Toast);
Vue.use(VueRouter);
Vue.use(Vuelidate)
Vue.use(CKEditor)
Vue.component('app', require('./views/App.vue').default);

const Home = Vue.component('Home', require('./views/Home.vue').default);
const Task = Vue.component('Task', require('./views/Task.vue').default);
const Department = Vue.component('Department', require('./views/Department.vue').default);
const Employee = Vue.component('Employee', require('./views/employee/Employee.vue').default);
const FizzBuzz = Vue.component('FizzBuzz',require('./views/exercises/Fizzbuzz.vue').default)
const Palindrome = Vue.component('Palindrome',require('./views/exercises/Palindrome.vue').default)
const FindMax = Vue.component('FindMax',require('./views/exercises/FindMax.vue').default)
const BubbleSort = Vue.component('BubbleSort',require('./views/exercises/BubbleSort.vue').default)
const LinearSearch = Vue.component('LinearSearch',require('./views/exercises/LinearSearch.vue').default)
const PageNotFound = Vue.component('PageNotFound',require('./views/PageNotFound.vue').default)
const OddEven = Vue.component('OddEven',require('./views/exercises/OddEven.vue').default)
const Inventory = Vue.component('Inventory',require('./views/inventory/Inventory.vue').default)
const Customer = Vue.component('Customer',require('./views/customer/Customer.vue').default)
const CustomerCreate = Vue.component('CustomerCreate',require('./views/customer/CustomerCreate.vue').default)
const CustomerRead = Vue.component('CustomerRead',require('./views/customer/CustomerRead.vue').default)


const routes = [
  { 
    path: '/', 
    component: Home,
    name:'home'
  },
  { 
    path: '/app/task', 
    component: Task,
    name:'task'
  },
  { 
    path: '/app/department', 
    component: Department,
    name:'department'
  },
  { 
    path: '/app/employee', 
    component: Employee,
    name:'employee'
  },
  { 
    path: '/app/fizzbuzz', 
    component: FizzBuzz,
    name:'fizz_buzz'
  },
  { 
    path: '/app/palindrome', 
    component: Palindrome,
    name:'palindrome'
  },
  { 
    path: '/app/find-max', 
    component: FindMax,
    name:'find_max'
  },
  { 
    path: '/app/bubble-sort', 
    component: BubbleSort,
    name:'bubble_sort'
  },
  { 
    path: '/app/linear-search', 
    component: LinearSearch,
    name:'linear_search'
  },
  { 
    path: '/app/odd-even', 
    component: OddEven,
    name:'odd_even'
  },
  { 
    path: '/app/inventory', 
    component: Inventory,
    name:'inventory'
  },
  { 
    path: '/app/customer-list', 
    component: Customer,
    name:'customer'
  },
  { 
    path: '/app/customer-create', 
    component: CustomerCreate,
    name:'customer_create'
  },
  { 
    path: '/app/customer-read', 
    component: CustomerRead,
    name:'customer_read'
  },
  { 
    path: '*', 
    component: PageNotFound,
    name:'page_not_found'
  },
  
]

const router = new VueRouter({
  routes,
  linkActiveClass: 'active',
});

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
  router
}).$mount('#app')


Vue.prototype.$modalOnHide = function() {
  $('.myModalLabel').text('');
  this.form_edit   =   false;
  this.submitStatus = null
}

Vue.prototype.$modalOnReload = function() {
  this.submitStatus = null
}

Vue.prototype.$transformToAbsolute = function (amount)
{ 
  var parse_amount     = parseFloat(amount);
  if(parse_amount < 0.00)
  {
    var absolute         =  Math.abs(parse_amount) ;
    var transform_amount = '('+this.$addCommas(absolute.toFixed(2))+')' ;
  }else
  {
    var transform_amount =  this.$addCommas(parse_amount.toFixed(2));
  }
  return transform_amount;
}

Vue.prototype.$addCommas = function (nStr)
{
  var x  = nStr.split('.');
  var x1 = x[0];
  var x2 = x.length > 1 ? '.' + x[1] : '';
  var rgx = /(\d+)(\d{3})/;
  while (rgx.test(x1)) {
    x1 = x1.replace(rgx, '$1' + ',' + '$2');
  }
    return  x1 + x2;
}

Vue.prototype.$getUrlParameter = function (sParam) {
  var sPageURL = window.location.search.substring(1),
      sURLVariables = sPageURL.split('&'),
      sParameterName,
      i;

  for (i = 0; i < sURLVariables.length; i++) {
      sParameterName = sURLVariables[i].split('=');

      if (sParameterName[0] === sParam) {
          return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
      }
  }
}

Vue.config.devtools = true
