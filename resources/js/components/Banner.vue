<template>
    <div class="banner">
        <h1 class="title">Rountable Peru</h1>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Banner mounted');
    }
}
</script>

<style>
    .banner {
        background-image: url('/img/slider/slider1.jpg');
        height: 100vh;
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
    }
    .title {
        color:aliceblue;
    }
</style>
