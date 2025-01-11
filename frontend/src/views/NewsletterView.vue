<template>
    <Message v-if="viewMessage" :message="message" />
    <main>
        <h1 class="newsletter_h1">Create a Post</h1>
        <form class="newsletter_form">
            <fieldset>
                <label for="">Title:</label>
                <input type="text" name="title" v-model="inputTitle" />
            </fieldset>
            <fieldset>
                <label for="">Content:</label>
                <textarea
                    name="content"
                    cols="30"
                    rows="10"
                    v-model="inputContent"
                ></textarea>
            </fieldset>
            <button @click.prevent="fetchData">Publish</button>
        </form>
        <div class="logout-div">
            <button @click="$router.push('/painel')">Return</button>
        </div>
    </main>
</template>

<script>
import Message from '../components/Message.vue';

export default {
    methods: {
        fetchData() {
            let formData = new FormData(
                document.querySelector('.newsletter_form'),
            );
            fetch('http://localhost:8000/api/post', {
                method: 'POST',
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    this.viewMessage = true;
                    this.message = data.error;

                    setTimeout(() => {
                        this.viewMessage = false;
                    }, 5000);

                    if (data.success) {
                        this.message = data.success;

                        this.inputTitle = '';
                        this.inputContent = '';
                    }
                })
                .catch((error) => {
                    console.error('Erro'.error);
                });
        },
        logout() {
            localStorage.removeItem('token');
            this.$router.push('/');
        },
    },
    components: {
        Message,
    },
    data() {
        return {
            viewMessage: false,
            message: null,
            inputTitle: '',
            inputContent: '',
        };
    },
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/newsletter';
</style>
