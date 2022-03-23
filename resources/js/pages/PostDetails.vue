<template>
  <div class="container">
    <h1 class="text-center m-3">Dettagli post</h1>
    <div class="card p-3 mt-3">
        <img :src="post.post_img" class="card-img-top" v-if="post.post_img">
        <img src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640" v-else>
        <div class="card-body d-flex flex-column justify-content-start align-items-start">
            <div class="card-text"><span class="fw-bold bolder-element">Title</span>: {{post.title}}</div>
            <div class="card-text"><span class="fw-bold bolder-element">Content</span>: {{post.content}}</div>
            <div class="card-text d-flex align-items-center" v-if="post.category"><span class="fw-bold bolder-element">Category</span>: <span class="category ms-2">{{post.category.name}}</span></div>
             <div class="card-text d-flex align-items-center" v-if="post.tags.length !==0">
                <span class="fw-bold bolder-element">Tags</span>: <span v-for="tag of post.tags" :key="tag.id" class="tag-container m-1">{{tag.name}}</span>
             </div>
        </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
export default {
  data(){
    return{
      post: {},
    }
  },
  methods: {
    async fetchDetails(){
      try{
        const resp = await axios.get('/api/posts/' + this.$route.params.post);
        this.post = resp.data;
      }catch(er){
        this.$router.replace({name:"error"});
      }
    }
  },
  mounted(){
    this.fetchDetails();
  }
}
</script>

<style lang="scss" scoped>

    .container{
      display: flex;
      flex-direction: column;
      align-items: center;
      .card{
        border: 2px solid lightgrey;
        border-radius: 30px;
        width: 500px;
        font-size: 15px;
      }
    }

    .category{
      padding: 5px;
      border-radius: 80px;
      background-color: rgb(42, 158, 179);
      color: black;
      font-size: 12px;
    }

    .tag-container{
      background-color: grey;
      color: white;
      padding: 5px;
      border-radius: 80px;
      font-size: 12px;
    }

</style>