import { defineStore } from 'pinia';

export const usePanelStore = defineStore('panel', {
    state: () => ({
        members: null, // Inicialmente nulo, indica que ainda não foi carregado
        owners: null,
        posts: null,
    }),
    actions: {
        async fetchMembers(forceRefresh = false) {
            if (!forceRefresh && this.members) {
                return this.members; // Retorna do cache se já tiver os dados
            }
            const response = await fetch('http://localhost:8000/api/members');
            const data = await response.json();
            this.members = data; // Atualiza o estado com os novos dados
            return data;
        },
        async fetchOwners(forceRefresh = false) {
            if (!forceRefresh && this.owners) {
                return this.owners;
            }
            const response = await fetch('http://localhost:8000/api/owners');
            const data = await response.json();
            this.owners = data;
            return data;
        },
        async fetchPosts(forceRefresh = false) {
            if (!forceRefresh && this.posts) {
                return this.posts;
            }
            const response = await fetch('http://localhost:8000/api/posts');
            const data = await response.json();
            this.posts = data;
            return data;
        },
        // Métodos para limpar os dados do cache, se necessário
        clearCache() {
            this.members = null;
            this.owners = null;
            this.posts = null;
        },
    },
});
