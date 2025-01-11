import { defineStore } from 'pinia';

export const usePanelStore = defineStore('panel', {
    state: () => ({
        members: null, 
        owners: null,
        posts: null,
    }),
    actions: {
        async fetchMembers(forceRefresh = false) {
            if (!forceRefresh && this.members) {
                return this.members; 
            }
            const response = await fetch('http://localhost:8000/api/members');
            const data = await response.json();
            this.members = data; 
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
        clearCache() {
            this.members = null;
            this.owners = null;
            this.posts = null;
        },
    },
});
