<script setup></script>

<template>
    <div class="container py-4 flex items-center gap-3">
        <router-link to="/" class="text-primary text-base">
            <i class="fa-solid fa-house"></i>
        </router-link>
        <span class="text-sm text-gray-400">
            <i class="fa-solid fa-chevron-right"></i>
        </span>
        <p class="text-gray-600 font-medium">Cart</p>
    </div>

    <div class="container grid grid-cols-12 items-start gap-6 pt-4 pb-16">
        <!-- wishlist -->
        <div class="col-span-8 space-y-4">
            <div class="flex items-center justify-between border gap-6 p-4 border-gray-200 rounded">
                <div class="w-28">
                    <img src="../assets/images/products/product6.jpg" alt="product 6" class="w-full" />
                </div>
                <div class="w-1/3">
                    <h2 class="text-gray-800 text-xl font-medium uppercase">
                        Italian L shape
                    </h2>
                    <p class="text-gray-500 text-sm">
                        Availability: <span class="text-green-600">In Stock</span>
                    </p>
                </div>
                <div class="text-primary text-lg font-semibold">$320.00</div>
                <a href="#"
                    class="px-6 py-2 text-center text-sm text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">add
                    to cart</a>

                <div class="text-gray-600 cursor-pointer hover:text-primary">
                    <i class="fa-solid fa-trash"></i>
                </div>
            </div>
        </div>
        <div class="col-span-4">
            <div class="p-4 border rounded">
                <h2 class="text-gray-800 text-xl font-medium uppercase">
                    Order Summary
                </h2>

                <div class="flex justify-between my-4">
                    <h3 class="text-xl font-bold">Total</h3>
                    <h3 class="text-xl font-bold text-teal-600"></h3>
                </div>
                <hr />

                <h3 class="font-semibold mb-4 mt-3">Choose your payment method</h3>
                <label class="block"><input type="radio" value="cards" /> Credit Cards</label>
                <label class="block"><input type="radio" value="wallet" /> Wallet</label>
                <label class="block"><input type="radio" value="points" /> Points</label>
                <label class="block"><input type="radio" value="cash" /> Cash on Delivery</label>

                <hr class="my-5" />
                <router-link :to="'/checkout/'"
                    class="block w-full py-3 px-4 text-center text-white bg-primary border border-primary rounded-md hover:bg-transparent hover:text-primary transition font-medium">Place
                    order</router-link>
            </div>
        </div>
        <!-- ./wishlist -->
    </div>
</template>
