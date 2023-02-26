<template>


    <div class="card">
        <div class="product-img">
            <img :src="product.image"
                class="card-img-top" alt="{{ product.title }}">
        </div>
        <div class="card-body">
            <h5 class="card-title">
                <router-link class="text-decoration-none text-dark" :to="{ name:'productProduct', params: {id: product.id} }">
                    {{ product.title }}
                </router-link>
            </h5>
            <div class="product-desc">
                <label class="pe-3">Price :</label>
                <span>{{ product.price }} $</span>
            </div>
            <div class="product-desc">
                <label class="pe-3">Category :</label>
                <span>{{ product.category }}</span>
            </div>
            <div class="product-colors d-flex flex-wrap gap-2 align-items-center mt-3">
                <span v-for="(color, index) in product.colors" :key="index">{{ color }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>

    const props = defineProps(['product'])

</script>

<style scoped>
.card {
    border: 0;
    box-shadow: 0 0 5px rgba(0,0,0,0.09);
    min-height: 380px;
}

.card .product-img {
    height: 200px;
}

.card .product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.card .card-title {
    font-size: 14px;
    font-weight: bold;
}

.product-desc {
    margin-bottom: 5px;
}

.product-desc label {
    font-size: 13px;
    font-weight: bold;
}


.product-colors span {
    background-color: #DDD;
    color: #000;
    padding: 3px 8px;
    font-size: 12px;
    border-radius: 5px;
    
}
</style>