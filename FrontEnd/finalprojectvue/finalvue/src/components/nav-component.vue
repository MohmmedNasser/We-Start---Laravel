<template>
    <!-- navbar -->
    <nav class="bg-gray-800">
        <div class="container flex">
            <div class="px-8 py-4 bg-primary flex items-center cursor-pointer relative group">
                <span class="text-white">
                    <i class="fa-solid fa-bars"></i>
                </span>
                <span class="capitalize ml-2 text-white">All Categories</span>

                <!-- dropdown -->
                <div
                    class="absolute w-full left-0 top-full bg-white shadow-md py-3 divide-y divide-gray-300 divide-dashed opacity-0 group-hover:opacity-100 transition duration-300 invisible group-hover:visible">
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="../assets/images/icons/sofa.svg" alt="sofa" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Sofa</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="../assets/images/icons/terrace.svg" alt="terrace" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Terarce</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="../assets/images/icons/bed.svg" alt="bed" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Bed</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="../assets/images/icons/office.svg" alt="office" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">office</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="../assets/images/icons/outdoor-cafe.svg" alt="outdoor" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Outdoor</span>
                    </a>
                    <a href="#" class="flex items-center px-6 py-3 hover:bg-gray-100 transition">
                        <img src="../assets/images/icons/bed-2.svg" alt="Mattress" class="w-5 h-5 object-contain">
                        <span class="ml-6 text-gray-600 text-sm">Mattress</span>
                    </a>
                </div>
            </div>

            <div class="flex items-center justify-between flex-grow pl-12">
                <div class="flex items-center space-x-6 capitalize">
                    <router-link to="/" class="text-gray-200 hover:text-white transition">Home</router-link>
                    <router-link to="/shop" class="text-gray-200 hover:text-white transition">Shop</router-link>
                    <!-- <a href="#" class="text-gray-200 hover:text-white transition">About us</a> -->
                    <!-- <a href="#" class="text-gray-200 hover:text-white transition">Contact us</a> -->
                    <router-link to="/checkout" class="text-gray-200 hover:text-white transition">Checkout</router-link>
                </div>
                <div class="flex items-center space-x-6 capitalize">
                    <template v-if="user.user">
                        <a @click.prevent="logout" href="/logout" class="text-gray-200 hover:text-white transition">Logout</a>
                    </template>
                    <template v-else>
                        <router-link to="/login" class="text-gray-200 hover:text-white transition">Login</router-link>
                        <router-link to="/register" class="text-gray-200 hover:text-white transition">Register</router-link>
                    </template>
                    <div class="locale-changer">
                        <select v-model="$i18n.locale" @change="changeLang(this)">
                            <option  v-for="locale in $i18n.availableLocales" :key="`locale-${locale}`" :value="locale">{{ locale }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- ./navbar -->
</template>

<script setup>
    import { useUserStore } from '../stores/user';
    import { useRouter } from 'vue-router';
    import { ref } from 'vue';

    const user = useUserStore();
    const router = useRouter();
    const lang = ref('');

    const logout = () => {
        user.logOutUser();
        router.push('/');
    }

    const changeLang = (e) => {
        lang.value = e.$i18n.locale;
        localStorage.setItem('locale', e.$i18n.locale);

        // if(lang.value == 'ar') {
        //     document.querySelector('html').setAttribute('dir', 'rtl');
        // } else {
        //     document.querySelector('html').setAttribute('dir', 'ltr');
        // }
    }

</script>

<style lang="scss" scoped>

</style>