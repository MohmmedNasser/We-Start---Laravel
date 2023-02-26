<template>
    <div class="contain py-16">
        <div class="max-w-lg mx-auto text-center shadow px-6 py-7 rounded overflow-hidden">

            <div v-if="errorMsg" class="p-3 bg-red-200 border-red-200 rounded text-red-900 mb-2">
                {{ errorMsg }}
            </div>

            <h2 class="text-2xl uppercase font-medium mb-1">OTP</h2>
            <p class="text-gray-600 mb-6 text-sm">Verify your registration</p>
            <form action="#" method="post" autocomplete="off">
                <div class="grid grid-cols-6 gap-2">
                    <input @keyup="focusNext" type="number"
                        class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" v-model="number.n1" />
                    <input @keyup="focusNext" type="number"
                        class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" v-model="number.n2" disabled/>
                    <input @keyup="focusNext" type="number"
                        class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" v-model="number.n3" disabled/>
                    <input @keyup="focusNext" type="number"
                        class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" v-model="number.n4" disabled/>
                    <input @keyup="focusNext" type="number"
                        class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" v-model="number.n5" disabled/>
                    <input @keyup="focusNext" type="number"
                        class="block w-full border border-gray-300 px-3 py-4 text-center text-gray-600 text-2xl rounded focus:ring-0 focus:border-primary placeholder-gray-400" v-model="number.n6" disabled/>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, watch } from "vue";
import { useRouter } from "vue-router";
import { useUserStore } from "../stores/user";

const user = useUserStore();
const router = useRouter();
const errorMsg = ref('');

const focusNext = (e) => {
    // console.log(e.keyCode);
    const currentInput = e.target,
        nextInput = e.target.nextElementSibling,
        prevInput = e.target.previousElementSibling;

    if (currentInput.value.length > 1) {
        currentInput.value = "";
        return;
    }

    if (nextInput && nextInput.hasAttribute("disabled") && currentInput.value !== "") {
        nextInput.removeAttribute("disabled");
        nextInput.focus();
    }

    if(e.keyCode == 69) {
        currentInput.value = "";
        return;
    }


    if (e.key === "Backspace") {
        if(prevInput){
            currentInput.setAttribute("disabled", true);
            currentInput.value = "";
            prevInput.focus();
        }
    }

    if (!nextInput && currentInput.value !== "") {
        applyOTP();
    }

};

const config = {
    headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${user.token}`
    }
}

const applyOTP = () => {
    axios.post('/verify-otp', {
        number: number.value,
    }, config).then(res => {
        user.updateOTP(res.data);
        // console.log(res.data);
        if(res.status == 200) {
            router.push('/')
        }
    }).catch(error => {
        // console.log(error.response.data.message);
        errorMsg.value = error.response.data.message
    }) 
}

const number = ref({
    n1: null,
    n2: null,
    n3: null,
    n4: null,
    n5: null,
    n6: null,
});




</script>

<style scoped>

input::-webkit-inner-spin-button,
input::-webkit-outer-spin-button {
    display: none;
}

</style>
