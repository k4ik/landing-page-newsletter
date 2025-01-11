<template>
    <div class="body">
        <div class="main">
            <Message v-if="viewMessage" :message="message" />
            <Overlay
                v-if="viewOverlay"
                @closeOverlay="closeOverlay"
                @fetchData="fetchData"
            />
            <Popup />
            <Header @openOverlay="openOverlay" />
            <main>
                <article>
                    <h1 class="main_h1">
                        The Best Way to <span>Stay Informed</span>
                    </h1>
                    <p class="main_p">
                        Stay updated on the latest events and news in the tech
                        world, and don't miss out on study opportunities and job
                        openings in the field.
                    </p>
                    <button class="main_button" @click="openOverlay">
                        Sign up for our newsletter
                    </button>
                    <p class="terms">
                        By subscribing to the newsletter with your information,
                        you agree to the
                        <a href="#">terms of service</a>.
                    </p>
                </article>
                <aside>
                    <img src="../assets/images/image.svg" alt="image" />
                </aside>
            </main>
        </div>
    </div>
</template>

<script>
import Popup from '../components/Popup.vue';
import Header from '../components/Header.vue';
import Overlay from '../components/Overlay.vue';
import Message from '../components/Message.vue';

export default {
    components: {
        Header,
        Overlay,
        Popup,
        Message,
    },
    data() {
        return {
            viewOverlay: false,
            viewMessage: false,
            message: null,
            inputName: '',
            inputEmail: '',
        };
    },
    methods: {
        openOverlay() {
            this.viewOverlay = true;
        },
        closeOverlay() {
            this.viewOverlay = false;
        },
        fetchData() {
            var formData = new FormData(
                document.querySelector('.overlay_form'),
            );

            fetch('http://localhost:8000/api/signup', {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        this.viewMessage = true;
                        this.message = data.success;

                        setTimeout(() => {
                            this.viewMessage = false;
                        }, 5000);

                        this.closeOverlay();
                    } else {
                        this.viewMessage = true;
                        this.message = data.error;

                        setTimeout(() => {
                            this.viewMessage = false;
                        }, 5000);

                        this.inputName = '';
                        this.inputEmail = '';
                    }
                })
                .catch((error) => {
                    console.error('Erro:'.error);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/variables';
@import '../assets/scss/main';
.body {
    background-color: $bg-color;
}

.main {
    background-color: $bg-color;
    max-width: 1400px;
    margin: 0 auto;
}
</style>
