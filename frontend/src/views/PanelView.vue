<template>
    <div class="body">
        <Message v-if="viewMessage" :message="message" />
        <OwnerOverlay
            v-if="viewOverlay"
            @closeOverlay="closeOverlay"
            @fetchData="handleOverlayFetch"
        />
        <h1 class="title">Panel</h1>
        <main>
            <article>
                <h2>Newsletter Members</h2>
                <table>
                    <tr>
                        <th>id</th>
                        <th>email</th>
                        <th>actions</th>
                    </tr>
                    <tr v-for="member in members" :key="member.id">
                        <td>{{ member.id }}</td>
                        <td>{{ member.email }}</td>
                        <td>
                            <button @click="deleteMember(member.id)">
                                Remove
                            </button>
                        </td>
                    </tr>
                </table>
            </article>
            <article>
                <h2>Newsletter Owners</h2>
                <table>
                    <tr>
                        <th>id</th>
                        <th>email</th>
                        <th>password</th>
                        <th>actions</th>
                    </tr>
                    <tr v-for="owner in owners" :key="owner.id">
                        <td>{{ owner.id }}</td>
                        <td>{{ owner.email }}</td>
                        <td>{{ owner.password }}</td>
                        <td>
                            <button @click="deleteOwner(owner.id)">
                                Remove
                            </button>
                        </td>
                    </tr>
                </table>
                <button @click="openOverlay()">Add Owner</button>
            </article>
            <article>
                <h2>Posts</h2>
                <table>
                    <tr>
                        <th>id</th>
                        <th>title</th>
                        <th>date</th>
                    </tr>
                    <tr v-for="post in posts" :key="post.id">
                        <td>{{ post.id }}</td>
                        <td>{{ post.title }}</td>
                        <td>{{ post.date }}</td>
                    </tr>
                </table>
            </article>
            <article>
                <h2>Actions</h2>
                <table>
                    <tr>
                        <th><button @click="logout()">Logout</button></th>
                        <th>
                            <button
                                class="post-btn"
                                @click="$router.push('/create-post')"
                            >
                                Create Post
                            </button>
                        </th>
                    </tr>
                </table>
            </article>
        </main>
    </div>
</template>

<script>
import OwnerOverlay from '../components/AddOwner.vue';
import Message from '../components/Message.vue';
import { usePanelStore } from '@/stores/panel';

export default {
    components: {
        OwnerOverlay,
        Message,
    },
    setup() {
        const panelStore = usePanelStore();

        const loadMembers = async () => {
            await panelStore.fetchMembers();
        };

        const loadOwners = async () => {
            await panelStore.fetchOwners();
        };

        const loadPosts = async () => {
            await panelStore.fetchPosts();
        };

        loadMembers();
        loadOwners();
        loadPosts();

        return {
            ...panelStore,
        };
    },
    methods: {
        deleteMember(id) {
            fetch(`http://localhost:8000/api/member/${id}`, {
                method: 'DELETE',
            }).then(() => {
                this.members = this.members.filter(
                    (member) => member.id !== id,
                );
            });
        },
        deleteOwner(id) {
            fetch(`http://localhost:8000/api/owner/${id}`, {
                method: 'DELETE',
            }).then(() => {
                this.owners = this.owners.filter((owner) => owner.id !== id);
            });
        },
        async handleOverlayFetch() {
            await this.getOwners();
        },
    },
};
</script>

<style lang="scss" scoped>
@import '../assets/scss/panel';
</style>
