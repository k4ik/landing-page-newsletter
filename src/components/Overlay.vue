<template>
  <main>
    <div class="overlay_container">
      <div class="overlay_header">
        <h1>Cadastre-se Agora!!!</h1>
        <button @click="$emit('closeOverlay')">X</button>
      </div>
      <p class="overlay_p">
        Complete o cadastro para participar da newsletter e acessar as
        informações da newsletter
      </p>
      <form class="overlay_form">
        <fieldset>
          <label for="name">Nome</label>
          <input type="text" placeholder="Digite seu nome aqui" name="name" />
        </fieldset>
        <fieldset>
          <label for="email">Email</label>
          <input
            type="email"
            placeholder="Digite seu melhor email"
            name="email"
          />
        </fieldset>
        <fieldset class="overlay_terms">
          <input type="checkbox" />
          <span
            >Eu aceito os <a href="#">Termos de serviço</a> para acessar as
            informações da newsletter</span
          >
        </fieldset>
        <button class="overlay_button">Cadastrar na nossa newsletter</button>
      </form>
    </div>
  </main>
</template>

<script>
export default {
  
};
</script>

<style lang="scss" scoped>
@import "../assets/scss/overlay";
</style>