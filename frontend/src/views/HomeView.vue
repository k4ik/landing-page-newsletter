<template>
    <div class="body">
      <Message v-if="viewMessage" :message="message"/>
      <Overlay v-if="viewOverlay" @closeOverlay="closeOverlay" @fetchData="fetchData" />
      <Popup />
      <Header @openOverlay="openOverlay" />
      <main>
        <article>
          <div class="hiring">
            <span>Tecnologias</span>
            <p>Estamos por dentro dela para ajudar você</p>
            <button><img src="../assets/images/arrow.svg" alt="arrow" /></button>
          </div>
          <h1 class="main_h1">
            O Melhor jeito de <br /><span>ficar informado</span>
          </h1>
          <p class="main_p">
            Se informe sobre os principais acontecimentos e novidades no mundo da
            tecnologia e não perca oportunidades de estudo e vagas dentro da àrea.
          </p>
          <button class="main_button" @click="openOverlay">
            Cadastre-se na nossa newsletter
          </button>
          <p class="terms">
            Ao cadastrar na newsletter com seus dados você aceita os
            <a href="#">termos de serviço</a>.
          </p>
        </article>
        <aside>
          <img src="../assets/images/image.svg" alt="image" />
        </aside>
      </main>
    </div>
  </template>
  
  <script>
  import Popup from "../components/Popup.vue";
  import Header from "../components/Header.vue";
  import Overlay from "../components/Overlay.vue";
  import Message from "../components/Message.vue";
  
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
        inputName: "",
        inputEmail: ""
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
        var formData = new FormData(document.querySelector('.overlay_form'));
  
        fetch("http://localhost:8000/signup", {
            method: "POST",
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            this.viewMessage = true;
            this.message = data;
            
            setTimeout(()=>{
              this.viewMessage = false;
            }, 5000)

            this.inputName = "";
            this.inputEmail = "";
  
            if(data  == "Olhe sua caixa de email!"){
              this.closeOverlay();
            }
          })
        .catch(error => {
            console.error("Erro:" . error);
        })
      }
    },
  };
  </script>
  
  <style lang="scss" scoped>
  @import "../assets/scss/variables";
  @import "../assets/scss/main";
  @import "../assets/scss/hiring";

  .body {
    background-color: $bg-color;
  }
  </style>