<template>
    <div>
        <div class="title-container p-3 d-flex align-items-center justify-content-center fw-bold">
            <h1>Lista post</h1>
        </div>
        <div class="row row-cols-1 row-cols-md-4 g-4 p-5">
            <div class="col" v-for="post of posts" :key="post.id">
                <div class="card p-2">
                    <img v-if="post.post_img" :src="post.post_img" class="card-img-top" alt="...">
                    <img v-else src="https://socialistmodernism.com/wp-content/uploads/2017/07/placeholder-image.png?w=640" alt="">
                    <div class="card-body">
                        <h4 class="card-title">{{post.title}}</h4>
                        <p class="card-text">{{post.content}}</p>
                        <p class="card-text">Data di creazione: {{formatDate(post.created_at)}}</p>
                        <p class="card-text">Category: {{post.category.name}}</p>
                        <p class="card-text" v-if="post.tags.length !== 0">
                            Tags: <span v-for="tag of post.tags" :key="tag.id" class="tag-container m-2">{{tag.name}}</span>
                        </p>
                        <span class="card-text">User: {{post.user.name}}</span>
                        <div class="card-text">Email: {{post.user.email}}</div>
                        <div class="card-footer d-flex justify-content-end">
                            <a href="">Dettagli</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</template>

<script>
import dayjs from 'dayjs';
export default {
    props: {
        posts: Array
    },
    methods: {
        formatDate(date){
            return dayjs(date).format("DD/MM/YYYY");
        }
    }
}
</script>

<style lang="scss">

    .title-container{
        height: 50px;
        background-color: black;
        color: white;
    }
    .card {
        height: 550px;
        font-size: 12px;
        
        img{
            width: 100%;
            height: 300px;
        }

        .card-body{
            position: relative;

        }
    }

    .tag-container{
        background-color: grey;
        color: white;
        padding: 10px;
        border-radius: 40px;
    }
</style>