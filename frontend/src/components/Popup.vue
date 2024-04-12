<template>
    <div class="popup_container"  v-if="showPopup">
        <div class="popup_header">
            <button @click="closePopup">X</button>
        </div>
        <div class="popup_content">
            <p>Este site utiliza cookies para garantir a melhor experiência possível para você. Ao continuar navegando, você concorda com o uso de cookies. Para mais informações, consulte nossa <a href="#">Política de Privacidade</a>.</p>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                // mudar para True
                showPopup: false,
            }
        },
        methods: {
            closePopup() {
                this.showPopup = false;
            }
        }
    }
</script>

<style lang="scss" scoped>
    @import "../assets/scss/popup";
</style>