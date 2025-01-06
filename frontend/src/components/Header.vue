<template>
    <header>
        <img src="../assets/images/logo.svg" alt="tailwind logo">
        <nav>
            <button @click="$emit('openOverlay')">Cadastrar</button>
        </nav>
    </header>
</template>

<script>
    export default {
        
    }
</script>

<style lang="scss" scoped>
@import "../assets/scss/header";
</style>