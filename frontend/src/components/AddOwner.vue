<template>
    <main>
      <div class="overlay_container">
        <div class="overlay_header">
          <h1>Adicione um proprietário</h1>
          <button @click="$emit('closeOverlay')">X</button>
        </div>
        <form class="overlay_form">
            <fieldset>
                <label for="email">Email</label>
                <input type="email" name="email" autocomplete="off" v-model="inputEmail" />
            </fieldset>
            <fieldset>
                <label for="password">Password</label>
                <input type="password" name="password" autocomplete="off" v-model="inputName" />
            </fieldset>
          <button class="overlay_button" @click.prevent="$emit('fetchData')">Adicionar</button>
        </form>
      </div>
    </main>
  </template>

  <script>
 
  </script>

  <style lang="scss" scoped>
  @import "../assets/scss/overlay";
  </style>