<template>
    <div class="popup_container" v-if="showPopup">
        <div class="popup_header">
            <button @click="closePopup">X</button>
        </div>
        <div class="popup_content">
            <p>
                This site uses cookies to ensure the best possible experience
                for you. By continuing to browse, you agree to the use of
                cookies. For more information, see our
                <a href="#">Privacy Policy</a>.
            </p>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            showPopup: true,
        };
    },
    methods: {
        closePopup() {
            this.showPopup = false;
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/popup';
</style>
