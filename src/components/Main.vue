<template>
    <main class="flex justify-around mt-12">
        <section class="max-w-md">
            <WereHiring />
            <h1 class="text-zinc-100 font-semibold text-5xl mb-12">O Melhor jeito de <span class="text-cyan-400">ficar informado</span></h1>
            <p class="text-base text-zinc-100 mb-8">Se informe sobre os principais acontecimentos e novidades no mundo da tecnologia e não perca oportunidades de estudo e vagas dentro da àrea.</p>
            <button class="px-6 py-2 bg-cyan-500 mb-8">Cadastre-se na nossa newsletter</button>
            <p class="text-cyan-300 text-xs">Ao cadastrar na newsletter com seus dados você aceita os <a href="#" class="font-bold underline">termos de serviço</a>.</p>
        </section>
        <aside class="max-w-md">
            <img src="../assets/image.svg" alt="">
        </aside>
    </main>
</template>

<script setup lang="ts">
    import WereHiring from "./WereHiring.vue";
</script>

<style scoped>

</style>