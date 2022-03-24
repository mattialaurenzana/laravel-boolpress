<template>
    <div>
        <nav class="navbar-top d-flex align-items-center p-4 justify-content-between">
            <div class="d-flex">
                <router-link v-for="route in routes" :key="route.path" class="nav-link text-light ms-2 fw-bold" :to="route.path">{{route.meta.linkText}}</router-link> 
            </div>
            
            <button type="button" class="btn btn-light"  v-if="!user"><a href="/login">Login</a></button>
            <button type="button" class="btn d-flex align-items-center"  v-else><a href="/login" class="fw-bold">{{user.name}}<i class="fas fa-sort-down ms-2"></i></a></button>
        </nav>
    </div>
</template>

<script>
import axios from 'axios';
export default {
    data(){
        return{
            routes: [],
            user: null,
        }
    },
    methods: {
        async fetchUser(){
            try{
                const resp = await axios.get('/api/user');
                this.user = resp.data;
                localStorage.setItem("user",JSON.stringify(resp.data));  //aggiungo al local storage i dati relativi all'utente attualmente loggato
            }catch(er){
                localStorage.removeItem("user");  //quando l'utente fa il logout rimuovo dal local storage i dati relativi
            }
        }
    },
    mounted(){
        this.routes = this.$router.getRoutes().filter((route)=>{
            if(route.name !== 'posts.show'){
                return true;
            }
        }); //vado a salvare all'interno dell'array l'insieme delle rotte registrate in router.js
        
        this.fetchUser();
    }
}
</script>

<style lang="scss">

    .navbar-top{
        background-color: black;
        button{
            a:link{
                text-decoration: none;
                color: black;

            &:hover{
            color: white;
            }

            }
        }
    }
 
</style>