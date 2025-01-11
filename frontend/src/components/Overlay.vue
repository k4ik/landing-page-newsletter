<template>
    <main>
        <div class="overlay_container">
            <div class="overlay_header">
                <h1>Sign Up Now!!!</h1>
                <button @click="$emit('closeOverlay')">X</button>
            </div>
            <p class="overlay_p">
                Complete the registration to join the newsletter and access the
                newsletter information.
            </p>
            <form class="overlay_form">
                <fieldset>
                    <label for="name">Name</label>
                    <input
                        type="text"
                        name="name"
                        autocomplete="off"
                        v-model="inputName"
                    />
                </fieldset>
                <fieldset>
                    <label for="email">Email</label>
                    <input
                        type="email"
                        name="email"
                        autocomplete="off"
                        v-model="inputEmail"
                    />
                </fieldset>
                <fieldset class="overlay_terms">
                    <input type="checkbox" />
                    <span
                        >I accept the <a href="#">Terms of service</a> to access
                        the newsletter information</span
                    >
                </fieldset>
                <button
                    class="overlay_button"
                    @click.prevent="$emit('fetchData')"
                >
                    Register for our newsletter
                </button>
            </form>
        </div>
    </main>
</template>

<style lang="scss" scoped>
@import '../assets/scss/overlay';
</style>
