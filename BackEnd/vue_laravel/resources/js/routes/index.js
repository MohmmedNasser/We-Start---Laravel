import { createWebHistory, createRouter } from "vue-router";
import Courses from "../components/courses/index.vue";
import NewCourses from "../components/courses/new-course.vue";
import NotFound from "../components/not-found.vue";
import EditCourse from "../components/courses/edit-course.vue";

const routes = [
    {
        path: "/",
        name: "courses",
        component: Courses,
    },
    {
        path: "/new_course",
        name: "new-courses",
        component: NewCourses,
    },
    {
        path: "/:id/edit",
        component: EditCourse,
        props: true,
    },
    {
        path: "/:pathMatch(.*)*",
        name: "NotFound",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
