<template>
    <!-- categories -->
    <div class="container py-16">
        <h2 class="text-2xl font-medium text-gray-800 uppercase mb-6">shop by category</h2>
        <div class="grid grid-cols-3 gap-3">
            <div v-for="category in home_categores" :key="category.id" class="relative rounded-sm overflow-hidden group">
                <img :src="category.image" :alt="category.name" class="w-full">
                <a href="#"
                    class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center text-xl text-white font-roboto font-medium group-hover:bg-opacity-60 transition">{{  category.name }}</a>
            </div>
        </div>
    </div>
    <!-- ./categories -->

</template>

<script setup>
    import { onMounted, ref } from "vue";

    const home_categores = ref([]);

    onMounted(() => {
        getHomeCategories();
    });

    const getHomeCategories = () => {
        axios.get('/home-categories')
        .then( res => {
            home_categores.value = res.data.data;
        })
    }
</script>

<style lang="scss" scoped>

</style>