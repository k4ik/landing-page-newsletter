<template>
    <Message v-if="viewMessage" :message="message" />
    <main>
        <form class="login_form">
          <fieldset>
            <label for="email">Email</label>
            <input type="email" placeholder="Digite seu email" name="email" autocomplete="off" />
          </fieldset>
          <fieldset>
            <label for="password">Senha</label>
            <input type="password" placeholder="Digite sua senha" name="password" autocomplete="off" />
          </fieldset>
          <button class="login_button" @click.prevent="fetchData">Entrar</button>
        </form>
    </main>
</template>

<script>
  import Message from "../components/Message.vue";

  export default {
    methods: {
      fetchData() {
        let formData = new FormData(document.querySelector('.login_form'));
        fetch('http://localhost:8000/api/login', {
          method: "POST",
          body: formData
        })
        .then(response => response.json())
        .then(data => {
          if(data.error) {
            this.message = data.error;
            this.viewMessage = true;

            setTimeout(()=>{
                this.viewMessage = false;
            }, 5000)
          } 
          
          if(data.token) {
            localStorage.setItem('token', data.token);
            this.$router.push("/create-post");
          }        
        })
        .catch(error => {
          console.error("Erro" . error)
        })
      }
    },
    components: {
      Message
    },
    data() {
      return {
        viewMessage: false,
        message: null,
      };
    }
  }
</script>

<style lang="scss" scoped>
  @import "../assets/scss/login"
</style>