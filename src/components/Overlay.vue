<template>
    <div class="bg-black bg-opacity-50 w-full h-full absolute flex justify-center items-center">
        <div class="bg-bg-overlay max-w-md p-10">
            <div>
                <div class="flex justify-between items-center mb-1">
                    <h1 class="text-zinc-200 font-bold">Cadastre-se Agora!!!</h1>
                    <button class="bg-zinc-800 text-zinc-500 font-bold text-sm rounded-full w-8 h-8">X</button>
                </div>
                <p class="text-zinc-400 text-sm">Complete o cadastro para participar da newsletter e acessar as informações da newsletter</p>
            </div>
            <form class="mt-6">
                <fieldset class="flex flex-col">
                    <label for="" class="text-zinc-200 font-bold text-sm mb-1">Nome</label>
                    <input type="text" placeholder="Digite seu nome aqui" class="py-2 px-4 bg-zinc-800 placeholder:text-sm text-zinc-400 outline-none">
                </fieldset>
                <fieldset class="flex flex-col mt-6">
                    <label for="" class="text-zinc-200 font-bold text-sm mb-1">Email</label>
                    <input type="text" placeholder="Digite seu melhor email" class="py-2 px-4 bg-zinc-800 placeholder:text-sm text-zinc-400 outline-none">
                </fieldset>
                <div class="flex mt-6 gap-4">
                    <input type="checkbox" name="" id="">
                    <span class="text-zinc-400 text-sm">Eu aceito os <strong class="text-zinc-200">Termos de serviço</strong> para acessar as informações da newsletter</span>
                </div>
                <button class="px-6 py-2 bg-cyan-400 mb-8 mt-6 w-full hover:bg-cyan-600 transition">Cadastrar na nossa newsletter</button>
            </form>
        </div>
    </div>
</template>

<script setup lang="ts">

</script>

<style scoped>

</style>