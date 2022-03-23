<template>
  <div>
      <thenavbar></thenavbar>
      
      <router-view></router-view> <!--componente preposto a stampare le pagine-->
      

      
  </div>
</template>

<script>
import Thenavbar from '../components/Thenavbar.vue';

export default {
 components:{
   Thenavbar,
   
 },
 
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