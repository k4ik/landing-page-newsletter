<template>
    <div class="body">
        <Message v-if="viewMessage" :message="message" />
        <OwnerOverlay v-if="viewOverlay" @closeOverlay="closeOverlay" @fetchData="fetchData" />
        <h1 class="title">Painel</h1>
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
                        <td><button @click="deleteMember(member.id)">Remove</button></td>
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
                        <td><button @click="deleteOwner(owner.id)">Remove</button></td>
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
                    </tr>
                    <tr v-for="post in posts" :key="post.id">
                        <td>{{ post.id }}</td>
                        <td>{{ post.title }}</td>
                    </tr>
                </table>
            </article>
            <article>
                <h2>Actions</h2>
                <table>
                    <tr>
                        <th><button @click="logout()">Logout</button></th>
                        <th><button class="post-btn" @click="$router.push('/create-post')">Create Post</button></th>
                    </tr>
                </table>
            </article>
        </main>
    </div>
</template>

<script>
import OwnerOverlay from "../components/AddOwner.vue";
import Message from "../components/Message.vue";

export default {
    components: {
        OwnerOverlay,
        Message
    },
    data() {
        return {
            members: [],
            owners: [],
            posts: [],
            viewOverlay: false,
            viewMessage: false,
            message: null,
            inputName: "",
            inputEmail: ""
        }
    },
    methods: {
        async getMembers() {
            let data = await fetch('http://localhost:8000/api/members');
            let members = await data.json();

            this.members = members;
        },
        async getOwners() {
            let data = await fetch('http://localhost:8000/api/owners');
            let owners = await data.json();

            this.owners = owners;
        },
        async getPosts() {
            let data = await fetch('http://localhost:8000/api/posts');
            let posts = await data.json();

            this.posts = posts;
        },
        deleteMember(id) {
            fetch(`http://localhost:8000/api/member/{$id}`, {
                method: 'DELETE',
                body: id
            })
        },
        deleteOwner(id) {
            fetch(`http://localhost:8000/api/owner/{$id}`, {
                method: 'DELETE',
                body: id
            })
        },
        openOverlay() {
            this.viewOverlay = true;
        },
        closeOverlay() {
            this.viewOverlay = false;
        },
        fetchData() {
            var formData = new FormData(document.querySelector('.overlay_form'));

            fetch("http://localhost:8000/api/owner", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.viewMessage = true;
                    this.message = data.success;

                    setTimeout(() => {
                        this.viewMessage = false;
                    }, 5000)

                    this.closeOverlay();
                } else {
                    this.viewMessage = true;
                    this.message = data.error;

                    setTimeout(() => {
                        this.viewMessage = false;
                    }, 5000)

                    this.inputName = "";
                    this.inputEmail = "";
                }
            })
            .catch(error => {
                console.error("Erro:".error);
            })
        },
        logout() {
            localStorage.removeItem('token');    
        }
    }
}
</script>

<style lang="scss" scoped>
@import "../assets/scss/painel";
</style>