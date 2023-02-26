<template>
   
    <section class="here-sec">
        <img src="../assets/images/bg.jpg" alt="" class="img-fluid">
        <div class="content">
            <h1> {{  user.name }} </h1>
        </div>
    </section>
</template>

<script setup>

import { useUserStore } from '../stores/user-store';

const user = useUserStore();


</script>

<style scoped>

.here-sec {
    height: calc(100vh - 70px);
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
}

.here-sec:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
}

.here-sec img {
    object-fit: cover;
    width: 100%;
    height: 100%;
}

.here-sec  .content {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    color: #FFF;
    z-index: 2;
}

.here-sec  .content h1 {
    font-size: 60px;
}

</style>