<template>
    <div class="message_container">
        <p>{{ message }}</p>
    </div>
</template>

<script>
export default {
    props: ["message"]
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/message";
</style>