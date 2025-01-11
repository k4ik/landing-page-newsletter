<template>
    <main>
        <div class="overlay_container">
            <div class="overlay_header">
                <h1>Add a owner</h1>
                <button @click="$emit('closeOverlay')">X</button>
            </div>
            <form class="overlay_form" @submit.prevent="handleAddOwner">
                <fieldset>
                    <label for="name">Name:</label>
                    <input
                        type="text"
                        name="name"
                        autocomplete="off"
                        v-model="inputName"
                    />
                </fieldset>
                <fieldset>
                    <label for="email">E-mail</label>
                    <input
                        type="email"
                        name="email"
                        autocomplete="off"
                        v-model="inputEmail"
                    />
                </fieldset>
                <fieldset>
                    <label for="password">Password</label>
                    <input
                        type="password"
                        name="password"
                        autocomplete="off"
                        v-model="inputPassword"
                    />
                </fieldset>
                <button class="overlay_button" type="submit">Add</button>
            </form>
        </div>
    </main>
</template>

<script>
export default {
    data() {
        return {
            inputName: '',
            inputEmail: '',
            inputPassword: '',
        };
    },
    methods: {
        async handleAddOwner() {
            const formData = new FormData();
            formData.append('name', this.inputName);
            formData.append('email', this.inputEmail);
            formData.append('password', this.inputPassword);

            try {
                const response = await fetch(
                    'http://localhost:8000/api/owner',
                    {
                        method: 'POST',
                        body: formData,
                    },
                );
                const data = await response.json();

                if (data.success) {
                    this.$emit('fetchData'); 
                    this.$emit('closeOverlay');
                } else {
                    console.error(data.error);
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/overlay';
</style>
