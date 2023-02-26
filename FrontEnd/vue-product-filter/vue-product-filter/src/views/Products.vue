<template>
    <div class="container">

        <div class="row mt-5">
            <div class="col-lg-3">
                <aside>

                    <div class="px-2 py-3 mb-3 rounded border">
                        <div class="pb-3 mb-3 border-bottom">
                            <h6 class="mb-0 font-weight-bold">
                                Category
                            </h6>
                        </div>
                        <div class="ms-2">
                            <div class="form-check mb-2" v-for="(cat, index) in category" :key="index">
                                <input class="form-check-input" v-model="selectedCategory" :value="cat" type="checkbox" :id="cat" @change="filterProducts">
                                <label class="form-check-label" :for="cat">
                                    {{ cat }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <p>{{  selectedCategory  }}</p>

                    <div class="px-2 py-3 mb-3 rounded border">
                        <div class="pb-3 mb-3 border-bottom">
                            <h6 class="mb-0 font-weight-bold">
                                Color
                            </h6>
                        </div>
                        <div class="ms-2">
                            <div class="form-check mb-2" v-for="(clr, index) in colors" :key="index">
                                <input class="form-check-input" type="checkbox" v-model="selectedColor" :value="clr" :id="clr" @change="filterProducts">
                                <label class="form-check-label" :for="clr">
                                    {{ clr }}
                                </label>
                            </div>
                        </div>
                    </div>

                    <p>{{  selectedColor }}</p>

                    <div class="px-2 py-3 mb-3 rounded border">
                        <div class="pb-3 mb-3 border-bottom">
                            <h6 class="mb-0 font-weight-bold">
                                Price
                            </h6>
                        </div>
                        <div class="ms-2">

                            <div>
                                <label>Min :</label>
                                <input type="range" class="form-range" id="customRange1">
                            </div>
                            <div>
                                <label>Max :</label>
                                <input type="range" class="form-range" id="customRange2">
                            </div>
                        </div>
                    </div>

                </aside>
            </div>
            <div class="col-lg-9">
                <div class="row">
                    <div class="col-lg-4 mb-3" v-for="product in products" :key="product.id">
                        <product-item :product="product"/>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col-12">
                        <div class="p-4 rounded shadow">
                            <div class="row mb-2">
                                <div class="col-lg-2"> Print State :</div>
                                <div class="col-lg-10">
                                    <b>{{ user.name }}</b>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-lg-2"> Print Getter :</div>
                                <div class="col-lg-10">
                                    <b>{{ user.showUser }}</b>
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-lg-2"> Print Action :</div>
                                <div class="col-lg-10">
                                    <button @click="piniaAction" class=" btn btn-primary">
                                        Pinia Action
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        
    </div>
</template>

<script setup>

import { ref } from "vue";
import product from '../data/products.json'
import productItem from '../components/product-item.vue'
import { useUserStore } from '../stores/user-store'

const products = ref(product);
const baseProduct = ref(product);
const user = useUserStore();


const categoryArry = [];
let category = [];

const colorArry = [];
let colors = [];

const selectedCategory = ref([]);
const selectedColor = ref([]);

// let category = ['Wall Protection', 'Structural and Misc Steel (Fabrication)', 'Construction Clean and Final Clean', 'Elevator', 'HVAC', 'Doors, Frames & Hardware', 'Casework', 'Retaining Wall and Brick Pavers'];
// let colors = ['red', 'blue', 'green', 'yellow', 'pink', 'orange'];


products.value.forEach(element => {
    Array.from(element.category);
    Array.from(element.colors);
    categoryArry.push(element.category);
    colorArry.push(...element.colors);
    category = [...new Set(categoryArry)];
    colors = [...new Set(colorArry)];
});

const filterProducts = () => {
    products.value = baseProduct.value
    if(selectedCategory.value.length > 0) {
        products.value = baseProduct.value.filter(item => selectedCategory.value.includes(item.category));
    }

    if(selectedColor.value.length > 0) {
        if(selectedCategory.value.length > 0) {
            products.value = products.value.filter(p => p.colors.some(clr => selectedColor.value.includes(clr)));
        } else {
            products.value = baseProduct.value.filter(p => p.colors.some(clr => selectedColor.value.includes(clr)))
        }
    }
}

const piniaAction = () => {
    user.changeName();
    user.changeAge();
}


</script>

<style scoped>

</style>