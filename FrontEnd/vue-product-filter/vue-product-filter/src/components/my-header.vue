<template>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="d-flex w-100 justify-content-between">
                    <router-link class="navbar-brand" to="/">
                        Logo
                    </router-link>
                    <div>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                            <div class="navbar-nav">
                                <router-link to="/" class="nav-link">Home</router-link>
                                <router-link to='/product' class="nav-link">Product</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<script setup></script>

<style scoped>
header nav {
    height: 70px;
}

.router-link-active,
.router-link-exact-active {
    color: var(--bs-navbar-active-color) !important;
}

</style>
