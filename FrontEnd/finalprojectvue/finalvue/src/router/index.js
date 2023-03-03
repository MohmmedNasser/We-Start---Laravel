import { createRouter, createWebHistory } from 'vue-router'
import { useUserStore } from '../stores/user';


const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: () => import('../views/HomeView.vue'),
    },
    {
      path: '/login',
      name: 'login',
      component: () => import('../views/Login.vue'),
      meta: { 
        title: 'Login'
      }
    },
    {
      path: '/register',
      name: 'register',
      component: () => import('../views/Register.vue'),
      meta: { 
        title: 'Register Page',
      }
    },

    {
      path: '/otp',
      name: 'otp',
      component: () => import('../views/Otp.vue'),
      meta: { 
        title: 'OTP'
      }
    },
    {
      path: '/checkout',
      name: 'checkout',
      component: () => import('../views/Checkout.vue'),
      meta: { 
        title: 'Checkout',
        auth: true,
      }
    },

    {
      path: '/shop',
      name: 'shop',
      component: () => import('../views/ShopView.vue')
    },

    {
      path: '/product/:slug',
      name: 'product',
      props: true,
      component: () => import('../views/ProductView.vue'),
    },

    {
      path: '/cart',
      name: 'cart',
      component: () => import('../views/CartView.vue')
    },

    {
      path: '/:pathMatch(.*)*',
      name: 'NotFound',
      component: () => import('../views/NotFount.vue'),
      meta: { 
        title: 'Not Found Page',
      }
    },

  ]
});

const default_title = 'We Start Project';

router.beforeEach((to, from, next) => {
  
  const user = useUserStore().getUser;
  // console.log(user);

  let documentTitle =  to.meta.title || default_title;

  if(to.params.title) {
    documentTitle +=  ` - ${to.params.title}`
  }
  document.title = documentTitle;

  if(!user && to.meta.auth) {
    router.push('/login');
  }
  if(user && !user.otp_verified_at && to.meta.auth) {
    router.push('/otp');
  }

  if(user) {
    if(to.name === 'login') router.push('/');
    if(to.name === 'register') router.push('/');
  }
  if(user && user.otp_verified_at || !user) {
    if(to.name === 'otp') router.push('/');
  }


  next();
});


export default router
