<template>
    <div class="container my-5">

        <h4 class="mb-4 fw-bold">
            Edit Coueses
        </h4>

        <div>
            <form @submit.prevent='updateCourse' >
                <div class="mb-3">
                    <label class="mb-1">
                        Title
                    </label>
                    <input type="text" placeholder="Title" class="form-control" v-model="courses.title">
                </div>

                <div  class="mb-3">
                    <label class="mb-1">
                        Image
                    </label>
                    <input type="file" class="form-control" @change="updateImage">
                    <img :src="imageSrc" alt="" class="img-fluid mt-3" width="100">
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
                        Updata
                    </button>
                </div>
            </form>
        </div>

    </div>
</template>

<script setup>
    import {onMounted, ref} from "vue";
    import {useRouter} from "vue-router";

    let courses = ref({
        id: '',
        title : '',
        image : '',
        description : '',
        price : '',
        discount : '',
    });

    let imageSrc = ref();

    let props = defineProps({
        id:  {
            type: String,
        },
    });

    const router = useRouter();

    const updateImage = (e) => {
        courses.value.image = e.target.files[0];

        if(e.target.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                imageSrc.value = e.target.result;
            }
            reader.readAsDataURL(e.target.files[0]);
        }
    }

    const updateCourse = () => {
        let formData = new FormData();
        formData.append('title', courses.value.title);
        formData.append('image', courses.value.image);
        formData.append('description', courses.value.description);
        formData.append('price', courses.value.price);
        formData.append('discount', courses.value.discount);
        formData.append('_method', 'PUT');

        let config = {
            headers: {
                'Content-Type' : 'multipart/form-data'
            },
        }
        axios.post('/api/v1/courses/'+courses.value.id, formData, config)
            .then(res => {
                router.push({path:'/'});
                Toast.fire({
                    icon: 'success',
                    title: 'Course edit successfully'
                });
            })
    }


    onMounted(() => {
        getCourse();
    })

    const getCourse = () => {
        axios.get("/api/v1/courses/"+props.id)
            .then((res) => {
                imageSrc.value = '/uploads/'+ res.data.data.image
                courses.value = res.data.data;
            })
    }

</script>

<style scoped>

</style>
