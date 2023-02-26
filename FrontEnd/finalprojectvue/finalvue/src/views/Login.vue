<template>
    <div class="contain py-16">

        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">


            <!-- <template v-if="Object.entries(errorMsg).length > 1">
                <div v-for="(err, i) in errorMsg" :key="i" class="p-3 bg-red-200 border-red-200 rounded text-red-900 mb-2">
                    {{ err[0] }}
                </div>
            </template> -->
            

            <div v-if="errorMsg" class="p-3 bg-red-200 border-red-200 rounded text-red-900 mb-2">
                {{ errorMsg }}
            </div>

            <h2 class="text-2xl uppercase font-medium mb-1">Login</h2>
            <p class="text-gray-600 mb-6 text-sm">welcome back customer</p>
            <form @submit.prevent="handleLogin"  method="post" action="#">
                <div class="space-y-2">
                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" v-model="loginForm.email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="youremail.@domain.com" />
                    </div>
                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" v-model="loginForm.password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******" />
                    </div>
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                            class="text-primary focus:ring-0 rounded-sm cursor-pointer" />
                        <label for="remember" class="text-gray-600 ml-3 cursor-pointer">Remember me</label>
                    </div>
                    <a href="#" class="text-primary">Forgot password</a>
                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        Login
                    </button>
                </div>
            </form>


            <p class="mt-4 text-center text-gray-600">
                Don't have account?
                <router-link to="/register" class="text-primary">Register now</router-link>
            </p>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, reactive, ref } from "vue";
    import { useUserStore } from '../stores/user';
    import { useRouter } from 'vue-router'
    
    const user = useUserStore();
    const router = useRouter();

    // onMounted( () => {
    //     console.log(user.getUser);
    // });

    const loginForm = reactive({
        email: '',
        password: '',
    });

    let errorMsg = ref('');

    const handleLogin = () => {
        axios.post('/login', {
            email: loginForm.email,
            password: loginForm.password,
        }).then(res => {
            // console.log(res.data);
            user.updateUser(res.data.data.user);
            user.updateToken(res.data.data.token);
            // user.updateCartToUser();
            user.updateCart();
            if(user.user && !user.user.otp_verified_at) {
                router.push('/otp');
            } else {
                router.push('/');
            }
        }).catch(error => {
            if (error.response) {
                // console.log(error.response.data.message);
                errorMsg.value = error.response.data.message
            }
        });
    }

</script>

<style lang="scss" scoped>

</style>
