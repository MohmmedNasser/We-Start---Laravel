<template>
    <div class="container my-5">

        <div v-if="Object.keys(errors).length > 0" class="alert alert-danger">
            <p v-for="(err, i) in errors" :key="i" class="mb-0">
                  {{ err[0] }}
            </p>
        </div>

        <h4 class="mb-4 fw-bold">
            All Coueses
        </h4>

        <div>
            <form @submit.prevent='addCourse' >
                <div class="mb-3">
                    <label class="mb-1">
                        Title
                    </label>
                    <input type="text" placeholder="Title" class="form-control" v-model="courses.title" :class="{ 'is-invalid' : errors.title }">
                    <span v-if="errors.title" class="invalid-feedback">
                        {{ errors.title[0] }}
                    </span>
                </div>

                <div  class="mb-3">
                    <label class="mb-1">
                        Image
                    </label>
                    <input type="file" class="form-control" @change="updateImage" :class="{ 'is-invalid' : errors.image }">
                    <span v-if="errors.title" class="invalid-feedback">
                        {{ errors.image[0] }}
                    </span>
                </div>

                <div  class="mb-3">
                    <label class="mb-1">
                        Description
                    </label>
                    <textarea class="form-control" rows="5" placeholder="Description" v-model="courses.description"></textarea>
                </div>

                <div class="mb-3">
                    <label class="mb-1">
                        Price
                    </label>
                    <input type="number" placeholder="Price" class="form-control" v-model="courses.price">
                </div>


                <div class="mb-3">
                    <label class="mb-1">
                        Discount
                    </label>
                    <input type="number" placeholder="Price" class="form-control" v-model="courses.discount">
                </div>

                <div>
                    <button class="btn btn-success">
                        Add
                    </button>
                </div>
            </form>
        </div>

    </div>
</template>

<script setup>
    import {ref} from "vue";
    import { useRouter } from 'vue-router';

    let courses = ref({
        title : '',
        image : '',
        description : '',
        price : '',
        discount : '',
    });

    let errors = ref({});

    const router = useRouter();

    const updateImage = (e) => {
        // console.log(e.target.files[0]);
        courses.value.image = e.target.files[0];
    }

    const addCourse = () => {
        let formData = new FormData();
        formData.append('title', courses.value.title);
        formData.append('image', courses.value.image);
        formData.append('description', courses.value.description);
        formData.append('price', courses.value.price);
        formData.append('discount', courses.value.discount);

        let config = {
            headers: {
                'Content-Type' : 'multipart/form-data'
            }
        }
        axios.post('api/v1/courses', formData, config)
            .then(res => {
                router.push({path:'/'});
                Toast.fire({
                    icon: 'success',
                    title: 'Course added successfully'
                });
            }).catch(err => {
                errors.value = err.response.data.errors;
                console.log(err.response.data.errors);

        })
    }

</script>

<style scoped>

</style>
