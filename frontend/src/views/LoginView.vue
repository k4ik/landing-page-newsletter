<template>
    <Message v-if="viewMessage" :message="message" />
    <main>
        <form class="login_form">
            <fieldset>
                <label for="name">Name:</label>
                <input type="text" name="name" autocomplete="off" id="name" />
            </fieldset>
            <fieldset>
                <label for="email">E-mail:</label>
                <input type="email" name="email" autocomplete="off" />
            </fieldset>
            <fieldset>
                <label for="password">Password:</label>
                <input type="password" name="password" autocomplete="off" />
            </fieldset>
            <button class="login_button" @click.prevent="fetchData">
                Sign In
            </button>
        </form>
    </main>
</template>

<script>
import Message from '../components/Message.vue';

export default {
    methods: {
        fetchData() {
            let formData = new FormData(document.querySelector('.login_form'));
            fetch('http://localhost:8000/api/login', {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.error) {
                        this.message = data.error;
                        this.viewMessage = true;

                        setTimeout(() => {
                            this.viewMessage = false;
                        }, 5000);
                    }

                    if (data.token) {
                        localStorage.setItem(
                            'author',
                            document.getElementById('name').value,
                        );
                        localStorage.setItem('token', data.token);
                        this.$router.push('/create-post');
                    }
                })
                .catch((error) => {
                    console.error('Erro'.error);
                });
        },
    },
    components: {
        Message,
    },
    data() {
        return {
            viewMessage: false,
            message: null,
        };
    },
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/login';
</style>
