<template>
    <div class="container mt-4">
        <section class="main-wrapper">
            <!-- Single Product - {{  route.params.id }} -->
            <div class="mt-5" v-for="pro in product" :key="pro.id">
                <div class="d-flex align-items-center gap-4">
                    <div class="product-img">
                        <img :src="pro.image" :alt="pro.title">
                    </div>
                    <div>
                        <h4>{{ pro.title }}</h4>
                        <div class="d-flex gap-2 my-3 align-items-center">
                            <label class="mb-0">Price:</label>
                            <p class="mb-0">
                                <b>{{ pro.price }} $</b>
                            </p>
                        </div>
                        <div class="d-flex gap-2 my-3 align-items-center">
                            <label class="mb-0">Category:</label>
                            <p class="mb-0">
                                <b>{{ pro.category }}</b>
                            </p>
                        </div>
                        <div class="d-flex gap-2 my-3 align-items-center">
                            <label class="mb-0">Colors:</label>
                            <p class="mb-0" v-for="(col, i) in pro.colors" :key="col.i">
                                <b>{{ col }},</b>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';

import products from '../data/products.json';

const route = useRoute();
const product = ref([]);

onMounted(() => {
    product.value = products.filter(pro => pro.id == route.params.id)
})

</script>

<style scoped>

</style>