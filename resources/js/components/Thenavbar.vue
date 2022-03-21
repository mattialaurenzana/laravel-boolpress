<template>
    <div>
        <nav class="d-flex align-items-center p-4 justify-content-end">
            <button type="button" class="btn btn-outline-dark"><a href="/login">Admin</a></button>
        </nav>
    </div>
</template>

<script>
export default {

}
</script>

<style lang="scss">

    nav{
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