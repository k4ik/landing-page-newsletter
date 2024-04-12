<template>
    <Message v-if="viewMessage" :message="message" />
    <main>
        <h1 class="newsletter_h1">Criar Post</h1>
        <form class="newsletter_form">
            <fieldset>
                <label for="">Título:</label>
                <input type="text" name="title" v-model="inputTitle">
            </fieldset>
            <fieldset>
                <label for="">Conteúdo:</label>
                <textarea name="content" cols="30" rows="10" v-model="inputContent"></textarea>
            </fieldset>
            <button @click.prevent="fetchData">Publicar</button>
        </form>
    </main>
</template>

<script>
  import Message from "../components/Message.vue";

  export default {
    methods: {
      fetchData() {
        let formData = new FormData(document.querySelector('.newsletter_form'));
        fetch('http://localhost:8000/controllers/PostController.php', {
          method: "POST",
          body: formData
        })
        .then(response => response.text())
        .then(data => {
          console.log(data)

          this.message = data;
          this.viewMessage = true;
          
          setTimeout(()=>{
            this.viewMessage = false;
          }, 5000)

          if(data == "Post publicado com sucesso!") {
            this.inputTitle = "";
            this.inputContent = "";
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
        inputTitle: "",
        inputContent: "",
      };
    }
  }
</script>

<style lang="scss" scoped>
@import "../assets/scss/newsletter";
</style>