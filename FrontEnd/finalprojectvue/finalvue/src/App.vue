
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

</script>


<style scoped>

</style>
