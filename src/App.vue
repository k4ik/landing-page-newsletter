<script setup lang="ts">
  import Navbar from "./components/Navbar.vue";
  import Main from "./components/Main.vue";
  import Overlay from "./components/Overlay.vue";
</script>

<template>
  <div class="bg-gray-900 h-screen">
    <Overlay />
    <Navbar />
    <Main />
  </div>
</template>