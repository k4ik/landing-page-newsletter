<template>
    <h1>Painel</h1>
    <router-link to="/create-post">Create post</router-link>
    <article>
        <h2>Newsletter Members</h2>
        <table>
            <tr>
                <th>id</th>
                <th>email</th>
                <th>actions</th>
            </tr>
            <tr>
                <td>1</td>
                <td>kaik.e.l.couto@gmail.com</td>
                <td><button>Remove</button></td>
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
            <tr>
                <td>1</td>
                <td>kaik.e.l.couto@gmail.com</td>
                <td>1234</td>
                <td><button>Remove</button></td>
            </tr>
        </table>
        <button>Add Owner</button>
    </article>
    <article>
        <h2>Posts</h2>
        <table>
            <tr>
                <th>id</th>
                <th>title</th>
            </tr>
            <tr>
                <td>1</td>
                <td>HJsydgy g</td>
            </tr>
        </table>
    </article>
    <button>Logout</button>
</template>