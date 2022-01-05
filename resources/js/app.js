require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


import './bootstrap'
import Vue from 'vue'
import Axios from './components/Axios'

const axios = new Vue({
  el:'#axios',
  components: {
    Axios,
  }
})