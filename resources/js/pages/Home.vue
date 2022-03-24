<template>
  <div class="home">
    <div class="progress" v-if="loading">
      <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%"></div>
    </div>
    <div class="my-3 ms-3">
      <input type="text" class="form-input" placeholder="Cerca il titolo di un post" v-model="searchText" @keydown.enter="searchMethod">
    </div>
      <post-container :posts="posts" v-if="!loading"></post-container>
      <nav aria-label="Page navigation example" v-if="!loading" class="m-5">
        <ul class="pagination justify-content-center">
            <li class="page-item"><a class="page-link" @click="fetchPosts(pagination.current_page - 1,searchText)">Previous</a></li>
            <li class="page-item" v-for="page in pagination.last_page" :key="page"><a class="page-link" :class="checkPage(page)" @click="fetchPosts(page)">{{page}}</a></li>
            <li class="page-item"><a class="page-link" @click="fetchPosts(pagination.current_page + 1,searchText)">Next</a></li>
        </ul>
      </nav>
  </div>
</template>

<script>
import axios from 'axios';
import postContainer from '../components/postContainer.vue';


export default {
    components: {postContainer,},
    data() {
   return {
     searchText:"",
     loading: true,
     posts:[],
     pagination: {},
   }
 },
 methods: {

   async fetchPosts(page = 1,searchText = null){ //di default è sempre la prima pagina

      if(page < 1){
        page = 1;
      }

      if(page > this.pagination.last_page){
        page = this.pagination.last_page;
      }

      const resp = await axios.get('http://127.0.0.1:8000/api/posts',
                    {params: {
                      page,
                      filter: searchText,
                    }}); 
        this.pagination = resp.data;
        this.posts = resp.data.data;
        this.loading = false; //setto la variabile a false, indicando che il caricamento è finito
      },
      checkPage(page){
        if(page === this.pagination.current_page){
          return 'active';
        }
      },
      
    searchMethod(){
      this.fetchPosts(1,this.searchText);
    },
   },

 mounted(){
   this.fetchPosts();
 }
}
</script>

<style lang="scss" scoped>

     .progress{
        margin: 250px auto;
        width: 60%;
   }
   
  
</style>