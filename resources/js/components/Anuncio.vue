<template>
    <div>
        <p>Anuncios</p>
        <hr />
        <ul class="list-group">
            <li
                class="list-group-item"
                v-for="(item, index) in notas"
                :key="index"
            >
                <span class="badge badge-primary float-right">{{
                    item.updated_at
                }}</span>
                <p>{{ item.anuncio }}</p>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data() {
        return {
            notas: []
        };
    },
    created() {
        axios.get("/homevue").then(res => {
            this.notas = res.data;
        });
    }
};
</script>
