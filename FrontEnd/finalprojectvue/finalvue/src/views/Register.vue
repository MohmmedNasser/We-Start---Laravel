<template>
    <div class="contain py-16">

        <div class="max-w-lg mx-auto shadow px-6 py-7 rounded overflow-hidden">

            
            <div v-if="errorMsg" class="p-3 bg-red-200 border-red-200 rounded text-red-900 mb-2">
                <div v-for="( error ,i) in errorMsg" :key="i">
                    <div v-for="(err, index) in error" :key="index" >
                        {{  err }}
                    </div>
                </div>
            </div>

            <h2 class="text-2xl uppercase font-medium mb-1">Register</h2>
            <form @submit.prevent="handleRegister" method="post" action="#">
                <div class="space-y-2">
                    <div>
                        <label for="name" class="text-gray-600 mb-2 block">Name</label>
                        <input type="text" name="name" id="name" v-model="registerForm.name"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="Full Name"/>
                    </div>
                    <div>
                        <label for="email" class="text-gray-600 mb-2 block">Email address</label>
                        <input type="email" name="email" id="email" v-model="registerForm.email"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="youremail.@domain.com" />
                    </div>
                    <div>
                        <label for="phone" class="text-gray-600 mb-2 block">Phone</label>
                        <input type="text" name="phone" id="phone" v-model="registerForm.phone"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="+99999999999" />
                    </div>

                    <div>
                        <label for="password" class="text-gray-600 mb-2 block">Password</label>
                        <input type="password" name="password" id="password" v-model="registerForm.password"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******"/>
                    </div>
                    <div>
                        <label for="password_confirmation" class="text-gray-600 mb-2 block">Password Conformation</label>
                        <input type="password" name="password_confirmation" id="password_conformation" v-model="registerForm.password_confirmation"
                            class="block w-full border border-gray-300 px-4 py-3 text-gray-600 text-sm rounded focus:ring-0 focus:border-primary placeholder-gray-400"
                            placeholder="*******"/>
                    </div>

                </div>
                <div class="mt-4">
                    <button type="submit"
                        class="block w-full py-2 text-center text-white bg-primary border border-primary rounded hover:bg-transparent hover:text-primary transition uppercase font-roboto font-medium">
                        Register
                    </button>
                </div>
            </form>


            <p class="mt-4 text-center text-gray-600">
                You has account?
                <router-link :to="{ name:'login' }" class="text-primary">
                    Login
                </router-link>
            </p>
        </div>
    </div>
</template>

<script setup>
    import { reactive, ref} from "vue";
    import { useUserStore } from '../stores/user';
    import { useRouter } from 'vue-router'
    



    const user = useUserStore();
    const router = useRouter();
    

    const registerForm = reactive({
        name: '',
        email: '',
        phone: '',
        password: '',
        password_confirmation: '',
    });

    let errorMsg = ref('');

    const handleRegister = () => {
        axios.post('/register', {
            name: registerForm.name,
            email: registerForm.email,
            phone: registerForm.phone,
            password: registerForm.password,
            password_confirmation: registerForm.password_confirmation,
        }).then(res => {
            user.updateUser(res.data.data.user);
            user.updateToken(res.data.data.token);
            router.push('/otp');
            // console.log(res.data);
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
