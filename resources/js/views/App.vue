<template>
  <div>
      <thenavbar></thenavbar>
      <post-container :posts="posts"></post-container>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" @click="fetchPosts(pagination.current_page - 1)">Previous</a></li>
            <li class="page-item" v-for="page in pagination.last_page" :key="page"><a class="page-link" :class="checkPage(page)" @click="fetchPosts(page)">{{page}}</a></li>
            <li class="page-item"><a class="page-link" @click="fetchPosts(pagination.current_page + 1)">Next</a></li>
        </ul>
      </nav>

      
  </div>
</template>

<script>
import axios from 'axios';
import '../components/postContainer.vue';
import postContainer from '../components/postContainer.vue';
import Thenavbar from '../components/Thenavbar.vue';

export default {
 components:{
   postContainer,
   Thenavbar,
   
 },
 data() {
   return {
     posts:[],
     pagination: {},
   }
 },
 methods: {
   async fetchPosts(page = 1){ //di default è sempre la prima pagina

      if(page < 1){
        page = 1;
      }

      if(page > this.pagination.last_page){
        page = this.pagination.last_page;
      }

      const resp = await axios.get('http://127.0.0.1:8000/api/posts?page=' + page); 
        this.pagination = resp.data;
        this.posts = resp.data.data;
      },
      checkPage(page){
        if(page === this.pagination.current_page){
          return 'active';
        }
      }
   },

 mounted(){
   this.fetchPosts();
 }
}
</script>

<style lang="scss">
  @import '../../sass/app.scss';
  .active{
    background-color: rgb(34, 101, 202);
    color: white;
  }

  li{
    &:hover{
      cursor: pointer;
    }
  }
</style>