<template>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <router-link to="/" class="navbar-brand">WE START</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <router-link to="/" exact class="nav-link">All Courses</router-link>
                    <router-link :to="{name:'new-courses'}" class="nav-link">Add Course</router-link>
                </div>
            </div>
        </div>
    </nav>


</template>

<script setup>


</script>

<style>

    .router-link-exact-active,
    .router-link-active {
        color: #fff !important;
    }
</style>
