<template>
    <div>
        <nav class="navbar-top d-flex align-items-center p-4 justify-content-between">
            <div class="d-flex">
                <router-link v-for="route in routes" :key="route.path" class="nav-link text-light ms-2 fw-bold" :to="route.path">{{route.meta.linkText}}</router-link> 
            </div>
            
            <button type="button" class="btn btn-light"><a href="/login">Admin</a></button>
        </nav>
    </div>
</template>

<script>
export default {
    data(){
        return{
            routes: [],
        }
    },
    mounted(){
        this.routes = this.$router.getRoutes().filter((route)=>{
            if(route.name !== 'posts.show'){
                return true;
            }
        }); //vado a salvare all'interno dell'array l'insieme delle rotte registrate in router.js
        
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