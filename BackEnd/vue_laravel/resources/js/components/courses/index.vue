<template>
    <div class="container my-5">

        <div class="mb-4 d-flex justify-content-between align-items-center">
            <h4 class=" fw-bold">
                All Coueses
            </h4>
            <button class="btn btn-primary btn-sm" @click="addNew">
                Add New
            </button>
        </div>

        <table class="table table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Discount</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="course in courses" :key="course.id">
                    <td>
                        {{ course.id }}
                    </td>
                    <td>
                        {{ course.title }}
                    </td>
                    <td>
                        <img :src="/uploads/+course.image" alt="" class="img-fluid" style="width: 80px; height: 80px;">
                    </td>
                    <td>
                        <span>{{ course.price }}</span>
                    </td>
                    <td>
                        <span>{{ course.description }}</span>
                    </td>
                    <td>
                        <div class="d-flex align-items-center justify-content-center gap-1">
                            <button class="btn btn-sm btn-primary" @click="editCourse(course.id)">
                                <svg width="20" height="20" viewBox="0 0 24 24"><path fill="#FFF" d="M3 21h3.75L17.81 9.94l-3.75-3.75L3 17.25V21zm2-2.92l9.06-9.06l.92.92L5.92 19H5v-.92zM18.37 3.29a.996.996 0 0 0-1.41 0l-1.83 1.83l3.75 3.75l1.83-1.83a.996.996 0 0 0 0-1.41l-2.34-2.34z"/></svg>
                            </button>
                            <button class="btn btn-sm btn-danger" @click="deleteCourse(course.id)">
                                <svg width="20" height="20" viewBox="0 0 24 24"><path fill="#FFF" d="M7 21q-.825 0-1.412-.587Q5 19.825 5 19V6H4V4h5V3h6v1h5v2h-1v13q0 .825-.587 1.413Q17.825 21 17 21Zm2-4h2V8H9Zm4 0h2V8h-2Z"/></svg>
                            </button>
                        </div>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>
</template>

<script setup>

import {onMounted, ref} from "vue";
import { useRouter } from 'vue-router';

let router = useRouter();

let courses = ref();

const getCourses = () => {
    axios.get('api/v1/courses')
        .then((res) => {
            courses.value = res.data.data;
        })
}

const addNew = () => {
    router.push({path: '/new_course'});
}

onMounted(() =>{
    getCourses();
});

const deleteCourse = (id) => {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            axios.delete('api/v1/courses/'+id)
                .then((res) => {
                    Toast.fire({
                        icon: 'success',
                        title: 'Course Deleted successfully'
                    });
                    getCourses();
                });
        }
    })
}

const editCourse = (id) => {
    router.push(`/${id}/edit`);
}


</script>

<style scoped>

</style>
