
<template>

  <header-component />
  <nav-component />

  <RouterView />
  
  <footer-component />

</template>

<script setup>
  import headerComponent from './components/header-component.vue';
  import navComponent from './components/nav-component.vue';
  import footerComponent from './components/footer-component.vue';

  // const lang = localStorage.getItem('locale') ?? 'en';
  
  // if(lang == 'ar') {
  //   document.querySelector('html').setAttribute('dir', 'rtl');
  // } else {
  //   document.querySelector('html').setAttribute('dir', 'ltr');
  // }


</script>


<style scoped>

</style>
